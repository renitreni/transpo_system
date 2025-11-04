<?php

namespace App\Livewire\Admin\Delivery;

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
    public string $MethodPayment = 'Bank';
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

    public function SaveReceipt()
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

            $customer = new Customer;
            $customer->fill($customer_data);
            $customer->save();

            foreach ($this->products as $product) {
                $trimmedProduct = array_map('trim', $product);
                $trimmedProduct = array_map(function ($value) {
                    return preg_replace('/\s+/', ' ', strtoupper($value));
                }, $trimmedProduct);
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
        return view('livewire.admin.delivery.create-delivery');
    }
}
