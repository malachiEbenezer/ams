<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialResource\Pages;
use App\Filament\Resources\MaterialResource\RelationManagers;
use App\Models\Material;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Group;
use App\Sex;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Filament\Resources\RegisterResource\Widgets\StatsOverview;
use Dom\Text;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\MarkdownEditor;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Material Details')
                    ->schema([
                        Group::make([
                            Select::make('type')
                                ->required()
                                ->options([
                                    'Books' => 'Books',
                                    'Electronics' => 'Electronics',
                                    'Equipment' => 'Equipment',
                                    'Games - Board' => 'Games - Board',
                                    'Games - Card' => 'Games - Card',
                                    'Games - Puzzle' => 'Games - Puzzle',
                                    'Instruments' => 'Instruments',
                                    'Stationeries' => 'Stationeries',
                                    'Utensils' => 'Utensils',
                                    'Others' => 'Others'
                                ])
                                ->searchable()
                                ->columnSpan(2),
                            Select::make('class')
                                ->label('Classification')
                                ->options([
                                    'Church' => 'Church',
                                    'Student Center' => 'Student Center'
                                ])
                                ->required()
                                ->columnSpan(2),
                            MarkdownEditor::make('desc')
                                ->label('Description')
                                ->required()
                                ->columnSpan(4),
                        ])->columns(4),
                        Group::make([
                            TextInput::make('name')
                                ->required(),
                            FileUpload::make('photo')
                                ->label('Upload Photo')
                                ->disk('public')
                                ->directory('materials')
                                ->image()
                                ->extraAttributes([
                                    'type' => 'file',
                                    'accept' => 'image/*',
                                    'capture' => 'user',
                                ])->columnSpan(1),
                        ])
                    ])
                    ->columns(2),
                Section::make('Additional Details')
                    ->schema([
                        Group::make([
                            TextInput::make('Price'),
                            DatePicker::make('purchase_date')
                                ->label('Date Purchased')
                                ->required(),
                            DatePicker::make('release_date')
                                ->label('Date Released')
                                ->required(),
                            TextInput::make('qty')
                                ->label('Quantity')
                                ->required(),
                        ])->columns(4),
                        Group::make([
                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'New' => 'New',
                                    'Used, Decent' => 'Used, Decent',
                                    'Used, Old' => 'Used, Old',
                                    'Donated, New' => 'Donated, New',
                                    'Donated, Decent' => 'Donated, Decent',
                                    'Damaged' => 'Damaged',
                                    'Phased Out' => 'Phased Out',
                                ])
                                ->required()
                                ->columnSpan(1),
                            TextInput::make('remarks')
                                ->label('Remarks')
                                ->columnSpan(1)
                        ])->columns(2),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('qty')
                    ->label('Quantity'),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('remarks'),
            ])
            ->filters([
                Filter::make('remarks')
                    ->toggle(),
                SelectFilter::make('type')
                    ->options([
                        'Books' => 'Books',
                        'Electronics' => 'Electronics',
                        'Equipment' => 'Equipment',
                        'Games - Board' => 'Games - Board',
                        'Games - Card' => 'Games - Card',
                        'Games - Puzzle' => 'Games - Puzzle',
                        'Instruments' => 'Instruments',
                        'Stationeries' => 'Stationeries',
                        'Utensils' => 'Utensils',
                        'Others' => 'Others'
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'New' => 'New',
                        'Used, Decent' => 'Used, Decent',
                        'Used, Old' => 'Used, Old',
                        'Donated, New' => 'Donated, New',
                        'Donated, Decent' => 'Donated, Decent',
                        'Damaged' => 'Damaged',
                        'Phased Out' => 'Phased Out',
                    ]),
                SelectFilter::make('class')
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
            'index' => Pages\ListMaterials::route('/'),
            'create' => Pages\CreateMaterial::route('/create'),
            'edit' => Pages\EditMaterial::route('/{record}/edit'),
        ];
    }
}
