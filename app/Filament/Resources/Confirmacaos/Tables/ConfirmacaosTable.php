<?php

namespace App\Filament\Resources\Confirmacaos\Tables;

use App\Models\Autorizacao;
use App\Models\Confirmacao;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
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
                    ->sortable()
                    ->weight('bold'),
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
                TextColumn::make('created_at')
                    ->label('Aguardando há')
                    ->since()
                    ->sortable(),
                TextColumn::make('observacao')
                    ->label('Observação')
                    ->placeholder('-')
                    ->limit(50)
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('liberar_aluno')
                    ->label('Liberar aluno')
                    ->icon(Heroicon::OutlinedCheck)
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading(fn (Autorizacao $record): string => "Liberar {$record->aluno->nome}?")
                    ->modalDescription(fn (Autorizacao $record): string => "Confirma a entrada de {$record->aluno->nome} na sala? ({$record->aulas_perdidas} aula(s) perdida(s))")
                    ->action(function (Autorizacao $record): void {
                        $professor = auth()->user()?->professor;
                        if ($professor) {
                            Confirmacao::create([
                                'autorizacao_id' => $record->id,
                                'professor_id'   => $professor->id,
                                'confirmado_at'  => now(),
                            ]);
                        }
                        $record->update(['status' => 'concluido']);
                        Notification::make()
                            ->title("Entrada de {$record->aluno->nome} confirmada")
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('created_at', 'asc');
    }
}
