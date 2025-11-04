<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkshopCustomer extends Model
{
    protected $fillable = [
        'Customer_Name',
        'SubTotal',
        'Balance_Amount',
    ];

    public function invoices(): HasMany
    {
        return $this->hasMany(WorkshopInvoice::class, 'Customer_id', 'id');
    }
}
