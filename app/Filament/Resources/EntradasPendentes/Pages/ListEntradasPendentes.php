<?php

namespace App\Filament\Resources\EntradasPendentes\Pages;

use App\Filament\Resources\EntradasPendentes\EntradasPendentesResource;
use Filament\Resources\Pages\ListRecords;

class ListEntradasPendentes extends ListRecords
{
    protected static string $resource = EntradasPendentesResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
