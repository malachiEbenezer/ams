<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Sex;

class Register extends Model
{
    protected $casts = [
        'sex' => Sex::class,
    ];
    protected $fillable = [
        'photo',
        'first_name',
        'middle_name',
        'surname',
        'suffix',
        'sex',
        'age',
        'birthdate',
        'school',
        'level',
        'year',
        'course',
        'con_num',
        'email',
        'fb_acc',
        'region',
        'province',
        'city',
        'brgy',
        'add_spec',
        'emer_relation',
        'emer_name',
        'emer_con',
        'emer_address',
        'en_orient',
        'en_heads',
        'en_scard',
        'en_tutorials',
    ];
}
