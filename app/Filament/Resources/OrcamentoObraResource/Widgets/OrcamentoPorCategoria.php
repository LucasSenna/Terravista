<?php

namespace App\Filament\Resources\OrcamentoObraResource\Widgets;

use App\Models\OrcamentoObra;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrcamentoPorCategoria extends BaseWidget
{
    protected function getStats(): array
    {
        $totais = OrcamentoObra::selectRaw('categoria, SUM(quantidade_prevista * valor_unitario_previsto) as total')
            ->groupBy('categoria')
            ->pluck('total', 'categoria');

        return $totais->map(fn ($total, $categoria) =>
            Stat::make("Total em {$categoria}", 'R$ ' . number_format($total, 2, ',', '.'))
        )->values()->all();
    }
}
