<?php

namespace App\Filament\Resources\EstoqueEntradaResource\Pages;

use App\Filament\Resources\EstoqueEntradaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEstoqueEntrada extends CreateRecord
{
    protected static string $resource = EstoqueEntradaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
