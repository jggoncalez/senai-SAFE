<?php

namespace App\Filament\Resources\Responsavels\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ResponsavelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('aluno_id')
                    ->relationship('aluno', 'id')
                    ->required(),
                TextInput::make('nome')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('telefone')
                    ->tel(),
                TextInput::make('telegram_chat_id')
                    ->tel(),
                TextInput::make('parentesco')
                    ->required(),
            ]);
    }
}
