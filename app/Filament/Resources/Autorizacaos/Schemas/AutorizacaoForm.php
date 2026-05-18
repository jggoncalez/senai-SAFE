<?php

namespace App\Filament\Resources\Autorizacaos\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AutorizacaoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('aluno_id')
                    ->relationship('aluno', 'id')
                    ->required(),
                Select::make('responsavel_id')
                    ->relationship('responsavel', 'id')
                    ->required(),
                TextInput::make('tipo')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('pendente'),
                DateTimePicker::make('validade')
                    ->required(),
                Textarea::make('observacao')
                    ->columnSpanFull(),
            ]);
    }
}
