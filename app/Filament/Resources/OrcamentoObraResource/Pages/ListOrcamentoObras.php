<?php

namespace App\Filament\Resources\OrcamentoObraResource\Pages;

use App\Filament\Resources\OrcamentoObraResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrcamentoObras extends ListRecords
{
    protected static string $resource = OrcamentoObraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\OrcamentoObraResource\Widgets\TotalGeralOrcamento::class,
            \App\Filament\Resources\OrcamentoObraResource\Widgets\OrcamentoPorCategoria::class,
        ];
    }
}
