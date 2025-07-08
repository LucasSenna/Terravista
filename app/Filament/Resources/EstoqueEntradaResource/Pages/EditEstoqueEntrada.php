<?php

namespace App\Filament\Resources\EstoqueEntradaResource\Pages;

use App\Filament\Resources\EstoqueEntradaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstoqueEntrada extends EditRecord
{
    protected static string $resource = EstoqueEntradaResource::class;

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
