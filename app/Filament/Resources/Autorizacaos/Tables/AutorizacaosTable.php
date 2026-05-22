<?php

namespace App\Filament\Resources\Autorizacaos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AutorizacaosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('aluno.nome')
                    ->label('Aluno')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('aluno.turma.nome')
                    ->label('Turma')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'saida' ? 'Saída' : 'Entrada')
                    ->color(fn ($state): string => $state === 'saida' ? 'danger' : 'success'),
                TextColumn::make('aulas_perdidas')
                    ->label('Aulas Perdidas')
                    ->badge()
                    ->color(fn ($state): string => match (true) {
                        $state == 0 => 'success',
                        $state <= 2 => 'warning',
                        default     => 'danger',
                    })
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => match ($state) {
                        'aprovado'   => 'Aprovado',
                        'confirmado' => 'Confirmado',
                        'concluido'  => 'Concluído',
                        'cancelado'  => 'Cancelado',
                        default      => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'aprovado'   => 'info',
                        'confirmado' => 'warning',
                        'concluido'  => 'success',
                        'cancelado'  => 'danger',
                        default      => 'gray',
                    }),
                TextColumn::make('aqv.name')
                    ->label('Criado por')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->since()
                    ->sortable(),
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
            ->defaultSort('created_at', 'desc');
    }
}
