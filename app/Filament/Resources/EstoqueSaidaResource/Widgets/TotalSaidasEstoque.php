<?php

namespace App\Filament\Resources\EstoqueSaidaResource\Widgets;

use App\Models\EstoqueSaida;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget;

class TotalSaidasEstoque extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $query = EstoqueSaida::query();

        // Filtro por mês atual
        $query->whereMonth('data', now()->month)
              ->whereYear('data', now()->year);

        // Se quiser filtrar por obra específica, adicione:
        // $obraId = request()->get('obra_id');
        // if ($obraId) {
        //     $query->whereHas('item', fn($q) => $q->where('obra_id', $obraId));
        // }

        $total = $query->get()
            ->sum(fn ($saida) => $saida->quantidade * ($saida->valor_unitario ?? 0));

        return [
            Stat::make('Total de Saídas do Mês', 'R$ ' . number_format($total, 2, ',', '.')),
        ];
    }

    protected function getColumns(): int
    {
        return 1; // Deixa menor, pode aumentar se quiser mais estatísticas
    }
}
