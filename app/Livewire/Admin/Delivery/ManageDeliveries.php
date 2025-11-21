<?php

namespace App\Livewire\Admin\Delivery;

use App\Models\Customer;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Clients')]
#[Layout('/livewire/layout/app')]
class ManageDeliveries extends Component
{
    use WithPagination;

    public string $search = '';

    public array $data = [];

    public string $customer____uuid = '';

    public function add()
    {
        return $this->redirect('@create', navigate: true);
    }

    public function downloadPDF(?string $customer_uuid = null)
    {
        $customer = Customer::where('Customer_uuid', $customer_uuid)->first();
        $orders = Order::where('Customer_id', $customer->id)->get();

        $pdf = Pdf::loadView('livewire/admin/delivery/receipt/receipt', [
            'customer' => $customer,
            'orders' => $orders,
        ]);
        \App\Models\Log::newLog('Receipt Download', $customer->OrderTrackNumber);

        if ($customer->PlateNo === 'N/A') {
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, 'No-PlateNo'.' Receipt.pdf');
        }

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $customer->PlateNo.' Receipt.pdf');
    }

    public function viewPurchase($customer_uuid = null)
    {
        $customer = Customer::where('Customer_uuid', $customer_uuid)->first();
        $orders = Order::where('Customer_id', $customer->id)->get();

        $this->data = [
            'customer' => $customer,
            'orders' => $orders,
        ];

        $this->dispatch('open-view-purchase');
    }

    public function edit(?string $customer_uuid = null)
    {
        //return redirect()->route('admin_EditReceipt',$customer_uuid);
        return $this->redirect(route('admin_EditReceipt', ['lang' => 'en', 'customer_uuid' => $customer_uuid]));
    }

    public function cancelView(): array
    {
        $this->data = [];
        
        $this->dispatch('close-view-purchase');

        return $this->data;
    }

    public function delete(?string $customer_uuid = null)
    {
        Customer::where('Customer_uuid', $customer_uuid)->first()->delete();
        session()->flash('success', 'Customer: Successfully deleted.');
        \App\Models\Log::newLog('Delete', 'Customer delete successfully.');
    }

    private function getSearchCustomer(): Collection
    {
        $customers = Customer::with('orders')
            ->where(function ($query) {
                $query->where('PlateNo', 'like', "%{$this->search}%")
                    ->orWhere('PhoneNumber', 'like', "%{$this->search}%")
                    ->orWhere('CompanyName', 'like', "%{$this->search}%")
                    ->orWhere('OfficeAddress', 'like', "%{$this->search}%")
                    ->orWhere('OtherLocation', 'like', "%{$this->search}%")
                    ->orWhere('driver_name', 'like', "%{$this->search}%")
                    ->orWhere('car_insurance_company', 'like', "%{$this->search}%")
                    ->orWhere('resident_iqama_number', 'like', "%{$this->search}%")
                    ->orWhere('driver_license_number', 'like', "%{$this->search}%")
                    ->orWhere('driver_status', 'like', "%{$this->search}%")
                    ->orWhere('driver_license_expiry_date', 'like', "%{$this->search}%")
                    ->orWhere('insurance_expiry_date', 'like', "%{$this->search}%")
                    ->orWhere('driver_card', 'like', "%{$this->search}%")
                    ->orWhere('operating_card', 'like', "%{$this->search}%")
                    ->orWhere('OrderDate', 'like', "%{$this->search}%")
                    ->orWhereHas('orders', function ($orderQuery) {
                        $orderQuery->where('Product', 'like', "%{$this->search}%")
                            ->orWhere('Color', 'like', "%{$this->search}%")
                            ->orWhere('ChassisNumber', 'like', "%{$this->search}%")
                            ->orWhere('WarrantyExpiration', 'like', "%{$this->search}%");
                    });
            })->get();

        return $customers;
    }

    private function getAllCustomers(): LengthAwarePaginator
    {
        $customers = Customer::oldest()
            ->select(
                'date_of_insurance_entry',
                'Customer_uuid',
                'PlateNo',
                'PhoneNumber',
                'CompanyName',
                'OfficeAddress',
                'OtherLocation',
                'OrderDate',
                'MethodPayment',
                'driver_name',
                'car_insurance_company',
                'resident_iqama_number',
                'driver_license_number',
                'driver_license_expiry_date',
                'insurance_expiry_date',
                'driver_status',
                'driver_card',
                'operating_card'
            )
            ->where(function ($query) {
                $query->where('PlateNo', 'like', "%{$this->search}%")
                    ->orWhere('PhoneNumber', 'like', "%{$this->search}%")
                    ->orWhere('CompanyName', 'like', "%{$this->search}%")
                    ->orWhere('OfficeAddress', 'like', "%{$this->search}%")
                    ->orWhere('OtherLocation', 'like', "%{$this->search}%")
                    ->orWhere('driver_name', 'like', "%{$this->search}%")
                    ->orWhere('car_insurance_company', 'like', "%{$this->search}%")
                    ->orWhere('resident_iqama_number', 'like', "%{$this->search}%")
                    ->orWhere('driver_license_number', 'like', "%{$this->search}%")
                    ->orWhere('driver_status', 'like', "%{$this->search}%")
                    ->orWhere('driver_license_expiry_date', 'like', "%{$this->search}%")
                    ->orWhere('insurance_expiry_date', 'like', "%{$this->search}%")
                    ->orWhere('driver_card', 'like', "%{$this->search}%")
                    ->orWhere('operating_card', 'like', "%{$this->search}%")
                    ->orWhere('OrderDate', 'like', "%{$this->search}%");
            })
            ->paginate(6);

        return $customers;
    }

    public function render()
    {
        $customers = $this->search !== '' ? $this->getSearchCustomer() : $this->getAllCustomers();

        return view('livewire.admin.delivery.manage-deliveries', [
            'customers' => $customers,
        ]);
    }
}
