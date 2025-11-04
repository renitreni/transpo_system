<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Replacement extends Model
{
    protected $fillable = [
        'FPCN',
        'RPCN',
        'NameModel',
        'Quantity',
    ];

    public function supply(): BelongsTo
    {
        return $this->belongsTo(SupplierWarranty::class, 'supplier_id', 'id');
    }
}
