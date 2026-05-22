<?php

namespace App\Filament\Resources\Autorizacaos\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AutorizacaoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Select::make('aluno_id')
                    ->label('Aluno')
                    ->relationship('aluno', 'nome')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),
                Hidden::make('aqv_user_id')
                    ->default(fn () => auth()->id()),
                Select::make('tipo')
                    ->label('Tipo')
                    ->options([
                        'saida'   => 'Saída',
                        'entrada' => 'Entrada',
                    ])
                    ->default('saida')
                    ->required(),
                Hidden::make('status')
                    ->default('aprovado'),
                CheckboxList::make('aulas_perdidas')
                    ->label('Aulas perdidas')
                    ->options([
                        '1' => '1ª Aula',
                        '2' => '2ª Aula',
                        '3' => '3ª Aula',
                        '4' => '4ª Aula',
                    ])
                    ->columns(4)
                    ->default(['1', '2', '3', '4'])
                    ->afterStateHydrated(function (CheckboxList $component, $state): void {
                        $count = (int) ($state ?? 0);
                        $component->state(
                            $count > 0 ? array_map('strval', range(1, $count)) : []
                        );
                    })
                    ->dehydrateStateUsing(fn ($state): int => count((array) ($state ?? [])))
                    ->columnSpanFull(),
                Textarea::make('observacao')
                    ->label('Observação')
                    ->columnSpanFull(),
            ]);
    }
}
