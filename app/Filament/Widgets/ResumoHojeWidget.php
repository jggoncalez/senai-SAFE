<?php

namespace App\Filament\Widgets;

use App\Models\Autorizacao;
use App\Models\Notificacao;
use App\Models\RegistroGate;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ResumoHojeWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Autorizações hoje', Autorizacao::whereDate('created_at', today())->count())
                ->description('Criadas no dia de hoje')
                ->color('primary'),

            Stat::make('Saídas registradas', RegistroGate::whereDate('registrado_at', today())->where('tipo', 'saida')->count())
                ->description('Saídas confirmadas pela portaria')
                ->color('warning'),

            Stat::make('Notificações enviadas', Notificacao::whereDate('created_at', today())->where('status', 'enviado')->count())
                ->description('E-mails enviados hoje')
                ->color('success'),

            Stat::make('Aulas perdidas hoje', (int) Autorizacao::whereDate('created_at', today())->sum('aulas_perdidas'))
                ->description('Total acumulado no dia')
                ->color('danger'),
        ];
    }
}
