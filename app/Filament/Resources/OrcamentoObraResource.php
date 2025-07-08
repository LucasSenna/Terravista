<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrcamentoObraResource\Pages;
use App\Models\OrcamentoObra;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class OrcamentoObraResource extends Resource
{
    protected static ?string $model = OrcamentoObra::class;
    protected static ?string $navigationGroup = 'Obra';
    protected static ?string $navigationIcon = 'heroicon-o-calculator';
    protected static ?string $navigationLabel = 'Orçamento da Obra';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('obra_id')
                ->label('Obra')
                ->relationship('obra', 'nome')
                ->required(),

            Forms\Components\TextInput::make('etapa')
                ->label('Etapa / Descrição')
                ->required(),

            Forms\Components\TextInput::make('categoria')
                ->label('Categoria (ex: MÃO DE OBRA, MATERIAL)')
                ->required(),

            Forms\Components\TextInput::make('unidade')
                ->label('Unidade (ex: m², kg)')
                ->required(),

            Forms\Components\TextInput::make('quantidade_prevista')
                ->label('Qtd Prevista')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('valor_unitario_previsto')
                ->label('Valor Unitário Previsto')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('total_previsto')
                ->label('Total Previsto (automático)')
                ->disabled()
                ->dehydrated(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('obra.nome')->label('Obra')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('etapa')->label('Etapa')->searchable(),
                Tables\Columns\TextColumn::make('categoria')->label('Categoria'),
                Tables\Columns\TextColumn::make('unidade')->label('Unid.'),
                Tables\Columns\TextColumn::make('quantidade_prevista')->label('Qtd'),
                Tables\Columns\TextColumn::make('valor_unitario_previsto')->money('BRL'),
                Tables\Columns\TextColumn::make('total_previsto')->money('BRL')->label('Total'),
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
            'index' => Pages\ListOrcamentoObras::route('/'),
            'create' => Pages\CreateOrcamentoObra::route('/create'),
            'edit' => Pages\EditOrcamentoObra::route('/{record}/edit'),
        ];
    }
}
