<?php

namespace App\Filament\Resources\Confirmacaos\Tables;

use App\Models\Autorizacao;
use App\Models\Confirmacao;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConfirmacaosTable
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
                    ->sortable(),
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
                TextColumn::make('observacao')
                    ->label('Observação')
                    ->placeholder('-')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('confirmar_entrada')
                    ->label('Confirmar entrada na sala')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Autorizacao $record) {
                        $professor = auth()->user()?->professor;
                        if ($professor) {
                            Confirmacao::create([
                                'autorizacao_id' => $record->id,
                                'professor_id'   => $professor->id,
                                'confirmado_at'  => now(),
                            ]);
                        }
                        $record->update(['status' => 'concluido']);
                    }),
            ]);
    }
}
