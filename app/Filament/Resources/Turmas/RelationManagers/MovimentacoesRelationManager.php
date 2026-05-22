<?php

namespace App\Filament\Resources\Turmas\RelationManagers;

use App\Models\RegistroGate;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MovimentacoesRelationManager extends RelationManager
{
    protected static string $relationship = 'alunos';

    protected static ?string $title = 'Movimentações do Dia';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                RegistroGate::query()
                    ->whereHas(
                        'autorizacao.aluno',
                        fn (Builder $q) => $q->where('turma_id', $this->getOwnerRecord()->id)
                    )
                    ->whereDate('registrado_at', today())
                    ->with(['autorizacao.aluno', 'user'])
                    ->latest('registrado_at')
            )
            ->columns([
                TextColumn::make('autorizacao.aluno.nome')
                    ->label('Aluno')
                    ->sortable(),
                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'saida' ? 'Saída' : 'Entrada')
                    ->color(fn ($state) => $state === 'saida' ? 'warning' : 'success'),
                TextColumn::make('registrado_at')
                    ->label('Horário')
                    ->time('H:i')
                    ->sortable(),
                TextColumn::make('aulas_perdidas')
                    ->label('Aulas Perdidas')
                    ->badge()
                    ->color(fn ($state): string => match (true) {
                        $state == 0 => 'success',
                        $state <= 2 => 'warning',
                        default     => 'danger',
                    })
                    ->alignCenter(),
                TextColumn::make('user.name')
                    ->label('Registrado por')
                    ->toggleable(),
            ])
            ->defaultSort('registrado_at', 'desc')
            ->paginated(false);
    }
}
