<?php

namespace App\Filament\Resources\LocalObraResource\Pages;

use App\Filament\Resources\LocalObraResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLocalObras extends ListRecords
{
    protected static string $resource = LocalObraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
