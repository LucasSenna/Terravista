<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocalObraResource\Pages;
use App\Models\LocalObra;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LocalObraResource extends Resource
{
    protected static ?string $model = LocalObra::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Obras';
    protected static ?string $pluralLabel = 'Localidades';
    protected static ?string $modelLabel = 'Localidade';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('logradouro')
                    ->label('Logradouro')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('estado')
                    ->label('Estado')
                    ->required()
                    ->options([
                        'Paraíba' => 'Paraíba',
                        'Pernambuco' => 'Pernambuco',
                        'Rio Grande do Norte' => 'Rio Grande do Norte',
                        'Ceará' => 'Ceará',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('logradouro')->label('Logradouro')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('estado')->label('Estado')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Criado em')->dateTime('d/m/Y H:i'),
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
            'index' => Pages\ListLocalObras::route('/'),
            'create' => Pages\CreateLocalObra::route('/create'),
            'edit' => Pages\EditLocalObra::route('/{record}/edit'),
        ];
    }
}
