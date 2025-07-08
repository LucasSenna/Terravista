<?php

namespace App\Filament\Resources\EstoqueSaidaResource\Pages;

use App\Filament\Resources\EstoqueSaidaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstoqueSaida extends EditRecord
{
    protected static string $resource = EstoqueSaidaResource::class;

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
