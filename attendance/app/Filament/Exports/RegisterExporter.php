<?php

namespace App\Filament\Exports;

use App\Models\Register;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class RegisterExporter extends Exporter
{
    protected static ?string $model = Register::class;

    public static function getColumns(): array
    {
        return [
            
ExportColumn::make('photo'),
            ExportColumn::make('first_name'),
            ExportColumn::make('middle_name'),
            ExportColumn::make('surname'),
            ExportColumn::make('suffix'),
            ExportColumn::make('sex'),
            ExportColumn::make('age'),
            ExportColumn::make('birthdate'),
            ExportColumn::make('school'),
            ExportColumn::make('level'),
            ExportColumn::make('year'),
            ExportColumn::make('course'),
            ExportColumn::make('con_num'),
            ExportColumn::make('email'),
            ExportColumn::make('fb_acc'),
            ExportColumn::make('region'),
            ExportColumn::make('province'),
            ExportColumn::make('city'),
            ExportColumn::make('brgy'),
            ExportColumn::make('add_spec'),
            ExportColumn::make('emer_relation'),
            ExportColumn::make('emer_name'),
            ExportColumn::make('emer_con'),
            ExportColumn::make('emer_address'),
            ExportColumn::make('en_orient'),
            ExportColumn::make('en_heads'),
            ExportColumn::make('en_scard'),
            ExportColumn::make('en_tutorials'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your register export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
