<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FleetApproval extends Model
{
    protected $fillable = [
        'rent_id',
        'images',
        'truck_brand',
        'truck_model',
        'truck_size',
        'truck_vin',
        'plate_number',
        'insurance',
        'operator_name',
        'current_location',
    ];

    public function rent(): BelongsTo
    {
        return $this->belongsTo(Rent::class, 'rent_id', 'id');
    }
}
