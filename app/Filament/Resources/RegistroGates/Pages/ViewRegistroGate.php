<?php

namespace App\Filament\Resources\RegistroGates\Pages;

use App\Filament\Resources\RegistroGates\RegistroGateResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRegistroGate extends ViewRecord
{
    protected static string $resource = RegistroGateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
