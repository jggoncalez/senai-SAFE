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
                TextEntry::make('aluno.nome')
                    ->label('Aluno'),
                TextEntry::make('responsavel.nome')
                    ->label('Responsável'),
                TextEntry::make('tipo')
                    ->label('Tipo'),
                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'aprovado'  => 'success',
                        'reprovado' => 'danger',
                        default     => 'warning',
                    }),
                TextEntry::make('validade')
                    ->label('Validade')
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
