<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LancamentoTransporteResource\Pages;
use App\Models\LancamentoTransporte;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class LancamentoTransporteResource extends Resource
{
    protected static ?string $model = LancamentoTransporte::class;
    protected static ?string $navigationGroup = 'Obra';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Lançamentos de Transporte';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('transporte_id')
                ->label('Caçamba')
                ->relationship('transporte', 'placa')
                ->required(),

            Forms\Components\Select::make('obra_id')
                ->label('Obra')
                ->relationship('obra', 'nome')
                ->required(),

            Forms\Components\Select::make('material_id')
                ->label('Material')
                ->relationship('material', 'tipo'),

            Forms\Components\Select::make('prestador_id')
                ->label('Prestador')
                ->relationship('prestador', 'nome'),

            Forms\Components\DatePicker::make('data')
                ->label('Data')
                ->required(),

            Forms\Components\TextInput::make('km')
                ->numeric()
                ->label('Distância (KM)')
                ->required(),

            Forms\Components\TextInput::make('valor_km')
                ->numeric()
                ->label('Valor por KM (R$)')
                ->required(),

            Forms\Components\Textarea::make('observacao')
                ->label('Observação')
                ->rows(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transporte.placa')->label('Caçamba'),
                Tables\Columns\TextColumn::make('data')->date(),
                Tables\Columns\TextColumn::make('km'),
                Tables\Columns\TextColumn::make('valor_km')->money('BRL'),
                Tables\Columns\TextColumn::make('valor_total')->money('BRL'),
            ])
            ->filters([
                SelectFilter::make('transporte_id')
                    ->label('Caçamba')
                    ->relationship('transporte', 'placa'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLancamentoTransportes::route('/'),
            'create' => Pages\CreateLancamentoTransporte::route('/create'),
            'edit' => Pages\EditLancamentoTransporte::route('/{record}/edit'),
        ];
    }
}
