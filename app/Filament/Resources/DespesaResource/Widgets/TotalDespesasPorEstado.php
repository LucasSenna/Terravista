<?php

namespace App\Filament\Resources\DespesaResource\Widgets;

use App\Models\Despesa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalDespesasPorEstado extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pendente', 'R$ ' . number_format(
                Despesa::where('estado', 'pendente')->sum('valor'), 2, ',', '.'
            ))
            ->color('gray')
            ->extraAttributes(['class' => 'text-sm py-2 px-4']),

            Stat::make('Total Vencido', 'R$ ' . number_format(
                Despesa::where('estado', 'vencido')->sum('valor'), 2, ',', '.'
            ))
            ->color('danger')
            ->extraAttributes(['class' => 'text-sm py-2 px-4']),

            // Stat::make('Total Pago', 'R$ ' . number_format(
            //     Despesa::where('estado', 'pago')->sum('valor'), 2, ',', '.'
            // ))->color('success'),

            Stat::make('Total Agendado', 'R$ ' . number_format(
                Despesa::where('estado', 'agendado')->sum('valor'), 2, ',', '.'
            ))
            ->color('warning')
            ->extraAttributes(['class' => 'text-sm py-2 px-4']),
        ];
    }
}
