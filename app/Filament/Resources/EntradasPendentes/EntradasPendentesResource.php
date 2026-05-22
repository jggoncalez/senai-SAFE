<?php

namespace App\Filament\Resources\EntradasPendentes;

use App\Filament\Resources\EntradasPendentes\Pages\ListEntradasPendentes;
use App\Filament\Resources\EntradasPendentes\Tables\EntradasPendentesTable;
use App\Models\Autorizacao;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;

class EntradasPendentesResource extends Resource
{
    protected static ?string $model = Autorizacao::class;

    protected static ?string $slug = 'entradas-pendentes';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowLeftOnRectangle;

    protected static string|UnitEnum|null $navigationGroup = 'Movimentações';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Entradas Pendentes';

    protected static ?string $modelLabel = 'Entrada Pendente';

    protected static ?string $pluralModelLabel = 'Entradas Pendentes';

    public static function getNavigationDescription(): ?string
    {
        return 'Alunos com autorização de entrada aguardando confirmação';
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
        return 'info';
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
            ->whereDoesntHave('confirmacao')
            ->with(['aluno.turma']);

        $user = auth()->user();
        if ($user && $user->professor) {
            $query->whereHas('aluno', fn (Builder $q) => $q->where('turma_id', $user->professor->turma_id));
        }

        return $query;
    }

    public static function table(Table $table): Table
    {
        return EntradasPendentesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEntradasPendentes::route('/'),
        ];
    }
}
