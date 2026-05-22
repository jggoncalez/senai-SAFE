<?php

namespace App\Filament\Resources\Confirmacaos\Pages;

use App\Filament\Resources\Confirmacaos\ConfirmacaoResource;
use Filament\Resources\Pages\ListRecords;

class ListConfirmacaos extends ListRecords
{
    protected static string $resource = ConfirmacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
