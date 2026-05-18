<?php

namespace App\Filament\Resources\RegistroGates\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RegistroGateInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('autorizacao.id')
                    ->label('Autorizacao'),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('tipo'),
                TextEntry::make('registrado_at')
                    ->dateTime(),
                TextEntry::make('observacao')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
