<?php

namespace App\Filament\Resources\EstoqueEntradaResource\Pages;

use App\Filament\Resources\EstoqueEntradaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstoqueEntradas extends ListRecords
{
    protected static string $resource = EstoqueEntradaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
