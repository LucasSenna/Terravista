<?php

namespace App\Filament\Resources\PrestadorResource\Pages;

use App\Filament\Resources\PrestadorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrestadores extends ListRecords
{
    protected static string $resource = PrestadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
