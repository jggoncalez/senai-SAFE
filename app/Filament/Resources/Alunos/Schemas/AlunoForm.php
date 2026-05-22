<?php

namespace App\Filament\Resources\Alunos\Schemas;

use App\Models\Responsavel;
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
                    ->label('Turma')
                    ->relationship('turma', 'nome')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('responsavel_principal_id')
                    ->label('Responsável Principal')
                    ->options(function ($record): array {
                        if (! $record?->exists) {
                            return [];
                        }
                        return Responsavel::where('aluno_id', $record->id)
                            ->pluck('nome', 'id')
                            ->toArray();
                    })
                    ->searchable()
                    ->nullable()
                    ->helperText(fn ($record) => ! $record?->exists
                        ? 'Salve o aluno primeiro para poder definir o responsável principal.'
                        : null
                    ),
                TextInput::make('nome')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                TextInput::make('matricula')
                    ->label('Matrícula')
                    ->required()
                    ->maxLength(50),
                TextInput::make('foto_url')
                    ->label('Foto (URL)')
                    ->url()
                    ->maxLength(2048),
            ]);
    }
}
