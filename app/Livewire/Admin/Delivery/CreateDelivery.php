<?php

namespace App\Livewire\Admin\Delivery;

use App\Enums\DriverStatusEnum;
use App\Models\Customer;
use App\Models\Log;
use App\Models\Order;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Add Client')]
#[Layout('/livewire/layout/app')]
class CreateDelivery extends Component
{
    public $products = [];

    public $PlateNo;
    public $PhoneNumber;
    public $CompanyName;
    public $OfficeAddress;
    public $OtherLocation;
    public $OrderDate;
    
    // New driver fields
    public $driver_name;
    public $car_insurance_company;
    public $resident_iqama_number;
    public $date_of_entry_iqama_number;
    public $validity_of_iqama;
    public $driver_license_number;
    public $driver_license_expiry_date;
    public $insurance_expiry_date;
    public $date_of_insurance_entry;
    public $driver_status;
    public $driver_card;
    public $operating_card;
    //public int $OrderSubtotal = 0;
    ////#[Rule('required')]
    //public int $OrderShippingFee = 0;
    //public int $OrderTotal = 0;

    ////#[Rule('required')]
    //public int $OrderTax = 0;

    public function mount()
    {
        $this->OrderDate = Carbon::now()->toDateString();
    }

    protected function rules(): array
    {
        return [
            'products.*.WarrantyPeriod' => 'nullable|integer|min:0',
        ];
    }

    public function updated($propertyName)
    {
        if (str_contains($propertyName, 'products.') && str_ends_with($propertyName, 'WarrantyPeriod')) {
            $this->validateOnly($propertyName);
            $this->sanitizeWarrantyPeriod($propertyName);
        }
    }

    protected function sanitizeWarrantyPeriod(string $propertyName): void
    {
        [$collection, $index, $field] = explode('.', $propertyName);
        if ($collection !== 'products' || $field !== 'WarrantyPeriod') {
            return;
        }

        if (! isset($this->products[$index][$field])) {
            return;
        }

        $value = $this->products[$index][$field];
        if ($value === null || $value === '') {
            $this->products[$index][$field] = null;

            return;
        }

        $this->products[$index][$field] = (int) $value;
    }

    public function getDateViaMonths($index)
    {
        $propertyPath = "products.$index.WarrantyPeriod";
        $this->validateOnly($propertyPath);

        $months = $this->products[$index]['WarrantyPeriod'] ?? 0;
        if (! is_numeric($months)) {
            $months = 0;
        }

        $orderDate = Carbon::parse($this->OrderDate);
        $expireWarranty = $orderDate->addMonths((int) $months)->toDateString();
        $this->products[$index]['WarrantyExpiration'] = date('F d , Y', strtotime($expireWarranty));
    }

    public function updateWarrantyExpirations()
    {
        $orderDate = Carbon::parse($this->OrderDate);

        foreach ($this->products as $index => $product) {
            $months = $product['WarrantyPeriod'] ?? 0;
            if (! is_numeric($months)) {
                $months = 0;
            }

            $expireWarranty = $orderDate->copy()->addMonths((int) $months)->toDateString();
            $this->products[$index]['WarrantyExpiration'] = date('F d, Y', strtotime($expireWarranty));
        }
    }

    public function add_product()
    {
        if (! isset($this->OrderDate) || ! $this->OrderDate || $this->OrderDate == '') {
            $this->products = [];

            return session()->flash('no_date', 'Set the purchased date first before adding products.');
        }
        $this->products[] = [
            'Product' => '',
            'Color' => '',
            'ChassisNumber' => '',
            'YearModel' => 0,
            'WarrantyPeriod' => 0,
            'WarrantyExpiration' => '',
            'Quantity' => 0,
        ];
    }

    public function remove_product(int $index)
    {
        unset($this->products[$index]);
        $this->products = array_values($this->products);
    }

