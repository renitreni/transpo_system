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

        if ($customer->FullName === 'N/A') {
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, 'No-Name'.' Receipt.pdf');
        }

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $customer->FullName.' Receipt.pdf');
    }

    public function viewPurchase(?string $customer_uuid = null)
    {
        $this->js('openViewPurchase()');

        $customer = Customer::where('Customer_uuid', $customer_uuid)->first();
        $orders = Order::where('Customer_id', $customer->id)->get();

        $this->data = [
            'customer' => $customer,
            'orders' => $orders,
        ];
    }

    public function edit(?string $customer_uuid = null)
    {
        //return redirect()->route('admin_EditReceipt',$customer_uuid);
        return $this->redirect(route('admin_EditReceipt', ['lang' => 'en', 'customer_uuid' => $customer_uuid]));
    }

    public function cancelView(): array
    {
        $this->js('closeViewPurchase()');

        return $this->data = [];
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
                $query->where('FullName', 'like', "%{$this->search}%")
                    ->orWhereHas('orders', function ($orderQuery) {
                        $orderQuery->where('Product', 'like', "%{$this->search}%")
                            ->orWhere('Color', 'like', "%{$this->search}%")
                            ->orWhere('ChassisNumber', 'like', "%{$this->search}%")
                            ->orWhere('CompanyName', 'like', "%{$this->search}%")
                            ->orWhere('WarrantyExpiration', 'like', "%{$this->search}%");
                        // Add more conditions as needed for order fields
                    });
            })->get();

        return $customers;
    }

    private function getAllCustomers(): LengthAwarePaginator
    {
        $customers = Customer::oldest()
            ->select('Customer_uuid', 'FullName', 'CompanyName', 'MethodPayment', 'OrderDate')
            ->where('FullName', 'like', "%{$this->search}%")
            ->orWhere('CompanyName', 'like', "%{$this->search}%")
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
