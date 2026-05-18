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
                DateTimePicker::make('registrado_at')
                    ->label('Registrado em')
                    ->required(),
                Textarea::make('observacao')
                    ->label('Observação')
                    ->columnSpanFull(),
            ]);
    }
}
