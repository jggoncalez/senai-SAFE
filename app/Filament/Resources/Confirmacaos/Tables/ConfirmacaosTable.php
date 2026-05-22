<?php

namespace App\Filament\Resources\Confirmacaos\Tables;

use App\Models\Autorizacao;
use App\Models\Confirmacao;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;


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
                    ->placeholder('—')
                    ->limit(50)
                    ->tooltip(fn ($state): ?string => strlen((string) $state) > 50 ? $state : null)
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('liberar_saida')
                    ->label('Liberar saída')
                    ->icon(Heroicon::OutlinedCheck)
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading(fn (Autorizacao $record): string => "Liberar saída de {$record->aluno->nome}?")
                    ->modalDescription(fn (Autorizacao $record): string => "Confirma que {$record->aluno->nome} pode sair da sala? ({$record->aulas_perdidas} aula(s) perdida(s))")
                    ->action(function (Autorizacao $record): void {
                        $professor = auth()->user()?->professor;
                        DB::transaction(function () use ($record, $professor): void {
                            if ($professor) {
                                Confirmacao::create([
                                    'autorizacao_id' => $record->id,
                                    'professor_id'   => $professor->id,
                                    'confirmado_at'  => now(),
                                ]);
                            }
                            $record->update(['status' => 'confirmado']);
                        });
                        Notification::make()
                            ->title("Saída de {$record->aluno->nome} liberada")
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('created_at', 'asc')
            ->emptyStateIcon(Heroicon::OutlinedCheckBadge)
            ->emptyStateHeading('Nenhuma liberação pendente')
            ->emptyStateDescription('Nenhum aluno aguarda liberação de saída da sala no momento.');
    }
}
