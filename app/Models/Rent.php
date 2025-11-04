<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class Rent extends Model
{
    use Notifiable;

    protected $fillable = [
        'track_number',
        'purchase_number',
        'company_name',
        'company_cr',
        'contact_person',
        'mobile_number',
        'contact_email',
        'national_address',
        'note',
        'entry_date',
        'next_payment',
        'isPaid',
        'paymentMethod',
        'service_amount',
        'total_service_amount',
        'advance_payment',
        'transportation_details',
        'tuv_certificate',
        'saso_certificate',
        'other_certificate',
        'receiver_name',
        'receiver_mobile_number',
        'receiver_national_id',
        'receiver_location',
        'driver',
        'number_units',
        'emp_name',
        'emp_number',
        'branch',
        'isWorkshopApproved',
        'isSalesApproved',
        'isFleetApproved',
        'isAccountantApproved',
        'payment_term',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(RentFile::class, 'rent_id', 'id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(RentInvoice::class, 'rent_id', 'id');
    }

    public function fleet(): HasMany
    {
        return $this->hasMany(Fleet::class, 'rent_id', 'id');
    }

    public function approvalFleet(): HasMany
    {
        return $this->hasMany(FleetApproval::class, 'rent_id', 'id');
    }

    public function routeNotificationForMail(Notification $notification): array|string
    {

        return $this->contact_email;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            do {
                $randomTrackNumber = str_shuffle(strtoupper(Str::random(10)).rand(1000, 9999));
                $exists_TrackNumber = self::where('track_number', $randomTrackNumber)->exists();

            } while ($exists_TrackNumber);

            $model->track_number = $randomTrackNumber;
        });
    }
}
