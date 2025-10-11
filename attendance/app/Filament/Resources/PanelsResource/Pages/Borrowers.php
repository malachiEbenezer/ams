<?php

namespace App\Filament\Resources\PanelsResource\Pages;

use App\Filament\Resources\PanelsResource;
use Filament\Resources\Pages\Page;

class Borrowers extends Page
{
    protected static string $resource = PanelsResource::class;

    protected static string $view = 'filament.resources.panels-resource.pages.borrowers';

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Student Center';
}
