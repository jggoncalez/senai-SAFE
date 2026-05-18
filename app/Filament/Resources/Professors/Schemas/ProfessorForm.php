<?php

namespace App\Filament\Resources\Professors\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProfessorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('turma_id')
                    ->relationship('turma', 'id')
                    ->required(),
                TextInput::make('nome')
                    ->required(),
                TextInput::make('matricula')
                    ->required(),
            ]);
    }
}
