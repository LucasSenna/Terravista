<?php

namespace App\Filament\Resources\LocalObraResource\Pages;

use App\Filament\Resources\LocalObraResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLocalObra extends CreateRecord
{
    protected static string $resource = LocalObraResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
