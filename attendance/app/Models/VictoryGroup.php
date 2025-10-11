<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VictoryGroup extends Model
{
    protected $fillable = [
        'life_walk',
        'vg_lead',
        'vg_mem',
        'freq',
        'loc',
    ];
}
