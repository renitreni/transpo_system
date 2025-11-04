<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forklift extends Model
{
    protected $fillable = [
        'ChassisNumber',
        'Size',
        'Height',
        'Warehouse',
    ];
}
