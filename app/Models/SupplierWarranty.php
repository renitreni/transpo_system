<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupplierWarranty extends Model
{
    protected $fillable = [
        'Report_id',
        'OrderNumber',
        'DateOfPurchased',
        'FeedbackTime',
        'CausesAnalysis',
        'LooseMaterial',
        'Dust',
        'CoalField',
        'Stones',
        'Gravel',
        'MetalOre',
        'Plateau',
        'TGreat',
        'ZeroCel',
        'TLess',
        'FailureDescription',
        'SignatureTech',
        'DateSignatureTech',
        'DateSignatureCustomer',
        'SignatureCustomer',
        'ApprovedBy',
        'DateApproved',
        'SupplierWarrantyApproval',
        'DealerRequestApproval',
        'DateWarrantySupplierRequest',
        'ApprovalSignature',
        'SignatureDate',
        'return_date',
        'courier',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(WarrantyReport::class, 'Report_id', 'id');
    }

    public function replacement(): HasMany
    {
        return $this->hasMany(Replacement::class, 'supplier_id', 'id');
    }
}
