<?php

namespace App\Filament\Widgets;

use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalPrevistoOrcamento extends BaseWidget
{
    protected function getStats(): array
    {
        $total = DB::table('orcamentos_obra')->sum(DB::raw('quantidade_prevista * valor_unitario_previsto'));

        return [
            Stat::make('Total Previsto (Obras)', 'R$ ' . number_format($total, 2, ',', '.'))
                ->description('Custo orçado total')
                ->color('gray'),
        ];
    }

    protected function getColumns(): int
    {
        return 2;
    }
}
