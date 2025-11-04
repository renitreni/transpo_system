<?php

namespace App\Livewire\Admin\Delivery;

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

    //#[Rule('required')]
    public string $FullName;

    //#[Rule('required')]
    public string $Email;

    //#[Rule('required')]
    public string $PhoneNumber;

    public string $FaxNumber;

    //#[Rule('required')]
    public string $CompanyRegistration;

    //#[Rule('required')]
    public string $CompanyName;

    //#[Rule('required')]
    public string $OfficeAddress;

    public string $OtherLocation;

    //#[Rule('required')]
    public string $OrderDate;

    //#[Rule('required')]
    public string $MethodPayment;

    public int $customer_id;

    public function mount(string $customer_uuid)
    {
        $customer = Customer::where('Customer_uuid', $customer_uuid)->first();
        $orders = Order::where('Customer_id', $customer->id)->get();
        $this->customer_id = $customer->id;
        $this->FullName = $customer->FullName;
        $this->Email = $customer->Email;
        $this->PhoneNumber = $customer->PhoneNumber;
        $this->FaxNumber = $customer->FaxNumber;
        $this->CompanyRegistration = $customer->CompanyRegistration;
        $this->CompanyName = $customer->CompanyName;
        $this->OfficeAddress = $customer->OfficeAddress;
        $this->OtherLocation = $customer->OtherLocation;
        $this->OrderDate = $customer->OrderDate;
        $this->MethodPayment = $customer->MethodPayment;

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
                'FullName' => $this->FullName ?? 'N/A',
                'Email' => $this->Email ?? 'N/A',
                'PhoneNumber' => $this->PhoneNumber ?? 'N/A',
                'FaxNumber' => $this->FaxNumber ?? 'N/A',
                'CompanyRegistration' => $this->CompanyRegistration ?? 'N/A',
                'CompanyName' => $this->CompanyName ?? 'N/A',
                'OfficeAddress' => $this->OfficeAddress ?? 'N/A',
                'OtherLocation' => $this->OtherLocation ?? 'N/A',
                'OrderDate' => $this->OrderDate ?? 'N/A',
                'MethodPayment' => $this->MethodPayment ?? 'N/A',
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
        return view('livewire.admin.delivery.edit-delivery');
    }
}
