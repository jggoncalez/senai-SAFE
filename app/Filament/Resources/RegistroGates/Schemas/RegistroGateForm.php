<?php

namespace App\Filament\Resources\RegistroGates\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RegistroGateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('autorizacao_id')
                    ->relationship('autorizacao', 'id')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('tipo')
                    ->required(),
                DateTimePicker::make('registrado_at')
                    ->required(),
                Textarea::make('observacao')
                    ->columnSpanFull(),
            ]);
    }
}
