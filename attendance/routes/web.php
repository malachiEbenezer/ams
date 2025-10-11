<?php

use Illuminate\Support\Facades\Route;
use App\Models\Register;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/export-registers', function () {
    $data = Register::all()->map->toArray();

    $filename = 'registers.csv';
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $output = fopen('php://temp', 'r+');
    fputcsv($output, array_keys($data->first()));
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
    rewind($output);
    $csvContent = stream_get_contents($output);
    fclose($output);

    return Response::make($csvContent, 200, $headers);
})->name('export.registers');
