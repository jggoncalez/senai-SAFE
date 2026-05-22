<?php

namespace App\Filament\Resources\Responsavels;

use App\Filament\Resources\Responsavels\Pages\CreateResponsavel;
use App\Filament\Resources\Responsavels\Pages\EditResponsavel;
use App\Filament\Resources\Responsavels\Pages\ListResponsavels;
use App\Filament\Resources\Responsavels\Pages\ViewResponsavel;
use App\Filament\Resources\Responsavels\Schemas\ResponsavelForm;
use App\Filament\Resources\Responsavels\Schemas\ResponsavelInfolist;
use App\Filament\Resources\Responsavels\Tables\ResponsavelsTable;
use App\Models\Responsavel;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ResponsavelResource extends Resource
{
    protected static ?string $model = Responsavel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHeart;

    protected static string|UnitEnum|null $navigationGroup = 'Gestão';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Responsáveis';

    protected static ?string $modelLabel = 'Responsável';

    protected static ?string $pluralModelLabel = 'Responsáveis';

    protected static ?string $recordTitleAttribute = 'nome';

    public static function getNavigationDescription(): ?string
    {
        return 'Responsáveis pelos alunos';
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return ResponsavelForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ResponsavelInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResponsavelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListResponsavels::route('/'),
            'create' => CreateResponsavel::route('/create'),
            'view' => ViewResponsavel::route('/{record}'),
            'edit' => EditResponsavel::route('/{record}/edit'),
        ];
    }
}
