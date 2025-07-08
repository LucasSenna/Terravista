<?php

namespace App\Filament\Resources\OrcamentoObraResource\Widgets;

use App\Models\OrcamentoObra;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalGeralOrcamento extends BaseWidget
{
    protected function getStats(): array
    {
        $total = OrcamentoObra::selectRaw('SUM(quantidade_prevista * valor_unitario_previsto) as total')->value('total') ?? 0;

        return [
            Stat::make('Total Geral Previsto', 'R$ ' . number_format($total, 2, ',', '.')),
        ];
    }
}
