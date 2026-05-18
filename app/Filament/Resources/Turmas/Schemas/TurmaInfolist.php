<?php

namespace App\Filament\Resources\Turmas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TurmaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nome'),
                TextEntry::make('periodo'),
                TextEntry::make('ano_letivo'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
