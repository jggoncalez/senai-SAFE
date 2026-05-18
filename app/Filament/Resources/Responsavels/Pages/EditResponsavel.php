<?php

namespace App\Filament\Resources\Responsavels\Pages;

use App\Filament\Resources\Responsavels\ResponsavelResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditResponsavel extends EditRecord
{
    protected static string $resource = ResponsavelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
