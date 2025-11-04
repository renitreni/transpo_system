<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Inquire extends Model
{
    use HasFactory;

    protected $fillable = [
        'FullName',
        'Email',
        'PhoneNumber',
        'Message',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            do {
                $random = Uuid::uuid4();
                $exists = self::where('inquire_uuid', $random)->exists();
            } while ($exists);
            $model->inquire_uuid = $random;
        });
    }
}
