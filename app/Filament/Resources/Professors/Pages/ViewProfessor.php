<?php

namespace App\Filament\Resources\Professors\Pages;

use App\Filament\Resources\Professors\ProfessorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProfessor extends ViewRecord
{
    protected static string $resource = ProfessorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
