<?php

namespace App\Filament\Resources\PanelsResource\Pages;

use App\Filament\Resources\PanelsResource;
use Filament\Resources\Pages\Page;

class Home extends Page
{
    protected static string $resource = PanelsResource::class;


    protected static string $view = 'filament.resources.panels-resource.pages.home';
    protected static ?string $navigationLabel = 'Attendance';
    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationGroup = 'Student Center';

    protected static ?string $title = 'Attendance';
    protected static ?string $breadcrumb = 'Attendance';
}
