<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fielder extends Model
{
    protected $fillable = [
        'field_name', 'field_value'
    ];
}
