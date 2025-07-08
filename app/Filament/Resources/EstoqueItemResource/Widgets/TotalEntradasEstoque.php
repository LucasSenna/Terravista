<?php

namespace App\Filament\Resources\EstoqueItemResource\Widgets;

use App\Models\EstoqueItem;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget;

class TotalEntradasEstoque extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total = EstoqueItem::query()
            ->whereMonth('data', now()->month)
            ->whereYear('data', now()->year)
            ->sum('valor_total');

        return [
            Stat::make('Entradas no Mês', 'R$ ' . number_format($total, 2, ',', '.')),
        ];
    }

    protected function getColumns(): int
    {
        return 1;
    }
}
