<?php

namespace App\Filament\Resources\LocalObraResource\Pages;

use App\Filament\Resources\LocalObraResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLocalObra extends EditRecord
{
    protected static string $resource = LocalObraResource::class;

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
