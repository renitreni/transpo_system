<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FleetLog extends Model
{
    protected $fillable = [
        'fleet_id',
        'location',
        'driver_name',
        'employee_no',
        'driver_type',
        'working_hours',
        'equipment_type',
        'equipment_status',
        'equipment_no',
        'remarks',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(FleetFile::class, 'log_id', 'id');
    }
}
