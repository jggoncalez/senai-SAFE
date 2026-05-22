<?php

namespace App\Filament\Resources\RegistroGates\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RegistroGateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('autorizacao_id')
                    ->label('Autorização')
                    ->relationship('autorizacao', 'id')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('user_id')
                    ->label('Registrado por')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('tipo')
                    ->label('Tipo')
                    ->options([
                        'entrada' => 'Entrada',
                        'saida'   => 'Saída',
                    ])
                    ->required(),
                Select::make('aulas_perdidas')
                    ->label('Aulas Perdidas')
                    ->options([
                        0 => '0 — nenhuma aula perdida',
                        1 => '1 — perde 1 aula',
                        2 => '2 — perde 2 aulas',
                        3 => '3 — perde 3 aulas',
                        4 => '4 — perde 4 aulas',
                    ])
                    ->default(0)
                    ->required(),
                DateTimePicker::make('registrado_at')
                    ->label('Registrado em')
                    ->required(),
                Textarea::make('observacao')
                    ->label('Observação')
                    ->placeholder('Observações sobre o registro...')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull(),
            ]);
    }
}
