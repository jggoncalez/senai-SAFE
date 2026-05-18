<?php

namespace App\Filament\Resources\Alunos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AlunoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('turma_id')
                    ->relationship('turma', 'id')
                    ->required(),
                TextInput::make('nome')
                    ->required(),
                TextInput::make('matricula')
                    ->required(),
                TextInput::make('foto_url')
                    ->url(),
            ]);
    }
}
