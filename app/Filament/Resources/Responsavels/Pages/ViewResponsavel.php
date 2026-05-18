<?php

namespace App\Filament\Resources\Responsavels\Pages;

use App\Filament\Resources\Responsavels\ResponsavelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewResponsavel extends ViewRecord
{
    protected static string $resource = ResponsavelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
