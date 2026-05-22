<?php

namespace App\Filament\Resources\Confirmacaos;

use App\Filament\Resources\Confirmacaos\Pages\ListConfirmacaos;
use App\Filament\Resources\Confirmacaos\Tables\ConfirmacaosTable;
use App\Models\Autorizacao;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;

class ConfirmacaoResource extends Resource
{
    protected static ?string $model = Autorizacao::class;

    protected static ?string $slug = 'liberacoes';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckBadge;

    protected static string|UnitEnum|null $navigationGroup = 'Autorizações';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Entradas Pendentes';

    protected static ?string $modelLabel = 'Entrada Pendente';

    protected static ?string $pluralModelLabel = 'Entradas Pendentes';

    public static function getNavigationDescription(): ?string
    {
        return 'Confirmações de entrada de alunos em sala';
    }

    public static function getNavigationBadge(): ?string
    {
        $query = Autorizacao::where('tipo', 'entrada')
            ->where('status', 'aprovado')
            ->whereDoesntHave('confirmacao');

        $user = auth()->user();
        if ($user?->professor) {
            $query->whereHas('aluno', fn (Builder $q) => $q->where('turma_id', $user->professor->turma_id));
        }

        $count = $query->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['professor', 'admin']) ?? false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()
            ->where('tipo', 'entrada')
            ->where('status', 'aprovado')
            ->whereDoesntHave('confirmacao');

        $user = auth()->user();
        if ($user && $user->professor) {
            $query->whereHas('aluno', fn (Builder $q) => $q->where('turma_id', $user->professor->turma_id));
        }

        return $query;
    }

    public static function table(Table $table): Table
    {
        return ConfirmacaosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListConfirmacaos::route('/'),
        ];
    }
}
