<?php

namespace App\Filament\Resources\EstoqueItemResource\Pages;

use App\Filament\Resources\EstoqueItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstoqueItem extends EditRecord
{
    protected static string $resource = EstoqueItemResource::class;

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
