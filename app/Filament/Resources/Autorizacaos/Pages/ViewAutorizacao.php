<?php

namespace App\Filament\Resources\Autorizacaos\Pages;

use App\Filament\Resources\Autorizacaos\AutorizacaoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAutorizacao extends ViewRecord
{
    protected static string $resource = AutorizacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
