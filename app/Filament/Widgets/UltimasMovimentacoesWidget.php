<?php

namespace App\Filament\Widgets;

use App\Models\RegistroGate;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class UltimasMovimentacoesWidget extends TableWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'Últimas Movimentações do Dia';

    protected static ?string $pollingInterval = '30s';

    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return RegistroGate::query()
            ->whereDate('registrado_at', today())
            ->with(['autorizacao.aluno.turma', 'user'])
            ->latest('registrado_at')
            ->limit(10);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                TextColumn::make('autorizacao.aluno.nome')
                    ->label('Aluno')
                    ->searchable(),
                TextColumn::make('autorizacao.aluno.turma.nome')
                    ->label('Turma'),
                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'saida' ? 'Saída' : 'Entrada')
                    ->color(fn ($state) => $state === 'saida' ? 'warning' : 'success'),
                TextColumn::make('registrado_at')
                    ->label('Horário')
                    ->time('H:i')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Portaria'),
            ])
            ->defaultSort('registrado_at', 'desc')
            ->paginated(false);
    }
}
