<?php

namespace App\Filament\Resources\Autorizacaos\Pages;

use App\Filament\Resources\Autorizacaos\AutorizacaoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAutorizacao extends EditRecord
{
    protected static string $resource = AutorizacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
