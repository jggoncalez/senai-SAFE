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
                    ->label('Aluno')
                    ->relationship('aluno', 'nome')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('nome')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255)
                    ->autofocus(),
                TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('telefone')
                    ->label('Telefone')
                    ->tel()
                    ->maxLength(20),
                TextInput::make('telegram_chat_id')
                    ->label('Chat ID do Telegram')
                    ->maxLength(50)
                    ->placeholder('Ex: 123456789')
                    ->helperText('Necessário para receber notificações pelo Telegram.'),
                TextInput::make('parentesco')
                    ->label('Parentesco')
                    ->required()
                    ->maxLength(100),
            ]);
    }
}
