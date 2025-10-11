<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VictoryGroupResource\Pages;
use App\Filament\Resources\VictoryGroupResource\RelationManagers;
use App\Models\VictoryGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VictoryGroupResource extends Resource
{
    protected static ?string $model = VictoryGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Church';

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
            'index' => Pages\ListVictoryGroups::route('/'),
            'create' => Pages\CreateVictoryGroup::route('/create'),
            'edit' => Pages\EditVictoryGroup::route('/{record}/edit'),
        ];
    }
}
