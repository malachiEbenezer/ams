<?php

namespace App\Filament\Resources\ChurchResource\Pages;

use App\Filament\Resources\ChurchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChurch extends EditRecord
{
    protected static string $resource = ChurchResource::class;
    protected static ?string $title = 'Edit Member Profile';
    protected static ?string $breadcrumb = 'Edit Profile';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
