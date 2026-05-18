<?php

namespace App\Filament\Resources\RegistroGates\Pages;

use App\Filament\Resources\RegistroGates\RegistroGateResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRegistroGate extends EditRecord
{
    protected static string $resource = RegistroGateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
