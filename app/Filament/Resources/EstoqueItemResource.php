<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstoqueItemResource\Pages;
use App\Models\EstoqueItem;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class EstoqueItemResource extends Resource
{
    protected static ?string $model = EstoqueItem::class;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Itens de Estoque';
    protected static ?string $navigationGroup = 'Estoque';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('descricao')
                ->label('Descrição')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('unidade')
                ->label('Unidade (ex: kg, m³)')
                ->maxLength(20),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('descricao')->label('Descrição')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('unidade')->label('Unidade'),
            Tables\Columns\TextColumn::make('quantidade_total')->label('Qtd em Estoque')->sortable(),
            Tables\Columns\TextColumn::make('valor_total')->label('Valor Total')->money('BRL')->sortable(),
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
            'index' => Pages\ListEstoqueItems::route('/'),
            'create' => Pages\CreateEstoqueItem::route('/create'),
            'edit' => Pages\EditEstoqueItem::route('/{record}/edit'),
        ];
    }
}
