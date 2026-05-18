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
                    ->label('Autorização'),
                TextEntry::make('user.name')
                    ->label('Registrado por'),
                TextEntry::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'entrada' => 'success',
                        'saida'   => 'danger',
                        default   => 'gray',
                    }),
                TextEntry::make('registrado_at')
                    ->label('Registrado em')
                    ->dateTime('d/m/Y H:i'),
                TextEntry::make('observacao')
                    ->label('Observação')
                    ->placeholder('-')
                    ->columnSpanFull(),
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
