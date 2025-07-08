<?php

namespace App\Filament\Resources\OrcamentoObraResource\Pages;

use App\Filament\Resources\OrcamentoObraResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrcamentoObra extends EditRecord
{
    protected static string $resource = OrcamentoObraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
