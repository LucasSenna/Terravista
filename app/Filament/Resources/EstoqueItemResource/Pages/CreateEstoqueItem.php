<?php

namespace App\Filament\Resources\EstoqueItemResource\Pages;

use App\Filament\Resources\EstoqueItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEstoqueItem extends CreateRecord
{
    protected static string $resource = EstoqueItemResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
