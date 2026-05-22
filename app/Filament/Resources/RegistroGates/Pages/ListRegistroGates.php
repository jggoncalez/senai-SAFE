<?php

namespace App\Filament\Resources\RegistroGates\Pages;

use App\Filament\Resources\RegistroGates\RegistroGateResource;
use Filament\Resources\Pages\ListRecords;

class ListRegistroGates extends ListRecords
{
    protected static string $resource = RegistroGateResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
