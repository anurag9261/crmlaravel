<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employeereport extends Model
{
    protected $fillable = [
        'employee', 'month',
    ];
}
