<?php

namespace App\Filament\Resources\Autorizacaos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AutorizacaoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('aluno.id')
                    ->label('Aluno'),
                TextEntry::make('responsavel.id')
                    ->label('Responsavel'),
                TextEntry::make('tipo'),
                TextEntry::make('status'),
                TextEntry::make('validade')
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
