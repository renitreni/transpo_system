<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkshopInvoice extends Model
{
    protected $fillable = [
        'ServiceFee',
        'WorkshopFee',
        'UnitAmount',
        'TotalAmount',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(WorkshopCustomer::class, 'Customer_id', 'id');
    }
}
