<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContratoResource\Pages;
use App\Models\Contrato;
use App\Models\Obra;
use App\Models\Prestador;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;

class ContratoResource extends Resource
{
    protected static ?string $model = Contrato::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Documentos';
    protected static ?string $navigationLabel = 'Contratos';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('prestador_id')
                ->label('Prestador')
                ->relationship('prestador', 'nome')
                ->required(),

            Forms\Components\Select::make('obra_id')
                ->label('Obra')
                ->relationship('obra', 'nome'),

            Forms\Components\TextInput::make('numero_contrato')
                ->label('Número do Contrato'),

            Forms\Components\DatePicker::make('data_contrato')
                ->label('Data do Contrato'),

            Forms\Components\DatePicker::make('inicio_locacao')
                ->label('Início da Locação'),

            Forms\Components\TextInput::make('tipo_faturamento')
                ->label('Tipo de Faturamento'),

            Forms\Components\TextInput::make('forma_pagamento')
                ->label('Forma de Pagamento'),

            Forms\Components\TextInput::make('valor_mensal')
                ->label('Valor Mensal')
                ->numeric(),

            Forms\Components\TextInput::make('horas_mensais')
                ->label('Horas Mensais')
                ->numeric()
                ->default(200),

            Forms\Components\TextInput::make('taxa_kit_capa')
                ->label('Taxa do Kit Capa')
                ->numeric(),

            Forms\Components\Textarea::make('descricao_equipamento')
                ->label('Descrição do Equipamento')
                ->rows(3),

            Forms\Components\Textarea::make('dados_bancarios')
                ->label('Dados Bancários')
                ->rows(3),

            Forms\Components\Textarea::make('descricao')
                ->label('Descrição Geral'),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'rascunho' => 'Rascunho',
                    'assinado' => 'Assinado',
                    'cancelado' => 'Cancelado',
                ])
                ->default('rascunho'),

            Forms\Components\FileUpload::make('arquivo_pdf')
                ->label('Arquivo Assinado')
                ->directory('contratos')
                ->acceptedFileTypes(['application/pdf']),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('numero_contrato')->label('Nº'),
            Tables\Columns\TextColumn::make('prestador.nome')->label('Prestador'),
            Tables\Columns\TextColumn::make('obra.nome')->label('Obra')->toggleable(),
            Tables\Columns\TextColumn::make('tipo')->label('Tipo'),
            Tables\Columns\TextColumn::make('data_contrato')->label('Data')->date(),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn(string $state) => match ($state) {
                    'assinado' => 'success',
                    'cancelado' => 'danger',
                    'rascunho' => 'gray',
                }),
        ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'rascunho' => 'Rascunho',
                        'assinado' => 'Assinado',
                        'cancelado' => 'Cancelado',
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
            'index' => Pages\ListContratos::route('/'),
            'create' => Pages\CreateContrato::route('/create'),
            'edit' => Pages\EditContrato::route('/{record}/edit'),
        ];
    }
}
