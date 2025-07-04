<?php

namespace App\Filament\Resources\ObraResource\Pages;

use App\Filament\Resources\ObraResource;
use Filament\Resources\Pages\CreateRecord;

class CreateObra extends CreateRecord
{
    protected static string $resource = ObraResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
