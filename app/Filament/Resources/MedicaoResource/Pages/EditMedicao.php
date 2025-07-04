<?php

namespace App\Filament\Resources\MedicaoResource\Pages;

use App\Filament\Resources\MedicaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicao extends EditRecord
{
    protected static string $resource = MedicaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
