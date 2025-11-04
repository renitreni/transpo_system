<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fleet extends Model
{
    protected $fillable = [
        'rent_id',
        'area',
        'date',
        'dayName',
        'branch_manager',
        'motion_official',
        'forman',
    ];

    public function rent(): BelongsTo
    {
        return $this->belongsTo(Rent::class, 'rent_id', 'id');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(FleetLog::class, 'fleet_id', 'id');
    }
}
