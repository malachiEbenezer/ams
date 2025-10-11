<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChurchResource\Pages;
use App\Filament\Resources\ChurchResource\RelationManagers;
use App\Models\Church;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Sex;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Navigation\NavigationItem;

class ChurchResource extends Resource
{
    protected static ?string $model = Church::class;

    protected static ?string $navigationGroup = 'Church';
    protected static ?string $navigationLabel = 'Church Community';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $title = 'Church';
    protected static ?string $breadcrumb = 'Church Community';
    protected static ?string $modelLabel = 'Member Profile';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Personal Details')
                    ->schema([
                        Group::make([
                            Select::make('life_walk')
                                ->label('Walk of Life')
                                ->options([
                                    'Students' => 'Students',
                                    'Singles' => 'Singles',
                                    'Couples' => 'Couples',
                                    'Single Dads' => 'Single Dads',
                                    'Single Moms' => 'Single Moms'
                                ])
                                ->searchable()
                                ->required()
                                ->columnSpan(2),
                            TextInput::make('connect')
                                ->label('Contact Person')
                                ->required()
                                ->columnSpan(3),

                            TextInput::make('first_name')
                                ->label('First Name')
                                ->required()
                                ->columnSpan(2),
                            TextInput::make('middle_name')
                                ->label('Middle Name')
                                ->required()
                                ->columnSpan(1),
                            TextInput::make('surname')
                                ->label('Surname')
                                ->required()
                                ->columnSpan(2),
                            Select::make('sex')
                                ->options([
                                    Sex::Male->value => 'Male',
                                    Sex::Female->value => 'Female',
                                ])
                                ->required(),
                            DatePicker::make('birthdate')
                                ->label('Birthdate')
                                ->required(),
                        ])->columns(5)
                    ]),
                Section::make('Contact Details')
                    ->schema([
                        Group::make([
                            TextInput::make('con_num')
                                ->label('Contact Number')
                                ->required(),
                            TextInput::make('email')
                                ->label('Email'),
                            TextInput::make('fb_acc')
                                ->label('FB Account'),
                            TextInput::make('address')
                                ->label('Address')
                                ->required()
                        ])->columns(2)
                    ]),

                Section::make('Journey')
                    ->schema([
                        Group::make([
                            Checkbox::make('life_grp')
                                ->label('LIFE Group')
                                ->reactive(),
                            Checkbox::make('victory_grp')
                                ->label('Victory Group')
                                ->reactive(),
                            Checkbox::make('one_to_one')
                                ->label('One-2-One')
                                ->reactive(),
                            Checkbox::make('purple_book')
                                ->label('Purple Book'),
                            Checkbox::make('church_com')
                                ->label('Church Community'),
                            Checkbox::make('make_disc')
                                ->label('Making Disciples'),
                            Checkbox::make('emp_leaders')
                                ->label('Empowering Leaders'),
                            Checkbox::make('lead_113')
                                ->label('Leadership 113'),
                            Checkbox::make('lead_215')
                                ->label('Leadership 215'),
                        ])->columns(5),

                        Group::make([
                            Select::make('life_lead')
                                ->label('LIFE Group Leader')
                                ->columnSpan(2)
                                ->visible(fn($get) => $get('life_grp'))
                                ->options([
                                    'Dennis Mardoquio' => 'Dennis Mardoquio',
                                    'Carmel Rosame Milleza' => 'Carmel Rosame Milleza',
                                    'Nikki Mardoquio' => 'Nikki Mardoquio',
                                    'Marieneth Q. Amigo' => 'Marieneth Q. Amigo',
                                    'Wendel Bacus' => 'Wendel Bacus',
                                    'Rovelyn Bacus' => 'Rovelyn Bacus',
                                    'Francis John Aling' => 'Francis John Aling',
                                    'Sally Alba' => 'Sally Alba',
                                    'Jhang Inocando' => 'Jhang Inocando',
                                    'Dennis and Carmel Mardoquio' => 'Dennis and Carmel Mardoquio',
                                    'Wendel and Rovelyn Bacus' => 'Wendel and Rovelyn Bacus',
                                    'Dennis and Carmel Mardoquio' => 'Dennis and Carmel Mardoquio',
                                    'Wendel and Rovelyn Bacus' => 'Wendel and Rovelyn Bacus',
                                    'Jonathan and Jane Vitorillo' => 'Jonathan and Jane Vitorillo',
                                    'John Mark and Grey Caballo' => 'John Mark and Grey Caballo',
                                ])
                                ->searchable()
                                ->required(),
                            Select::make('vg_lead')
                                ->label('Victory Group Leader')
                                ->columnSpan(2)
                                ->visible(fn($get) => $get('victory_grp'))->options([
                                    'Dennis Mardoquio' => 'Dennis Mardoquio',
                                    'Carmel Rosame Milleza' => 'Carmel Rosame Milleza',
                                    'Nikki Andrea Denisse Mardoquio' => 'Nikki Andrea Denisse Mardoquio',
                                    'Marieneth Q. Amigo' => 'Marieneth Q. Amigo',
                                    'Wendel Bacus' => 'Wendel Bacus',
                                    'Rovelyn Bacus' => 'Rovelyn Bacus',
                                    'Francis John Aling' => 'Francis John Aling',
                                    'Sally Alba' => 'Sally Alba',
                                    'Jhang Inocando' => 'Jhang Inocando',
                                    'Dennis and Carmel Mardoquio' => 'Dennis and Carmel Mardoquio',
                                    'Wendel and Rovelyn Bacus' => 'Wendel and Rovelyn Bacus',
                                    'Dennis and Carmel Mardoquio' => 'Dennis and Carmel Mardoquio',
                                    'Wendel and Rovelyn Bacus' => 'Wendel and Rovelyn Bacus',
                                    'Jonathan and Jane Vitorillo' => 'Jonathan and Jane Vitorillo',
                                    'John Mark and Grey Caballo' => 'John Mark and Grey Caballo',
                                ])
                                ->searchable()
                                ->required(),
                            Select::make('one_lead')
                                ->label('One-2-One Leader')
                                ->columnSpan(2)
                                ->visible(fn($get) => $get('one_to_one'))
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
                                ->required()
                        ])->columns(6)
                    ])
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
            'index' => Pages\ListChurches::route('/'),
            'create' => Pages\CreateChurch::route('/create'),
            'edit' => Pages\EditChurch::route('/{record}/edit'),
        ];
    }
}
