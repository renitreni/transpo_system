<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class RentInvoice extends Model
{
    protected $fillable = [
        'rent_id',
        'invoice_number',
        'paid_date',
        'status',
        'amount_paid',
        'advance_payment',
    ];

    public function rent(): BelongsTo
    {
        return $this->belongsTo(Rent::class, 'rent_id', 'id');
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($invoice) {
            do {
                $randomInvoiceNumber = str_shuffle(strtoupper(Str::random(7)).rand(1000, 9999));
                $exist = self::where('invoice_number', $randomInvoiceNumber)->exists();
            } while ($exist);

            $invoice->invoice_number = $randomInvoiceNumber;
        });
    }
}
