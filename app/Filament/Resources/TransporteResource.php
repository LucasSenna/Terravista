<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransporteResource\Pages;
use App\Models\Transporte;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class TransporteResource extends Resource
{
    protected static ?string $model = Transporte::class;
    protected static ?string $navigationGroup = 'Obra';
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Controle de Transportes';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('proprietario')->required(),
            Forms\Components\TextInput::make('placa')->required()->maxLength(10),
            Forms\Components\TextInput::make('destino')->required(),
            Forms\Components\DatePicker::make('data_inicio')->label('Início'),
            Forms\Components\DatePicker::make('data_fim')->label('Fim'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('proprietario')->searchable(),
                Tables\Columns\TextColumn::make('placa'),
                Tables\Columns\TextColumn::make('destino'),
                Tables\Columns\TextColumn::make('data_inicio')->date(),
                Tables\Columns\TextColumn::make('data_fim')->date(),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransportes::route('/'),
            'create' => Pages\CreateTransporte::route('/create'),
            'edit' => Pages\EditTransporte::route('/{record}/edit'),
        ];
    }
}
