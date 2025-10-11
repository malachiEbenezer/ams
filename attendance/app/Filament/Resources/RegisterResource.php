<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegisterResource\Pages;
use App\Models\Register;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Group;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Sex;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Filament\Resources\RegisterResource\Widgets\StatsOverview;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Response;
use App\Filament\Exports\RegisterExporter;
use Filament\Tables\Actions\ExportAction;



class RegisterResource extends Resource
{
    protected static ?string $model = Register::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Personal Info
            Section::make('Student Personal Details')
                ->schema([
                    Group::make([
                        TextInput::make('first_name')->required()
                            ->columnSpan(2),
                        TextInput::make('middle_name')->nullable()
                            ->columnSpan(2),
                        TextInput::make('surname')->required()
                            ->columnSpan(2),
                        TextInput::make('suffix')->nullable()
                            ->columnSpan(2),
                        Select::make('sex')
                            ->options([
                                Sex::Male->value => 'Male',
                                Sex::Female->value => 'Female',
                            ])
                            ->enum(Sex::class)
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('age')->numeric()->required(),
                        DatePicker::make('birthdate')->required(),
                    ])->columns(4)
                        ->columnSpan(2),
                    FileUpload::make('photo_upload')
                        ->disk('public')
                        ->directory('materials')
                        ->image()
                        ->label('Upload Photo')
                        ->extraAttributes([
                            'type' => 'file',
                            'accept' => 'image/*',
                            'capture' => 'user',
                        ])
                        ->columnSpan(1),
                ])->columns(3),

