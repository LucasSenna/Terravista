<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DespesaResource\Pages;
use App\Models\Despesa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;

class DespesaResource extends Resource
{
    protected static ?string $model = Despesa::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = null; // <-- Isso faz sair do grupo "Financeiro"
    protected static ?string $navigationLabel = 'Contas a Pagar';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('prestador_id')
                ->label('Prestador')
                ->relationship('prestador', 'nome')
                ->required(),

            Forms\Components\Select::make('tipo')
                ->label('Tipo')
                ->options([
                    'aluguel' => 'Aluguel',
                    'fixa' => 'Despesa Fixa',
                ])
                ->required(),

            Forms\Components\TextInput::make('descricao')
                ->label('Descrição')
                ->required(),

            Forms\Components\TextInput::make('valor')
                ->label('Valor')
                ->numeric()
                ->required(),

            Forms\Components\DatePicker::make('vencimento')
                ->label('Vencimento')
                ->required(),

            Forms\Components\Select::make('forma_pagamento')
                ->label('Forma de Pagamento')
                ->options([
                    'PIX' => 'PIX',
                    'TED' => 'TED',
                    'DINHEIRO' => 'Dinheiro',
                    'BOLETO' => 'Boleto',
                ])
                ->required(),

            Forms\Components\Select::make('estado')
                ->label('Estado')
                ->options([
                    'pendente' => 'Pendente',
                    'agendado' => 'Agendado',
                    'pago' => 'Pago',
                    'vencido' => 'Vencido',
                ])
                ->required(),

            Forms\Components\DatePicker::make('data_pagamento')
                ->label('Data do Pagamento')
                ->visible(fn ($get) => $get('estado') === 'pago'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('prestador.nome')
                ->label('Prestador')
                ->searchable(),

            Tables\Columns\TextColumn::make('tipo')
                ->label('Tipo')
                ->badge(),

            Tables\Columns\TextColumn::make('descricao')
                ->label('Descrição')
                ->limit(30),

            Tables\Columns\TextColumn::make('valor')
                ->label('Valor')
                ->money('BRL'),

            Tables\Columns\TextColumn::make('vencimento')
                ->label('Vencimento')
                ->date(),

            Tables\Columns\TextColumn::make('forma_pagamento')
                ->label('Pagamento'),

            Tables\Columns\TextColumn::make('estado')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'vencido' => 'danger',
                    'pago' => 'success',
                    'agendado' => 'warning',
                    default => 'gray',
                }),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('estado')
                ->label('Filtrar por Estado')
                ->options([
                    'pendente' => 'Pendente',
                    'agendado' => 'Agendado',
                    'pago' => 'Pago',
                    'vencido' => 'Vencido',
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
            'index' => Pages\ListDespesas::route('/'),
            'create' => Pages\CreateDespesa::route('/create'),
            'edit' => Pages\EditDespesa::route('/{record}/edit'),
        ];
    }
}
