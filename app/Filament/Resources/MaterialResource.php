<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialResource\Pages;
use App\Models\Material;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Obra';
    protected static ?string $navigationLabel = 'Materiais e Insumos';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('obra_id')
                ->label('Obra')
                ->relationship('obra', 'nome')
                ->required(),

            Forms\Components\Select::make('prestador_id')
                ->label('Fornecedor')
                ->relationship('prestador', 'nome')
                ->required(),

            Forms\Components\Select::make('tipo')
                ->label('Tipo de Material')
                ->options([
                    'AREIA' => 'AREIA',
                    'BRITA' => 'BRITA',
                    'BGS' => 'BGS',
                    'CIMENTO' => 'CIMENTO',
                    'OUTRO' => 'OUTRO',
                ])
                ->required()
                ->reactive(),

            Forms\Components\TextInput::make('tipo_outro')
                ->label('Informe o Tipo')
                ->placeholder('Ex: PEDRA BRANCA')
                ->visible(fn(Forms\Get $get) => $get('tipo') === 'OUTRO')
                ->required(fn(Forms\Get $get) => $get('tipo') === 'OUTRO')
                ->afterStateUpdated(function (Forms\Set $set, $state) {
                    $set('tipo', strtoupper($state));
                }),

            Forms\Components\DatePicker::make('data')
                ->label('Data de Entrada')
                ->required(),

            Forms\Components\TextInput::make('unidade')
                ->label('Unidade')
                ->placeholder('Ex: m³, kg, t')
                ->required(),

            Forms\Components\TextInput::make('quantidade')
                ->label('Quantidade')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('valor_unitario')
                ->label('Valor Unitário (R$)')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('frete')
                ->label('Valor do Frete (opcional)')
                ->numeric()
                ->nullable(),

            Forms\Components\TextInput::make('ticket')
                ->label('Ticket Nº (automático)')
                ->disabled()
                ->dehydrated(false)
                ->default(null),

            Forms\Components\Textarea::make('observacao')
                ->label('Observação')
                ->rows(2)
                ->nullable(),

            Forms\Components\TextInput::make('valor_total')
                ->label('Total (calculado)')
                ->disabled()
                ->dehydrated(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('obra.nome')->label('Obra'),
            Tables\Columns\TextColumn::make('prestador.nome')->label('Fornecedor'),
            Tables\Columns\TextColumn::make('tipo')
                ->badge()
                ->color(fn($record) => match ($record->tipo) {
                    'AREIA' => 'gray',
                    'BRITA' => 'blue',
                    'BGS' => 'yellow',
                    'CIMENTO' => 'indigo',
                    default => 'default',
                }),
            Tables\Columns\TextColumn::make('quantidade')->label('Qtd'),
            Tables\Columns\TextColumn::make('valor_unitario')->money('BRL'),
            Tables\Columns\TextColumn::make('valor_total')->money('BRL'),
            Tables\Columns\TextColumn::make('data')->date(),
        ])
            ->filters([
                Tables\Filters\SelectFilter::make('tipo')
                    ->options([
                        'AREIA' => 'AREIA',
                        'BRITA' => 'BRITA',
                        'BGS' => 'BGS',
                        'CIMENTO' => 'CIMENTO',
                        'OUTRO' => 'OUTRO',
                    ]),
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
            'index' => Pages\ListMaterials::route('/'),
            'create' => Pages\CreateMaterial::route('/create'),
            'edit' => Pages\EditMaterial::route('/{record}/edit'),
        ];
    }
}
