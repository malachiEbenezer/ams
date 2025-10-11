<?php

namespace App\Filament\Resources\PanelsResource\Pages;

use App\Filament\Resources\PanelsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePanels extends CreateRecord
{
    protected static string $resource = PanelsResource::class;
    protected static ?string $title = 'Create List';
    protected static ?string $breadcrumb = 'List';
}
