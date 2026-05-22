<?php

namespace App\Filament\Resources\Turmas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TurmasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('periodo')
                    ->label('Período')
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(fn ($state): string => match ($state) {
                        'manha' => 'Manhã',
                        'tarde'  => 'Tarde',
                        'noite'  => 'Noite',
                        default  => ucfirst($state),
                    })
                    ->color(fn ($state): string => match ($state) {
                        'manha' => 'primary',
                        'tarde'  => 'warning',
                        'noite'  => 'info',
                        default  => 'gray',
                    }),
                TextColumn::make('ano_letivo')
                    ->label('Ano Letivo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateIcon(Heroicon::OutlinedBuildingLibrary)
            ->emptyStateHeading('Nenhuma turma cadastrada')
            ->emptyStateDescription('Crie as turmas antes de cadastrar alunos e professores.');
    }
}
