<?php

namespace App\Filament\Resources\MedicaoResource\Pages;

use App\Filament\Resources\MedicaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicaos extends ListRecords
{
    protected static string $resource = MedicaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
