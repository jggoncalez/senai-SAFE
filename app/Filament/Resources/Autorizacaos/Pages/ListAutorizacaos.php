<?php

namespace App\Filament\Resources\Autorizacaos\Pages;

use App\Filament\Resources\Autorizacaos\AutorizacaoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAutorizacaos extends ListRecords
{
    protected static string $resource = AutorizacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
