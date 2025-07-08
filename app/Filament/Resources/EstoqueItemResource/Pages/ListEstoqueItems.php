<?php

namespace App\Filament\Resources\EstoqueItemResource\Pages;

use App\Filament\Resources\EstoqueItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstoqueItems extends ListRecords
{
    protected static string $resource = EstoqueItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\EstoqueItemResource\Widgets\TotalEntradasEstoque::class,
            \App\Filament\Resources\EstoqueItemResource\Widgets\SaldoEstoqueAtual::class,
        ];
    }
}
