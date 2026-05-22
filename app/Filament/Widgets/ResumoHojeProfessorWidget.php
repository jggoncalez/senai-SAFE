<?php

namespace App\Filament\Widgets;

use App\Models\Autorizacao;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ResumoHojeProfessorWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        return auth()->user()?->hasRole('professor') ?? false;
    }

    protected function getStats(): array
    {
        $user = auth()->user();
        $turmaId = $user?->professor?->turma_id;

        $baseQuery = fn () => Autorizacao::whereDate('created_at', today())
            ->when($turmaId, fn ($q) => $q->whereHas('aluno', fn ($q2) => $q2->where('turma_id', $turmaId)));

        $pendentesLiberacao = Autorizacao::saidas()
            ->aprovadas()
            ->pendentesConfirmacao()
            ->when($turmaId, fn ($q) => $q->whereHas('aluno', fn ($q2) => $q2->where('turma_id', $turmaId)))
            ->count();

        $pendentesEntrada = Autorizacao::entradas()
            ->aprovadas()
            ->pendentesConfirmacao()
            ->when($turmaId, fn ($q) => $q->whereHas('aluno', fn ($q2) => $q2->where('turma_id', $turmaId)))
            ->count();

        return [
            Stat::make('Autorizações da turma hoje', $baseQuery()->count())
                ->description('Criadas hoje para sua turma')
                ->descriptionIcon('heroicon-o-clipboard-document-check')
                ->color('primary'),

            Stat::make('Saídas aguardando liberação', $pendentesLiberacao)
                ->description('Alunos aguardando sua confirmação de saída')
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('warning'),

            Stat::make('Entradas aguardando confirmação', $pendentesEntrada)
                ->description('Alunos aguardando sua confirmação de entrada')
                ->descriptionIcon('heroicon-o-arrow-left-on-rectangle')
                ->color('info'),

            Stat::make('Aulas perdidas na turma', (int) $baseQuery()->sum('aulas_perdidas'))
                ->description('Total acumulado hoje na sua turma')
                ->descriptionIcon('heroicon-o-academic-cap')
                ->color('danger'),
        ];
    }
}
