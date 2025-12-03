<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WarrantyReport extends Model
{
    protected $fillable = [
        'Name',
        'PhoneNumber',
        'Company',
        'Location',
        'Brand',
        'Model',
        'BodyType',
        'VIN_ID',
        'Odometer',
        'FirstTimeMaintenance',
        'PlateNumber',
        'Color',
        'ApprovedBy',
        'DateApproved',
        'Destination',
        'Decision',
        'Status',
        'Report',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(WarrantyFiles::class, 'Report_id', 'id');
    }

    public function supplierStatus(): HasOne
    {
        return $this->hasOne(SupplierWarranty::class, 'Report_id', 'id');
    }
}
