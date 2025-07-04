<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicaoResource\Pages;
use App\Models\Medicao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;

class MedicaoResource extends Resource
{
    protected static ?string $model = Medicao::class;
    protected static ?string $navigationIcon = 'heroicon-o-calculator';
    protected static ?string $navigationGroup = 'Obra';
    protected static ?string $navigationLabel = 'Medições';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('obra_id')
                ->label('Obra')
                ->relationship('obra', 'nome')
                ->required(),

            Forms\Components\Select::make('prestador_id')
                ->label('Prestador')
                ->relationship('prestador', 'nome')
                ->required(),

            Forms\Components\Select::make('contrato_id')
                ->label('Contrato')
                ->relationship('contrato', 'numero_contrato')
                ->required(),

            Forms\Components\TextInput::make('numero')
                ->label('Nº da Medição')
                ->required(),

            Forms\Components\DatePicker::make('data')
                ->label('Data da Medição')
                ->required(),

            Forms\Components\TextInput::make('referente')
                ->label('Referente a')
                ->required(),

            Forms\Components\TextInput::make('local')
                ->label('Local')
                ->required(),

            Forms\Components\TextInput::make('quantidade')
                ->label('Quantidade')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('valor_unitario')
                ->label('Valor Unitário (R$)')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('valor_total')
                ->label('Total (calculado)')
                ->disabled()
                ->dehydrated(false),

            Forms\Components\Select::make('status')
                ->disabled()
                ->options([
                    'em dia' => 'Em Dia',
                    'em atraso' => 'Em Atraso',
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('numero')->label('Nº'),
            Tables\Columns\TextColumn::make('obra.nome')->label('Obra'),
            Tables\Columns\TextColumn::make('prestador.nome')->label('Prestador'),
            Tables\Columns\TextColumn::make('referente')->label('Referente')->limit(20),
            Tables\Columns\TextColumn::make('quantidade')->label('Qtd'),
            Tables\Columns\TextColumn::make('valor_total')->label('Total')->money('BRL'),
            Tables\Columns\TextColumn::make('data')->label('Data')->date(),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'em dia' => 'success',
                    'em atraso' => 'danger',
                }),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'em dia' => 'Em Dia',
                    'em atraso' => 'Em Atraso',
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
            'index' => Pages\ListMedicaos::route('/'),
            'create' => Pages\CreateMedicao::route('/create'),
            'edit' => Pages\EditMedicao::route('/{record}/edit'),
        ];
    }
}
