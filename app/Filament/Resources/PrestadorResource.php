<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestadorResource\Pages;
use App\Models\Prestador;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;

class PrestadorResource extends Resource
{
    protected static ?string $model = Prestador::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Financeiro';
    protected static ?string $navigationLabel = 'Prestadores / Fornecedores';

    public static function getSlug(): string
    {
        return 'fornecedor-prestadores';
    }

    public static function getModelLabel(): string
    {
        return 'Fornecedor / Prestador';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Fornecedores / Prestadores';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nome')->required()->maxLength(255),
            Forms\Components\TextInput::make('cpf_cnpj')->required()->maxLength(20)
                ->label('CPF / CNPJ')
                ->formatStateUsing(function ($state) {
                    $state = preg_replace('/\D/', '', $state);
                    if (strlen($state) === 11) {
                        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $state);
                    }
                    if (strlen($state) === 14) {
                        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $state);
                    }
                    return $state;
                }),
            Forms\Components\TextInput::make('representante')->required()->maxLength(255),
            Forms\Components\TextInput::make('email')->email()->maxLength(255)
                ->label('E-mail'),
            Forms\Components\TextInput::make('telefone')->maxLength(20),
            Forms\Components\Textarea::make('endereco')->required(),
            Forms\Components\TextInput::make('banco')->maxLength(255),
            Forms\Components\TextInput::make('agencia')->maxLength(20),
            Forms\Components\TextInput::make('conta_corrente')->maxLength(20),
            Forms\Components\TextInput::make('chave_pix')->maxLength(255),
            Forms\Components\Textarea::make('observacoes'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('cpf_cnpj')
                    ->label('CPF / CNPJ')
                    ->formatStateUsing(function ($state) {
                        $state = preg_replace('/\D/', '', $state);
                        if (strlen($state) === 11) {
                            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $state);
                        }
                        if (strlen($state) === 14) {
                            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $state);
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('representante'),
                Tables\Columns\TextColumn::make('telefone'),
                Tables\Columns\TextColumn::make('email'),
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
            'index' => Pages\ListPrestadores::route('/'),
            'create' => Pages\CreatePrestador::route('/create'),
            'edit' => Pages\EditPrestador::route('/{record}/edit'),
        ];
    }
}
