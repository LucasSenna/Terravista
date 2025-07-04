<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObraResource\Pages;
use App\Models\Obra;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;

class ObraResource extends Resource
{
    protected static ?string $model = Obra::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Obras';
    protected static ?string $pluralLabel = 'Obras';
    protected static ?string $modelLabel = 'Obra';
    protected static ?string $navigationGroup = 'Obras';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->label('Nome da Obra'),

                Forms\Components\Select::make('local_obra_id')
                    ->label('Localidade')
                    ->relationship('localObra', 'logradouro')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('responsavel_id')
                    ->label('Responsável Técnico')
                    ->relationship('responsavel', 'nome')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\DatePicker::make('data_inicio')
                    ->label('Data de Início'),

                Forms\Components\DatePicker::make('data_fim')
                    ->label('Data de Fim'),

                Forms\Components\Select::make('status')
                    ->options([
                        'em_execucao' => 'Em execução',
                        'pausada' => 'Pausada',
                        'concluida' => 'Concluída',
                    ])
                    ->default('em_execucao')
                    ->required()
                    ->label('Status'),

                Forms\Components\FileUpload::make('planilha_orcamentaria')
                    ->label('Planilha Orçamentária')
                    ->directory('planilhas')
                    ->disk('public')
                    ->preserveFilenames(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('localObra.logradouro')
                    ->label('Localidade')
                    ->formatStateUsing(fn ($state, $record) => $record->localObra?->logradouro . ' - ' . $record->localObra?->estado)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('responsavel.nome')
                    ->label('Responsável Técnico')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->label('Status')
                    ->sortable(),

                TextColumn::make('data_inicio')
                    ->date('d/m/Y')
                    ->label('Início')
                    ->sortable(),

                TextColumn::make('data_fim')
                    ->date('d/m/Y')
                    ->label('Fim')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObras::route('/'),
            'create' => Pages\CreateObra::route('/create'),
            'edit' => Pages\EditObra::route('/{record}/edit'),
        ];
    }
}
