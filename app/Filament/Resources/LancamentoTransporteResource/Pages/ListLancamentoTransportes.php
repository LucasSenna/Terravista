<?php

namespace App\Filament\Resources\LancamentoTransporteResource\Pages;

use App\Filament\Resources\LancamentoTransporteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLancamentoTransportes extends ListRecords
{
    protected static string $resource = LancamentoTransporteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\LancamentoTransporteResource\Widgets\TotalTransportado::class,
        ];
    }
}
