<?php

namespace App\Filament\Resources\RegistroGates;

use App\Filament\Resources\RegistroGates\Pages\ListRegistroGates;
use App\Models\Autorizacao;
use App\Models\RegistroGate;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use UnitEnum;

class RegistroGateResource extends Resource
{
    protected static ?string $model = Autorizacao::class;

    protected static ?string $slug = 'registros-gate';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowRightOnRectangle;

    protected static string|UnitEnum|null $navigationGroup = 'Movimentações';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Saídas Pendentes';

    protected static ?string $modelLabel = 'Saída Pendente';

    protected static ?string $pluralModelLabel = 'Saídas Pendentes';

    public static function getNavigationDescription(): ?string
    {
        return 'Saídas aguardando registro na portaria';
    }

    public static function getNavigationBadge(): ?string
    {
        $count = Autorizacao::saidas()->aprovadas()->pendentesGate()->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'danger';
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Saídas aprovadas aguardando registro na portaria';
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['portaria', 'admin']) ?? false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->saidas()
            ->aprovadas()
            ->pendentesGate()
            ->with(['aluno.turma']);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('aluno.nome')
                    ->label('Aluno')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->tooltip(fn (Autorizacao $record): string => $record->aluno?->nome ?? ''),
                TextColumn::make('aluno.turma.nome')
                    ->label('Turma')
                    ->description(fn (Autorizacao $record): string => $record->aluno?->turma?->periodo ?? '')
                    ->sortable(),
                TextColumn::make('aulas_perdidas')
                    ->label('Aulas Perdidas')
                    ->badge()
                    ->color(fn ($state): string => match (true) {
                        $state == 0 => 'success',
                        $state <= 2 => 'warning',
                        default     => 'danger',
                    })
                    ->icon(fn ($state) => $state > 2 ? Heroicon::OutlinedExclamationTriangle : null)
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Aguardando há')
                    ->since()
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('registrar')
                    ->label('Registrar saída')
                    ->icon(Heroicon::OutlinedArrowRightOnRectangle)
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading(fn (Autorizacao $record): string => "Registrar saída de {$record->aluno->nome}?")
                    ->modalDescription(fn (Autorizacao $record): string => "Turma: {$record->aluno->turma->nome} — Aulas perdidas: {$record->aulas_perdidas}")
                    ->action(function (Autorizacao $record): void {
                        $agora = now();
                        DB::transaction(function () use ($record, $agora): void {
                            RegistroGate::create([
                                'autorizacao_id' => $record->id,
                                'user_id'        => auth()->id(),
                                'tipo'           => $record->tipo,
                                'registrado_at'  => $agora,
                                'aulas_perdidas' => $record->aulas_perdidas,
                            ]);
                            $record->update(['status' => 'concluido']);
                        ]);
                        Notification::make()
                            ->title("Saída de {$record->aluno->nome} registrada às {$agora->format('H:i')}")
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('created_at', 'asc')
            ->emptyStateIcon(Heroicon::OutlinedArrowRightOnRectangle)
            ->emptyStateHeading('Nenhuma saída pendente')
            ->emptyStateDescription('Todas as saídas foram registradas ou não há autorizações aprovadas no momento.');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRegistroGates::route('/'),
        ];
    }
}
