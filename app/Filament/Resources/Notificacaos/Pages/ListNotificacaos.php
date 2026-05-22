<?php

namespace App\Filament\Resources\Notificacaos\Pages;

use App\Filament\Resources\Notificacaos\NotificacaoResource;
use Filament\Resources\Pages\ListRecords;

class ListNotificacaos extends ListRecords
{
    protected static string $resource = NotificacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
