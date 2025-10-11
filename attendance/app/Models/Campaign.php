<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'life_walk',
        'con_num',
        'email',
        'first_name',
        'middle_name',
        'surname',
        'leader',
        'chapter'
    ];
}
