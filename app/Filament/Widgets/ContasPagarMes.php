<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContasPagarMes extends BaseWidget
{
    protected function getStats(): array
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();

        $total = DB::table('despesas')
            ->whereBetween('vencimento', [$inicioMes, $fimMes])
            ->sum('valor');

        return [
            Stat::make('Contas a Pagar (Mês)', 'R$ ' . number_format($total, 2, ',', '.'))
                ->description('Soma das despesas com vencimento neste mês')
                ->color('warning'),
        ];
    }
    protected function getColumns(): int
    {
        return 2;
    }
}
