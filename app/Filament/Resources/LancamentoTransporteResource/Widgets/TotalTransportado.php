<?php

namespace App\Filament\Resources\LancamentoTransporteResource\Widgets;

use App\Models\LancamentoTransporte;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class TotalTransportado extends BaseWidget
{
    protected function getStats(): array
    {
        $mesAtual = now()->format('Y-m');
        
        $totalMes = LancamentoTransporte::where('data', 'like', "$mesAtual%")
            ->sum(DB::raw('km * valor_km'));

        return [
            Stat::make('Total Transportado no Mês', 'R$ ' . number_format($totalMes, 2, ',', '.')),
        ];
    }
}
