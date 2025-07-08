<?php

namespace App\Filament\Resources\TransporteResource\Pages;

use App\Filament\Resources\TransporteResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransporte extends CreateRecord
{
    protected static string $resource = TransporteResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
