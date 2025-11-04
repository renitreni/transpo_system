<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ClientRequestForm extends Form
{
    #[Validate('required')]
    public string $purchase_number = '';

    #[Validate('required')]
    public string $company_name = '';

    #[Validate('required')]
    public string $company_cr = '';

    #[Validate('required')]
    public string $contact_person = '';

    #[Validate('required')]
    public string $mobile_number = '';

    #[Validate('required')]
    public string $contact_email = '';

    #[Validate('required')]
    public string $national_address = '';

    #[Validate('required')]
    public string $note = '';

    #[Validate('required')]
    public string $entry_date = '';

    public $next_payment;

    public bool $isPaid = false;

    #[Validate('required')]
    public int $paymentMethod = 12;

    #[Validate('required')]
    public float|string $service_amount = 0;

    #[Validate('required')]
    public float $total_service_amount = 0;

    #[Validate('required')]
    public float|string $advance_payment = 0;

    #[Validate('required')]
    public string $transportation_details = '';

    #[Validate('required')]
    public string $tuv_certificate = '';

    #[Validate('required')]
    public bool $saso_certificate = false;

    #[Validate('required')]
    public bool $other_certificate = false;

    #[Validate('required')]
    public bool $driver = false;

    public int $number_units = 0;

    public string $receiver_name = '';

    public string $receiver_mobile_number = '';

    public string $receiver_national_id = '';

    public string $receiver_location = '';

    #[Validate('required')]
    public $imgInputs;

    #[Validate('required')]
    public $fileInputs;

    #[Validate('required')]
    public string $emp_name = '';

    #[Validate('required')]
    public string $emp_number = '';

    #[Validate('required')]
    public string $branch = '';

    #[Validate('required')]
    public string $payment_term = '';

    public function assingValue($data)
    {
        foreach ($data->toArray() as $field => $value) {
            $this->$field = $value ?? 'N/A';
        }
    }
}
