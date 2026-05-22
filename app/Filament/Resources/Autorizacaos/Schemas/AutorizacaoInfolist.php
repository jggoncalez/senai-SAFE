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
                TextEntry::make('aluno.turma.nome')
                    ->label('Turma'),
                TextEntry::make('aqv.name')
                    ->label('Criado por (AQV)'),
                TextEntry::make('tipo')
                    ->label('Tipo'),
                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'aprovado'   => 'success',
                        'confirmado' => 'info',
                        'concluido'  => 'gray',
                        'cancelado'  => 'danger',
                        default      => 'gray',
                    }),
                TextEntry::make('aulas_perdidas')
                    ->label('Aulas Perdidas')
                    ->badge()
                    ->color(fn ($state): string => match (true) {
                        $state == 0 => 'success',
                        $state <= 2 => 'warning',
                        default     => 'danger',
                    }),
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
