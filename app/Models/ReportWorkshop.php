<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportWorkshop extends Model
{
    protected $fillable = [
        'company_name',
        'supplier_name',
        'description',
        'vin',
        'date_services',
        'labor_cost',
        'total_price',
        'remarks',
    ];
}
