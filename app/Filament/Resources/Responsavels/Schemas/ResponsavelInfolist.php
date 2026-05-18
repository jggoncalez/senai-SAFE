<?php

namespace App\Filament\Resources\Responsavels\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ResponsavelInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('aluno.id')
                    ->label('Aluno'),
                TextEntry::make('nome'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('telefone')
                    ->placeholder('-'),
                TextEntry::make('telegram_chat_id')
                    ->placeholder('-'),
                TextEntry::make('parentesco'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
