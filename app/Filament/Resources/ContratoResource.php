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
                ->relationship('obra', 'nome')
                ->searchable()
                ->preload()
                ->nullable(),

            Forms\Components\TextInput::make('tipo')
                ->label('Tipo de Contrato')
                ->placeholder('Ex: equipamento, serviço')
                ->required(),

            Forms\Components\TextInput::make('numero_contrato')
                ->label('Nº do Contrato'),

            Forms\Components\DatePicker::make('data_contrato')
                ->label('Data do Contrato'),

            Forms\Components\Select::make('status')
                ->options([
                    'rascunho' => 'Rascunho',
                    'assinado' => 'Assinado',
                    'cancelado' => 'Cancelado',
                ])
                ->required(),

            Forms\Components\Textarea::make('descricao')
                ->label('Descrição')
                ->rows(3),

            Forms\Components\FileUpload::make('arquivo_pdf')
                ->label('Arquivo do Contrato (PDF)')
                ->disk('public')
                ->directory('contratos')
                ->acceptedFileTypes(['application/pdf'])
                ->nullable(),
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
