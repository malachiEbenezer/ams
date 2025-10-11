<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'class',
        'type',
        'photo',
        'name',
        'desc',
        'price',
        'purchase_date',
        'release_date',
        'qty',
        'status',
        'remarks'
    ];
}
