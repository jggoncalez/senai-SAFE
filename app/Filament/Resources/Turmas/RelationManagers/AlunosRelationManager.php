<?php

namespace App\Filament\Resources\Turmas\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AlunosRelationManager extends RelationManager
{
    protected static string $relationship = 'alunos';

    protected static ?string $title = 'Alunos Matriculados';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('matricula')
                    ->label('Matrícula')
                    ->searchable(),
                TextColumn::make('responsavelPrincipal.nome')
                    ->label('Responsável Principal')
                    ->placeholder('—')
                    ->searchable(),
            ])
            ->defaultSort('nome');
    }
}