            Section::make('Academic Information')
                ->schema([
                    Group::make([
                        Select::make('level')
                            ->label('Level')
                            ->options(function () {
                                $path = public_path('yearLevel/level.json');
                                if (!file_exists($path)) {
                                    return [];
                                }
                                $levels = json_decode(file_get_contents($path), true);
                                if ($levels === null) {
                                    return [];
                                }
                                return array_combine($levels, $levels);
                            })
                            ->default('College')
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (Set $set) {
                                $set('year', null);
                            })
                            ->columnSpan(2),

                        Select::make('year')
                            ->label('Grade/Year')
                            ->options(function (Get $get) {
                                $level = $get('level');
                                if (!$level) {
                                    return [];
                                }

                                $path = public_path('yearLevel/yearLevel.json');
                                if (!file_exists($path)) {
                                    return [];
                                }

                                $data = json_decode(file_get_contents($path), true);
                                if ($data === null || !isset($data[$level])) {
                                    return [];
                                }

                                $years = $data[$level];
                                return array_combine($years, $years);
                            })
                            ->default('Second Year')
                            ->searchable()
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('school')->required()->columnSpan(4)->default('Davao del Norte State College'),
                        TextInput::make('course')->nullable()->columnSpan(2)
                    ])->columns(10),
                ]),

            Section::make('Student Contact Details')
                ->schema([
                    Group::make([
                        TextInput::make('con_num')->label('Contact Number')->required(),
                        TextInput::make('email')->email()->required(),
                        TextInput::make('fb_acc')->label('Facebook Account')->nullable(),
                    ])->columns(3),
                ]),

            Section::make('Student Address')
                ->schema([
                    Group::make([
                        Select::make('region')
                            ->label('Region')
                            ->options(function () {
                                $path = public_path('davao/davao.json');
                                if (!file_exists($path)) {
                                    return [];
                                }
                                $regions = json_decode(file_get_contents($path), true);
                                if ($regions === null) {
                                    return [];
                                }
                                return array_combine($regions, $regions);
                            })
                            ->default('Region XI (Davao Region)')
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (Set $set) {
                                $set('province', null);
                                $set('city', null);
                            })
                            ->columnSpan(2),
                        Select::make('province')
                            ->label('Province')
                            ->options(function (Get $get) {
                                $region = $get('region');
                                if (!$region) {
                                    return [];
                                }
                                $path = public_path('davao/province.json');
                                if (!file_exists($path)) {
                                    return [];
                                }
                                $provinces = json_decode(file_get_contents($path), true);
                                if ($provinces === null || !isset($provinces[$region])) {
                                    return [];
                                }
                                return array_combine($provinces[$region], $provinces[$region]);
                            })
                            ->default('Davao del Norte')
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (Set $set) {
                                $set('city', null);
                            })
                            ->columnSpan(2),
                        Select::make('city')
                            ->label('City')
                            ->options(function (Get $get) {
                                $province = $get('province');
                                if (!$province) {
                                    return [];
                                }
                                $path = public_path('davao/city.json');
                                if (!file_exists($path)) {
                                    return [];
                                }
                                $cities = json_decode(file_get_contents($path), true);
                                if ($cities === null) {
                                    return [];
                                }
                                // Trim keys to handle any leading/trailing spaces
                                $trimmedCities = [];
                                foreach ($cities as $key => $value) {
                                    $trimmedCities[trim($key)] = $value;
                                }
                                if (!isset($trimmedCities[$province])) {
                                    return [];
                                }
                                return array_combine($trimmedCities[$province], $trimmedCities[$province]);
                            })
                            ->default('Panabo')
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->columnSpan(1),
                        TextInput::make('brgy')->label('Barangay')->columnSpan(1),
                        TextInput::make('add_spec')->label('Specific Address')->nullable()->columnSpan(2),
                    ])->columns(4),
                ]),

            Section::make('Emergency Contact Details')
                ->schema([
                    Group::make([
                        TextInput::make('emer_relation')->label('Emergency Relation')->required(),
                        TextInput::make('emer_name')->label('Emergency Contact Name')->required(),
                        TextInput::make('emer_con')->label('Emergency Contact Number')->required(),
                        TextInput::make('emer_address')->label('Emergency Contact Address')->required(),
                    ])->columns(2),
                ]),

            Section::make('Engagements')
                ->schema([
                    Group::make([
                        Checkbox::make('en_orient')->label('Orientation'),
                        Checkbox::make('en_heads')->label('HEADSSS'),
                        Checkbox::make('en_scard')->label('Student Card'),
                        Checkbox::make('en_tutorials')->label('Tutorials'),
                    ])->columns(4),
                ]),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('surname')->label('Familys Name')->searchable(),
                TextColumn::make('first_name')->label('First Name')->searchable(),
                TextColumn::make('middle_name')->label('Middle Name')->searchable(),
                TextColumn::make('sex')->label('Gender'),
                TextColumn::make('school')->label('School'),
                TextColumn::make('year')->label('Year'),
            ])
            ->filters([
                Filter::make('first_name')
                    ->toggle(),
                Filter::make('middle_name')
                    ->toggle(),
                Filter::make('surname')
                    ->toggle(),
                SelectFilter::make('sex')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female'
                    ]),
                SelectFilter::make('year')
                    ->options([
                        'Grade 7' => 'Grade 7',
                        'Grade 8' => 'Grade 8',
                        'Grade 9' => 'Grade 9',
                        'Grade 10' => 'Grade 10',
                        'Grade 11' => 'Grade 11',
                        'Grade 12' => 'Grade 12',
                        'First Year' => 'First Year',
                        'Second Year' => 'Second Year',
                        'Third Year' => 'Third Year',
                        'Fourth Year' => 'Fourth Year',
                        'Fifth Year' => 'Fifth Year',
                    ]),

                SelectFilter::make('level')
                    ->options([
                        'Junior High School' => 'Junior High School',
                        'Senior High School' => 'Senior High School',
                        'College' => 'College'
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Action::make('Export CSV')
                //     ->label('Download CSV')
                //     ->icon('heroicon-o-arrow-down-tray')
                //     ->url(route('export.registers'))
                //     ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('Download CSV')
                    ->label('Download CSV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(route('export.registers'))
                    ->openUrlInNewTab(), // optional: opens in new tab
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
            'index' => Pages\ListRegisters::route('/'),
            'create' => Pages\CreateRegister::route('/create'),
            'edit' => Pages\EditRegister::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
