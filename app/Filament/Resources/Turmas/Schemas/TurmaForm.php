<?php

namespace App\Filament\Resources\Turmas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TurmaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome')
                    ->required()
                    ->maxLength(100)
                    ->autofocus(),
                Select::make('periodo')
                    ->label('Período')
                    ->options([
                        'manha' => 'Manhã',
                        'tarde'  => 'Tarde',
                        'noite'  => 'Noite',
                    ])
                    ->required(),
                TextInput::make('ano_letivo')
                    ->label('Ano Letivo')
                    ->required()
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue(2099),
            ]);
    }
}
