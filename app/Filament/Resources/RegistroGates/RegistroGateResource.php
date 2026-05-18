<?php

namespace App\Filament\Resources\RegistroGates;

use App\Filament\Resources\RegistroGates\Pages\CreateRegistroGate;
use App\Filament\Resources\RegistroGates\Pages\EditRegistroGate;
use App\Filament\Resources\RegistroGates\Pages\ListRegistroGates;
use App\Filament\Resources\RegistroGates\Pages\ViewRegistroGate;
use App\Filament\Resources\RegistroGates\Schemas\RegistroGateForm;
use App\Filament\Resources\RegistroGates\Schemas\RegistroGateInfolist;
use App\Filament\Resources\RegistroGates\Tables\RegistroGatesTable;
use App\Models\RegistroGate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RegistroGateResource extends Resource
{
    protected static ?string $model = RegistroGate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowRightOnRectangle;

    protected static ?string $navigationLabel = 'Registros de Acesso';

    protected static ?string $modelLabel = 'Registro de Acesso';

    protected static ?string $pluralModelLabel = 'Registros de Acesso';

    protected static ?string $recordTitleAttribute = 'tipo';

    public static function form(Schema $schema): Schema
    {
        return RegistroGateForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RegistroGateInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegistroGatesTable::configure($table);
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
            'index' => ListRegistroGates::route('/'),
            'create' => CreateRegistroGate::route('/create'),
            'view' => ViewRegistroGate::route('/{record}'),
            'edit' => EditRegistroGate::route('/{record}/edit'),
        ];
    }
}
