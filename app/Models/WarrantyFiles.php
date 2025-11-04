<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WarrantyFiles extends Model
{
    protected $fillable = [
        'FileName',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(WarrantyReport::class, 'Report_id', 'id');
    }
}
