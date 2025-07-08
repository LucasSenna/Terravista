<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstoqueEntradaResource\Pages;
use App\Models\EstoqueEntrada;
use App\Models\EstoqueItem;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class EstoqueEntradaResource extends Resource
{
    protected static ?string $model = EstoqueEntrada::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';
    protected static ?string $navigationLabel = 'Entradas de Estoque';
    protected static ?string $navigationGroup = 'Estoque';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('item_id')
                ->label('Item')
                ->relationship('item', 'descricao')
                ->required(),
            Forms\Components\DatePicker::make('data')
                ->label('Data')
                ->required(),
            Forms\Components\TextInput::make('nota_fiscal')
                ->label('Nº NF')->maxLength(50),
            Forms\Components\TextInput::make('quantidade')
                ->label('Quantidade')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('unidade')
                ->label('Unidade')->maxLength(10),
            Forms\Components\TextInput::make('valor_unitario')
                ->label('Valor Unitário (R$)')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('destino')
                ->label('Destino')->maxLength(255),
            Forms\Components\Textarea::make('observacao')->label('Observação'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('item.descricao')->label('Item'),
            Tables\Columns\TextColumn::make('data')->date()->sortable(),
            Tables\Columns\TextColumn::make('quantidade')->label('Qtd'),
            Tables\Columns\TextColumn::make('valor_unitario')->label('Valor Unit')->money('BRL'),
            Tables\Columns\TextColumn::make('valor_total')->label('Total')->money('BRL'),
        ])
        ->filters([])
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
            'index' => Pages\ListEstoqueEntradas::route('/'),
            'create' => Pages\CreateEstoqueEntrada::route('/create'),
            'edit' => Pages\EditEstoqueEntrada::route('/{record}/edit'),
        ];
    }
}
