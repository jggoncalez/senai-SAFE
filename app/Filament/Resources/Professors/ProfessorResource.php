<?php

namespace App\Filament\Resources\Professors;

use App\Filament\Resources\Professors\Pages\CreateProfessor;
use App\Filament\Resources\Professors\Pages\EditProfessor;
use App\Filament\Resources\Professors\Pages\ListProfessors;
use App\Filament\Resources\Professors\Pages\ViewProfessor;
use App\Filament\Resources\Professors\Schemas\ProfessorForm;
use App\Filament\Resources\Professors\Schemas\ProfessorInfolist;
use App\Filament\Resources\Professors\Tables\ProfessorsTable;
use App\Models\Professor;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProfessorResource extends Resource
{
    protected static ?string $model = Professor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static string|UnitEnum|null $navigationGroup = 'Escola';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Professores';

    public static function getNavigationDescription(): ?string
    {
        return 'Professores responsáveis pelas turmas';
    }

    protected static ?string $modelLabel = 'Professor';

    protected static ?string $pluralModelLabel = 'Professores';

    protected static ?string $recordTitleAttribute = 'nome';

    public static function form(Schema $schema): Schema
    {
        return ProfessorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProfessorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfessorsTable::configure($table);
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
            'index' => ListProfessors::route('/'),
            'create' => CreateProfessor::route('/create'),
            'view' => ViewProfessor::route('/{record}'),
            'edit' => EditProfessor::route('/{record}/edit'),
        ];
    }
}
