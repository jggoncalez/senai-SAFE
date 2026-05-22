<?php

namespace App\Filament\Resources\Alunos;

use App\Filament\Resources\Alunos\Pages\CreateAluno;
use App\Filament\Resources\Alunos\Pages\EditAluno;
use App\Filament\Resources\Alunos\Pages\ListAlunos;
use App\Filament\Resources\Alunos\Pages\ViewAluno;
use App\Filament\Resources\Alunos\Schemas\AlunoForm;
use App\Filament\Resources\Alunos\Schemas\AlunoInfolist;
use App\Filament\Resources\Alunos\Tables\AlunosTable;
use App\Models\Aluno;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AlunoResource extends Resource
{
    protected static ?string $model = Aluno::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static string|UnitEnum|null $navigationGroup = 'Escola';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Alunos';

    public static function getNavigationDescription(): ?string
    {
        return 'Alunos matriculados no sistema';
    }

    protected static ?string $modelLabel = 'Aluno';

    protected static ?string $pluralModelLabel = 'Alunos';

    protected static ?string $recordTitleAttribute = 'nome';

    public static function form(Schema $schema): Schema
    {
        return AlunoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AlunoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AlunosTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['turma', 'responsavelPrincipal']);
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
            'index' => ListAlunos::route('/'),
            'create' => CreateAluno::route('/create'),
            'view' => ViewAluno::route('/{record}'),
            'edit' => EditAluno::route('/{record}/edit'),
        ];
    }
}
