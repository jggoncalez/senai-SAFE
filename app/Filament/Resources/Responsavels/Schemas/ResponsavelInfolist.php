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
                TextEntry::make('aluno.nome')
                    ->label('Aluno'),
                TextEntry::make('nome')
                    ->label('Nome'),
                TextEntry::make('email')
                    ->label('E-mail'),
                TextEntry::make('telefone')
                    ->label('Telefone')
                    ->placeholder('-'),
                TextEntry::make('telegram_chat_id')
                    ->label('Chat ID do Telegram')
                    ->placeholder('-'),
                TextEntry::make('parentesco')
                    ->label('Parentesco'),
                TextEntry::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),
            ]);
    }
}
