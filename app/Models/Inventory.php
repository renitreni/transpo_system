<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'serial_number',
        'quantity',
        'location',
        'expiration_date',
        'balance_remaining',
        'low_stock_threshold',
        'description',
        'unit_price',
        'supplier',
        'status',
    ];

    protected $casts = [
        'expiration_date' => 'date',
        'unit_price' => 'decimal:2',
    ];

    /**
     * Check if inventory is low stock
     */
    public function isLowStock(): bool
    {
        return $this->balance_remaining <= $this->low_stock_threshold;
    }

    /**
     * Check if inventory is expired
     */
    public function isExpired(): bool
    {
        if (!$this->expiration_date) {
            return false;
        }
        return Carbon::parse($this->expiration_date)->isPast();
    }

    /**
     * Get status color for display
     */
    public function getStatusColorAttribute(): string
    {
        switch ($this->status) {
            case 'active':
                return 'green';
            case 'inactive':
                return 'gray';
            case 'expired':
                return 'red';
            default:
                return 'gray';
        }
    }

    /**
     * Scope for low stock items
     */
    public function scopeLowStock($query)
    {
        return $query->whereRaw('balance_remaining <= low_stock_threshold');
    }

    /**
     * Scope for active items
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for expired items
     */
    public function scopeExpired($query)
    {
        return $query->where('expiration_date', '<', now())->whereNotNull('expiration_date');
    }
}
