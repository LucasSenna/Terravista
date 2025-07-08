<?php

namespace App\Filament\Resources;

use App\Models\EstoqueSaida;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Filament\Resources\EstoqueSaidaResource\Pages;

class EstoqueSaidaResource extends Resource
{
    protected static ?string $model = EstoqueSaida::class;
    protected static ?string $navigationGroup = 'Estoque';
    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';
    protected static ?string $navigationLabel = 'Saídas de Estoque';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('item_id')
                ->label('Item')
                ->relationship('item', 'descricao')
                ->required(),

            Forms\Components\DatePicker::make('data')
                ->label('Data da Saída')
                ->required(),

            Forms\Components\TextInput::make('nota_fiscal')->label('Nº NF'),

            Forms\Components\TextInput::make('quantidade')
                ->label('Quantidade')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('unidade')
                ->label('Unidade')
                ->placeholder('ex: kg, m³'),

            Forms\Components\TextInput::make('valor_unitario')
                ->label('Valor Unitário (opcional)')
                ->numeric()
                ->nullable(),

            Forms\Components\TextInput::make('destino')
                ->label('Destino')
                ->placeholder('ex: Obra XYZ'),

            Forms\Components\Textarea::make('observacao')
                ->label('Observação')
                ->rows(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('item.descricao')->label('Item'),
            Tables\Columns\TextColumn::make('data')->date(),
            Tables\Columns\TextColumn::make('quantidade')->label('Qtd'),
            Tables\Columns\TextColumn::make('valor_unitario')
                ->money('BRL')
                ->label('Valor Unit'),
            Tables\Columns\TextColumn::make('total_saida')
                ->label('Total Saída')
                ->getStateUsing(fn ($record) => $record->quantidade * ($record->valor_unitario ?? 0))
                ->money('BRL'),
            Tables\Columns\TextColumn::make('destino')->label('Destino'),
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
            'index' => Pages\ListEstoqueSaidas::route('/'),
            'create' => Pages\CreateEstoqueSaida::route('/create'),
            'edit' => Pages\EditEstoqueSaida::route('/{record}/edit'),
        ];
    }
}
