<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampaignResource\Pages;
use App\Filament\Resources\CampaignResource\RelationManagers;
use App\Models\Campaign;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\CheckboxList;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationLabel = 'One-2-One Campaign';
    protected static ?string $navigationGroup = 'Church';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Personal Details')
                    ->schema([
                        Group::make([
                            TextInput::make('first_name')
                                ->label('First Name')
                                ->required(),
                            TextInput::make('middle_name')
                                ->label('Middle Name')
                                ->required(),
                            TextInput::make('surname')
                                ->required(),
                            Select::make('life_walk')
                                ->label('Walk of Life')
                                ->options([
                                    'Students' => 'Students',
                                    'Singles' => 'Singles',
                                    'Couples' => 'Couples',
                                    'Single Dads' => 'Single Dads',
                                    'Single Moms' => 'Single Moms'
                                ])
                                ->required()
                                ->searchable(),
                            TextInput::make('con_num')
                                ->label('Contact Number')
                                ->required(),
                            TextInput::make('email')
                                ->label('Email')
                                ->nullable(),
                        ])->columns(3),
                    ]),
                Section::make('Progress Details')
                    ->schema([
                        Group::make([
                            Select::make('leader')
                                ->label('One-2-One Partner')
                                ->options([
                                    'Dennis Mardoquio' => 'Dennis Mardoquio',
                                    'Carmel Rosame Milleza' => 'Carmel Rosame Milleza',
                                    'Wendel Bacus' => 'Wendel Bacus',
                                    'Rovelyn Bacus' => 'Rovelyn Bacus',
                                    'Jonathan Vitorillo' => 'Jonathan Vitorillo',
                                    'Jane Vitorillo' => 'Jane Vitorillo',
                                    'John Mark P. Caballo' => 'John Mark P. Caballo',
                                    'Grey C. Caballo' => 'Grey C. Caballo',
                                    'Sally Alba' => 'Sally Alba',
                                    'Jhang Inocando' => 'Jhang Inocando',
                                    'Viem' => 'Viem',
                                    'Francis John Aling' => 'Francis John Aling',
                                    'Julie Cobrador' => 'Julie Cobrador',
                                    'Nikki Andrea Denisse Mardoquio' => 'Nikki Andrea Denisse Mardoquio',
                                    'Marieneth Q. Amigo' => 'Marieneth Q. Amigo',
                                ])
                                ->searchable()
                                ->required(),
                        ])->columnSpan(2),
                        Group::make([
                            CheckboxList::make('completed_chapters')
                                ->label('Chapters Completed')
                                ->options([
                                    'Salvation' => '1 - Salvation',
                                    'Lordship' => '2 - Lordship',
                                    'Repentance' => '3 - Repentance',
                                    'Baptism' => '4 - Baptism',
                                    'Devotion' => '5 - Devotion',
                                    'Church' => '6 - Church',
                                    'Discipleship' => '7 - Discipleship',
                                ])->columns(4)
                                ->reactive()
                                ->afterStateUpdated(function (callable $set, $state) {
                                    $progress = round((count($state) / 7) * 100);
                                    $set('progress', $progress);
                                }),

                            Hidden::make('progress'),

                            Placeholder::make('progress_display')
                                ->label('Progress:')
                                ->content(fn($get) => $get('progress') . '% completed'),
                        ])->columnSpan(3)

                    ])->columns(5)
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
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaign::route('/create'),
            'edit' => Pages\EditCampaign::route('/{record}/edit'),
        ];
    }
}
