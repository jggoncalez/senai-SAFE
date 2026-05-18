<?php

namespace App\Filament\Resources\Alunos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AlunoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('turma.nome')
                    ->label('Turma'),
                TextEntry::make('nome')
                    ->label('Nome'),
                TextEntry::make('matricula')
                    ->label('Matrícula'),
                TextEntry::make('foto_url')
                    ->label('Foto (URL)')
                    ->placeholder('-'),
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
