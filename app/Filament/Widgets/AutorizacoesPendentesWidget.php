<?php

namespace App\Filament\Widgets;

use App\Models\Autorizacao;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class AutorizacoesPendentesWidget extends TableWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Autorizações Aprovadas Pendentes';

    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Autorizacao::query()
            ->where('status', 'aprovado')
            ->whereDoesntHave('confirmacao')
            ->whereDoesntHave('registrosGate')
            ->with(['aluno.turma'])
            ->latest()
            ->limit(5);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                TextColumn::make('aluno.nome')
                    ->label('Aluno')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('aluno.turma.nome')
                    ->label('Turma')
                    ->sortable(),
                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'saida' ? 'Saída' : 'Entrada')
                    ->color(fn ($state) => $state === 'saida' ? 'danger' : 'success'),
                TextColumn::make('aulas_perdidas')
                    ->label('Aulas Perdidas')
                    ->badge()
                    ->color(fn ($state): string => match (true) {
                        $state == 0 => 'success',
                        $state <= 2 => 'warning',
                        default     => 'danger',
                    })
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->label('Criado')
                    ->since()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'asc')
            ->paginated(false)
            ->emptyStateIcon(\Filament\Support\Icons\Heroicon::OutlinedClipboardDocumentCheck)
            ->emptyStateHeading('Nenhuma autorização pendente')
            ->emptyStateDescription('Todas as autorizações aprovadas já foram processadas.');
    }
}
