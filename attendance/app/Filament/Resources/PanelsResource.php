<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PanelsResource\Pages;
use App\Filament\Resources\PanelsResource\RelationManagers;
use App\Models\Panels;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PanelsResource extends Resource
{
    protected static ?string $model = Panels::class;
   
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Records';


    protected static ?string $title = 'Records';

    protected static ?string $breadcrumb = 'Records';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPanels::route('/'),
            'create' => Pages\CreatePanels::route('/create'),
            'edit' => Pages\EditPanels::route('/{record}/edit'),
            'home' => Pages\Home::route('/home'),
            'borrowers' => Pages\Borrowers::route('/borrowers'),
        ];
    }
}
