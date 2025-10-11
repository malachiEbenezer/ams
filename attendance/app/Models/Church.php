<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    protected $fillable = [
        'life_walk',
        'connect',
        'first_name',
        'middle_name',
        'surname',
        'sex',
        'birthdate',

        'con_num',
        'email',
        'fb_acc',
        'address',

        'life_grp',
        'victory_grp',
        'one_to_one',
        'purple_book',
        'church_com',
        'make_disc',
        'emp_leaders',
        'lead_113',
        'lead_215',  
        
        'life_lead',
        'vg_lead',
        'one_lead',
    ];
}
