<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'PlateNo',
        'Email',
        'PhoneNumber',
        'FaxNumber',
        'CompanyRegistration',
        'CompanyName',
        'OfficeAddress',
        'OtherLocation',
        'OrderDate',
        'MethodPayment',
        'driver_name',
        'car_insurance_company',
        'resident_iqama_number',
        'date_of_entry_iqama_number',
        'validity_of_iqama',
        'driver_license_number',
        'driver_license_expiry_date',
        'insurance_expiry_date',
        'date_of_insurance_entry',
        'driver_status',
        'driver_card',
        'operating_card',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'Customer_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            do {
                $randomTrackNumber = str_shuffle(strtoupper(Str::random(10)).rand(1000, 9999));
                $randomUuid = Uuid::uuid4();

                $exists_TrackNumber = self::where('OrderTrackNumber', $randomTrackNumber)->exists();
                $exists_randomUuid = self::where('Customer_uuid', $randomUuid)->exists();

            } while ($exists_TrackNumber || $exists_randomUuid);

            $model->OrderTrackNumber = $randomTrackNumber;
            $model->Customer_uuid = $randomUuid;
        });
    }
}
