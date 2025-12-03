<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class WarrantyReportForm extends Form
{
    public string $Name = '';

    public string $PhoneNumber = '';

    public string $Company = '';

    public string $Location = '';

    public string $Brand = '';

    public string $Model = '';

    public string $BodyType = '';

    public string $VIN_ID = '';

    public string $Odometer = '';

    public float $FirstTimeMaintenance = 0.0;

    public string $PlateNumber = '';

    public string $Color = '';

    public string $ApprovedBy = '';

    public string $DateApproved = '';

    public string $Destination = '';

    public bool $Status = false;

    public $Images = [];

    public $File = null;

    public string $Report = '';
}
