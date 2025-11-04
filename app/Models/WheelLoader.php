<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WheelLoader extends Model
{
    use HasFactory;

    protected $fillable = [
        'BrandModel',
        'ChassisNumber',
        'Warehouse',
        'Stocks',
        'Type',
        'isActive',
    ];
}
