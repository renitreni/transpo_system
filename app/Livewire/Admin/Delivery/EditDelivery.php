<?php

namespace App\Livewire\Admin\Delivery;

use App\Enums\DriverStatusEnum;
use App\Models\Customer;
use App\Models\Log;
use App\Models\Order;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Edit Client')]
#[Layout('/livewire/layout/app')]
class EditDelivery extends Component
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

    public $customer_id;

    public function mount(string $customer_uuid)
    {
        $customer = Customer::where('Customer_uuid', $customer_uuid)->first();
        $orders = Order::where('Customer_id', $customer->id)->get();
        $this->customer_id = $customer->id;
        $this->PlateNo = $customer->PlateNo;
        $this->PhoneNumber = $customer->PhoneNumber;
        $this->CompanyName = $customer->CompanyName;
        $this->OfficeAddress = $customer->OfficeAddress;
        $this->OtherLocation = $customer->OtherLocation;
        $this->OrderDate = $customer->OrderDate;
        $this->driver_name = $customer->driver_name;
        $this->car_insurance_company = $customer->car_insurance_company;
        $this->resident_iqama_number = $customer->resident_iqama_number;
        $this->date_of_entry_iqama_number = $customer->date_of_entry_iqama_number;
        $this->validity_of_iqama = $customer->validity_of_iqama;
        $this->driver_license_number = $customer->driver_license_number;
        $this->driver_license_expiry_date = $customer->driver_license_expiry_date;
        $this->insurance_expiry_date = $customer->insurance_expiry_date;
        $this->date_of_insurance_entry = $customer->date_of_insurance_entry;
        $this->driver_status = $customer->driver_status;

        foreach ($orders as $order) {
            $this->products[] = [
                'id' => $order->id,
                'Product' => $order->Product,
                'Color' => $order->Color,
                'ChassisNumber' => $order->ChassisNumber,
                'YearModel' => $order->YearModel,
                'WarrantyPeriod' => $order->WarrantyPeriod,
                'WarrantyExpiration' => $order->WarrantyExpiration,
                'Quantity' => $order->Quantity,
            ];
        }
    }

    public function add_product()
    {
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

    public function getDateViaMonths($index)
    {
        $months = $this->products[$index]['WarrantyPeriod'];
        $orderDate = Carbon::parse($this->OrderDate);
        $expireWarranty = $orderDate->addMonths($months)->toDateString();
        $this->products[$index]['WarrantyExpiration'] = date('F d , Y', strtotime($expireWarranty));
    }

    public function updateWarrantyExpirations()
    {
        $orderDate = Carbon::parse($this->OrderDate);

        foreach ($this->products as $index => $product) {
            $months = $product['WarrantyPeriod'];
            $expireWarranty = $orderDate->copy()->addMonths($months)->toDateString();
            $this->products[$index]['WarrantyExpiration'] = date('F d, Y', strtotime($expireWarranty));
        }
    }

    public function remove_product(int $index)
    {
        unset($this->products[$index]);
        $this->products = array_values($this->products);
    }

    public function UpdateRecord()
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
            ];

            $customer = Customer::find($this->customer_id);
            if ($customer) {
                $customer->fill($customer_data);
                $customer->save();

                // Get all existing order ids for the customer
                $existing_order_ids = Order::where('Customer_id', $customer->id)->pluck('id')->toArray();

                foreach ($this->products as $product) {
                    if (isset($product['id']) && in_array($product['id'], $existing_order_ids)) {
                        // Update existing order
                        $order = Order::find($product['id']);
                        $order->fill($product);
                        $order->save();

                        // Remove the id from the existing_order_ids array
                        $existing_order_ids = array_diff($existing_order_ids, [$product['id']]);
                    } else {
                        // Create new order
                        $order = new Order;
                        $order->Customer_id = $customer->id;
                        $order->fill($product);
                        $order->save();
                    }
                }

                // Delete any remaining orders
                Order::destroy($existing_order_ids);

                Log::newLog('Order Updated', $customer->OrderTrackNumber);

                return session()->flash('success', 'Successfully updated record.');
            } else {
                return session()->flash('error', 'Customer not found.');
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.delivery.edit-delivery', [
            'driverStatusOptions' => DriverStatusEnum::cases(),
        ]);
    }
}
