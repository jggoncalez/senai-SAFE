<?php

namespace App\Filament\Resources\EntradasPendentes\Tables;

use App\Models\Autorizacao;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EntradasPendentesTable
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
            ])
            ->recordActions([
                Action::make('confirmar_entrada')
                    ->label('Confirmar entrada')
                    ->icon(Heroicon::OutlinedCheck)
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalHeading(fn (Autorizacao $record): string => "Confirmar entrada de {$record->aluno->nome}?")
                    ->modalDescription(fn (Autorizacao $record): string => "Turma: {$record->aluno->turma->nome} — Aulas perdidas: {$record->aulas_perdidas}")
                    ->action(function (Autorizacao $record): void {
                        $professor = auth()->user()?->professor;

                        if ($professor) {
                            \App\Models\Confirmacao::create([
                                'autorizacao_id' => $record->id,
                                'professor_id'   => $professor->id,
                                'confirmado_at'  => now(),
                            ]);
                        }

                        \App\Models\RegistroGate::create([
                            'autorizacao_id' => $record->id,
                            'user_id'        => auth()->id(),
                            'tipo'           => 'entrada',
                            'registrado_at'  => now(),
                            'aulas_perdidas' => $record->aulas_perdidas,
                        ]);

                        $record->update(['status' => 'concluido']);

                        Notification::make()
                            ->title("Entrada de {$record->aluno->nome} confirmada")
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('created_at', 'asc')
            ->emptyStateIcon(Heroicon::OutlinedArrowLeftOnRectangle)
            ->emptyStateHeading('Nenhuma entrada pendente')
            ->emptyStateDescription('Nenhum aluno aguarda confirmação de entrada.');
    }
}