    protected function sanitizeProductData(array $product): array
    {
        $sanitized = [];
        $stringFields = ['Product', 'Color', 'ChassisNumber'];
        $numericFields = ['YearModel', 'WarrantyPeriod', 'Quantity'];

        foreach ($stringFields as $field) {
            if (array_key_exists($field, $product) && is_string($product[$field])) {
                $value = preg_replace('/\s+/', ' ', trim($product[$field]));
                $sanitized[$field] = strtoupper($value);
            }
        }

        foreach ($numericFields as $field) {
            if (array_key_exists($field, $product)) {
                $sanitized[$field] = is_numeric($product[$field]) ? (int) $product[$field] : 0;
            }
        }

        if (array_key_exists('WarrantyExpiration', $product) && is_string($product['WarrantyExpiration'])) {
            $sanitized['WarrantyExpiration'] = trim($product['WarrantyExpiration']);
        }

        return $sanitized;
    }

    public function SaveReceipt()
    {
        //$this->validate();
        if (empty($this->products)) {
            session()->flash('error', 'No purchase has been set.');

            return;
        } else {
            $customer_data = [
                'PlateNo' => $this->PlateNo ?? 'N/A',
                'PhoneNumber' => $this->PhoneNumber ?? 'N/A',
                'CompanyName' => $this->CompanyName ?? 'N/A',
                'OfficeAddress' => $this->OfficeAddress ?? 'N/A',
                'OtherLocation' => $this->OtherLocation ?? null,
                'OrderDate' => $this->OrderDate ?? null,
                'driver_name' => $this->driver_name ?? null,
                'car_insurance_company' => $this->car_insurance_company ?? null,
                'resident_iqama_number' => $this->resident_iqama_number ?? null,
                'date_of_entry_iqama_number' => $this->date_of_entry_iqama_number ?? null,
                'validity_of_iqama' => $this->validity_of_iqama ?? null,
                'driver_license_number' => $this->driver_license_number ?? null,
                'driver_license_expiry_date' => $this->driver_license_expiry_date ?? null,
                'insurance_expiry_date' => $this->insurance_expiry_date ?? null,
                'date_of_insurance_entry' => $this->date_of_insurance_entry ?? null,
                'driver_status' => $this->driver_status ?? null,
                'driver_card' => $this->driver_card ?? null,
                'operating_card' => $this->operating_card ?? null,
            ];

            $customer = new Customer;
            $customer->fill($customer_data);
            $customer->save();

            foreach ($this->products as $product) {
                $trimmedProduct = $this->sanitizeProductData($product);
                $order = new Order;
                $order->Customer_id = $customer->id;
                $order->Order_Date = $customer->OrderDate;
                $order->fill($trimmedProduct);
                $order->save();
            }
            $this->reset();
            Log::newLog('Order Created', $customer->OrderTrackNumber);

            return session()->flash('success', 'Successfully added new record.');
        }
    }

    /*public function updateSubTotal($index){

        if($this->products[$index]['Quantity'] == "" || $this->products[$index]['Price'] == "" ){
            $this->products[$index]['Quantity'] = 0;
            $this->products[$index]['Price'] = 0;
            $this->OrderSubtotal = 0; // Reset OrderSubtotal
            foreach($this->products as $product){
                $this->OrderSubtotal += $product['Quantity'] * $product['Price'] ;
            }
        } else {
            //* Update OrderSubtotal
            $this->OrderSubtotal = 0; // Reset OrderSubtotal
            foreach($this->products as $product){
                $this->OrderSubtotal += $product['Quantity'] * $product['Price'] ;
            }
        }
        $this->updateTotal();
    }

    public function updateTotal()
    {
        if (empty($this->OrderShippingFee)) {
            $this->OrderShippingFee = 0;
        }
        if(empty($this->OrderTax)){
            $this->OrderTax = 0;
        }

        $this->OrderTotal = $this->OrderSubtotal + $this->OrderShippingFee + $this->OrderTax ;
    }
    */

    public function render()
    {
        return view('livewire.admin.delivery.create-delivery', [
            'driverStatusOptions' => DriverStatusEnum::cases(),
        ]);
    }
}
