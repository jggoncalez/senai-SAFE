<?php

namespace App\Filament\Resources\RegistroGates\Tables;

use App\Models\Autorizacao;
use App\Models\RegistroGate;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RegistroGatesTable
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
                    ->description(fn (Autorizacao $record): string => $record->aluno->turma->periodo ?? '')
                    ->sortable(),
                TextColumn::make('aulas_perdidas')
                    ->label('Aulas Perdidas')
                    ->badge()
                    ->color(fn ($state): string => match (true) {
                        $state == 0 => 'success',
                        $state <= 2 => 'warning',
                        default     => 'danger',
                    })
                    ->icon(fn ($state) => $state > 2 ? Heroicon::OutlinedExclamationTriangle : null)
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Aguardando há')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('registrar')
                    ->label('Registrar saída')
                    ->icon(Heroicon::OutlinedArrowRightOnRectangle)
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading(fn (Autorizacao $record): string => "Registrar saída de {$record->aluno->nome}?")
                    ->modalDescription(fn (Autorizacao $record): string => "Turma: {$record->aluno->turma->nome} — Aulas perdidas: {$record->aulas_perdidas}")
                    ->action(function (Autorizacao $record): void {
                        $agora = now();
                        RegistroGate::create([
                            'autorizacao_id' => $record->id,
                            'user_id'        => auth()->id(),
                            'tipo'           => $record->tipo,
                            'registrado_at'  => $agora,
                            'aulas_perdidas' => $record->aulas_perdidas,
                        ]);
                        $record->update(['status' => 'concluido']);
                        Notification::make()
                            ->title("Saída de {$record->aluno->nome} registrada às {$agora->format('H:i')}")
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('created_at', 'asc');
    }
}
