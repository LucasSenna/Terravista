<?php

namespace App\Filament\Resources\LancamentoTransporteResource\Pages;

use App\Filament\Resources\LancamentoTransporteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLancamentoTransporte extends EditRecord
{
    protected static string $resource = LancamentoTransporteResource::class;

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
