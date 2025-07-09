<?php

namespace App\Filament\Widgets;

use App\Models\EstoqueItem;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalMateriaisEstoque extends BaseWidget
{
    protected function getStats(): array
    {
        $total = EstoqueItem::sum('quantidade_total');

        return [
            Stat::make('Qtd Total em Estoque', $total)
                ->description('Quantidade total de materiais')
                ->color('primary'),
        ];
    }

    protected function getColumns(): int
    {
        return 2;
    }
}
