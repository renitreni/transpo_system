<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FleetFile extends Model
{
    protected $fillable = [
        'log_id',
        'filename',
        'mime',
        'extension',
        'size',
    ];

    public function log(): BelongsTo
    {
        return $this->belongsTo(FleetLog::class, 'log_id', 'id');
    }
}
