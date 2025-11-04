<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_cr',
        'contact_person',
        'phone_no',
        'email',
        'address',
        'note',
        'brand_name',
        'kilometers',
        'hour',
        'warranty',
        'others',
        'vin_no',
        'remarks',
    ];
}
