<?php

namespace App\Filament\Resources\Autorizacaos;

use App\Filament\Resources\Autorizacaos\Pages\CreateAutorizacao;
use App\Filament\Resources\Autorizacaos\Pages\EditAutorizacao;
use App\Filament\Resources\Autorizacaos\Pages\ListAutorizacaos;
use App\Filament\Resources\Autorizacaos\Pages\ViewAutorizacao;
use App\Filament\Resources\Autorizacaos\Schemas\AutorizacaoForm;
use App\Filament\Resources\Autorizacaos\Schemas\AutorizacaoInfolist;
use App\Filament\Resources\Autorizacaos\Tables\AutorizacaosTable;
use App\Models\Autorizacao;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AutorizacaoResource extends Resource
{
    protected static ?string $model = Autorizacao::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocument;

    protected static ?string $slug = 'autorizacoes';

    protected static string|UnitEnum|null $navigationGroup = 'Portaria';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Autorizações';

    protected static ?string $modelLabel = 'Autorização';

    protected static ?string $pluralModelLabel = 'Autorizações';

    protected static ?string $recordTitleAttribute = 'tipo';

    public static function form(Schema $schema): Schema
    {
        return AutorizacaoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AutorizacaoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AutorizacaosTable::configure($table);
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['aqv', 'admin']) ?? false;
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
            'index' => ListAutorizacaos::route('/'),
            'create' => CreateAutorizacao::route('/create'),
            'view' => ViewAutorizacao::route('/{record}'),
            'edit' => EditAutorizacao::route('/{record}/edit'),
        ];
    }
}
