<?php

namespace App\Filament\Resources\MedicaoResource\Pages;

use App\Filament\Resources\MedicaoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMedicao extends CreateRecord
{
    protected static string $resource = MedicaoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
