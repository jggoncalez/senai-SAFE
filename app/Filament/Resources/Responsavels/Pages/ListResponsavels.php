<?php

namespace App\Filament\Resources\Responsavels\Pages;

use App\Filament\Resources\Responsavels\ResponsavelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResponsavels extends ListRecords
{
    protected static string $resource = ResponsavelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
