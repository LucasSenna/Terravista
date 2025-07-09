<?php

namespace App\Filament\Widgets;

use App\Models\Obra;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalObrasAndamento extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Obra::where('status', 'em andamento')->count();

        return [
            Stat::make('Obras em Andamento', $total)
                ->description('Total de obras atualmente ativas')
                ->color('success'),
        ];
    }
    
    protected function getColumns(): int
    {
        return 2;
    }
}
