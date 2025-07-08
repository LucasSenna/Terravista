<?php

namespace App\Filament\Resources\EstoqueSaidaResource\Pages;

use App\Filament\Resources\EstoqueSaidaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstoqueSaidas extends ListRecords
{
    protected static string $resource = EstoqueSaidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\EstoqueSaidaResource\Widgets\TotalSaidasEstoque::class,
        ];
    }
}
