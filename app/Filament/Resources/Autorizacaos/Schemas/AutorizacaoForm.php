<?php

namespace App\Filament\Resources\Autorizacaos\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AutorizacaoForm
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
                Select::make('responsavel_id')
                    ->label('Responsável')
                    ->relationship('responsavel', 'nome')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('tipo')
                    ->label('Tipo')
                    ->required()
                    ->maxLength(100),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pendente'  => 'Pendente',
                        'aprovado'  => 'Aprovado',
                        'reprovado' => 'Reprovado',
                    ])
                    ->default('pendente')
                    ->required(),
                DateTimePicker::make('validade')
                    ->label('Validade')
                    ->required(),
                Textarea::make('observacao')
                    ->label('Observação')
                    ->columnSpanFull(),
            ]);
    }
}
