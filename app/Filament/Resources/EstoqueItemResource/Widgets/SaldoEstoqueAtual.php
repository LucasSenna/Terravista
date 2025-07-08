<?php

namespace App\Filament\Resources\EstoqueItemResource\Widgets;

use App\Models\EstoqueItem;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget;

class SaldoEstoqueAtual extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total = EstoqueItem::sum('valor_total');

        return [
            Stat::make('Saldo Atual em Estoque', 'R$ ' . number_format($total, 2, ',', '.')),
        ];
    }

    protected function getColumns(): int
    {
        return 1;
    }
}
