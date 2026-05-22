<?php

namespace App\Filament\Resources\Notificacaos;

use App\Filament\Resources\Notificacaos\Pages\ListNotificacaos;
use App\Models\Notificacao;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class NotificacaoResource extends Resource
{
    protected static bool $shouldRegisterNavigation = true;

    protected static ?string $model = Notificacao::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBell;

    protected static string|UnitEnum|null $navigationGroup = 'Portaria';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Notificações';

    protected static ?string $modelLabel = 'Notificação';

    protected static ?string $pluralModelLabel = 'Notificações';

    public static function getNavigationDescription(): ?string
    {
        return 'Notificações enviadas aos responsáveis';
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->with(['registroGate.autorizacao.aluno']);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('registroGate.autorizacao.aluno.nome')
                    ->label('Aluno')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('canal')
                    ->label('Canal')
                    ->badge()
                    ->color(fn ($state) => $state === 'mail' ? 'info' : 'warning'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state): string => match ($state) {
                        'enviado'  => 'success',
                        'falhou'   => 'danger',
                        default    => 'gray',
                    }),
                TextColumn::make('enviado_at')
                    ->label('Enviado em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateIcon(Heroicon::OutlinedBell)
            ->emptyStateHeading('Nenhuma notificação encontrada')
            ->emptyStateDescription('As notificações são geradas automaticamente após os registros de saída.');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNotificacaos::route('/'),
        ];
    }
}
