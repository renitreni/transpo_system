<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'Product',
        'Color',
        'ChassisNumber',
        'YearModel',
        'WarrantyPeriod',
        'WarrantyExpiration',
        'Quantity',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'Customer_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            do {
                $random = Uuid::uuid4();
                $exists = self::where('Order_uuid', $random)->exists();
            } while ($exists);
            $model->Order_uuid = $random;
        });
    }
}
