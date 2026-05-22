<?php

namespace App\Filament\Resources\RegistroGates;

use App\Filament\Resources\RegistroGates\Pages\ListRegistroGates;
use App\Filament\Resources\RegistroGates\Tables\RegistroGatesTable;
use App\Models\Autorizacao;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;

class RegistroGateResource extends Resource
{
    protected static ?string $model = Autorizacao::class;

    protected static ?string $slug = 'registros-gate';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowRightOnRectangle;

    protected static string|UnitEnum|null $navigationGroup = 'Portaria';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Saídas Pendentes';

    protected static ?string $modelLabel = 'Saída Pendente';

    protected static ?string $pluralModelLabel = 'Saídas Pendentes';

    public static function getNavigationDescription(): ?string
    {
        return 'Saídas aguardando registro na portaria';
    }

    public static function getNavigationBadge(): ?string
    {
        $count = Autorizacao::where('tipo', 'saida')
            ->where('status', 'aprovado')
            ->whereDoesntHave('registrosGate')
            ->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'danger';
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
            ->where('tipo', 'saida')
            ->where('status', 'aprovado')
            ->whereDoesntHave('registrosGate');
    }

    public static function table(Table $table): Table
    {
        return RegistroGatesTable::configure($table);
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
