<?php

namespace App\Livewire\Admin\Workshop;

use App\Models\Order;
use App\Models\WorkshopCustomer;
use App\Models\WorkshopInvoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Workshop')]
#[Layout('/livewire/layout/app')]
class Workshop extends Component
{
    use WithPagination;

    public $services = [];

    public string $search = '';

    public $Customer_Name = '';

    public $Balance_Amount;

    public $SubTotal = 0;

    public int $customerID;

    public string $page;

    public function mount(?string $page = null)
    {
        $this->add();
        if ($page) {
            $this->page = $page;
        }
    }

    public function updatedServices(): void
    {
        $this->SubTotal = 0;

        foreach ($this->services as $index => $service) {

            if (! isset($service['ServiceFee']) || $service['ServiceFee'] == '') {
                $service['ServiceFee'] = 0;
            }

            if (! isset($service['WorkshopFee']) || $service['WorkshopFee'] == '') {
                $service['WorkshopFee'] = 0;
            }

            if (! isset($service['UnitAmount']) || $service['UnitAmount'] == '') {
                $service['UnitAmount'] = 0;
            }

            if (! isset($service['TotalAmount']) || $service['TotalAmount'] == '') {
                $service['TotalAmount'] = 0;
            }
            $totalAmount = $service['ServiceFee'] + $service['WorkshopFee'] + $service['UnitAmount'];
            $this->services[$index]['TotalAmount'] = $totalAmount;
            $this->SubTotal += $totalAmount;
        }
    }

    public function create()
    {
        $customer = new WorkshopCustomer;
        $customer->Customer_Name = trim($this->Customer_Name) !== '' ? trim($this->Customer_Name) : 'N/A';
        $customer->SubTotal = $this->SubTotal;
        $customer->Balance_Amount = $this->Balance_Amount;
        $customer->save();

        foreach ($this->services as $service) {
            $new_service = new WorkshopInvoice;
            $new_service->Customer_id = $customer->id;
            $new_service->fill($service);
            $new_service->save();
        }
        //$this->reset();
        $this->customerID = $customer->id;

        return session()->flash('success', 'Invoice created!');
    }

    public function add(): array
    {
        return $this->services[] = [
            'ServiceFee',
            'WorkshopFee',
            'UnitAmount',
            'TotalAmount',
        ];
    }

    public function remove(int $index): array
    {

        $this->SubTotal = $this->SubTotal - ($this->services[$index]['TotalAmount'] ?? 0);
        unset($this->services[$index]);

        return $this->services = array_values($this->services);
    }

    public function cancel()
    {
        return $this->reset();
    }

    public function downloadInvoice(int $customer_id)
    {
        $customer = WorkshopCustomer::where('id', $customer_id)->first();
        $services = WorkshopInvoice::where('Customer_id', $customer_id)->get();

        $pdf = Pdf::loadView('livewire/admin/workshop/invoice/invoice', [
            'customer' => $customer,
            'services' => $services,
        ]);

        if ($customer->Customer_Name === 'N/A') {
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, 'No-Name'.' Invoice.pdf');
        }

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, "{$customer->Customer_Name}-Invoice.pdf");
    }

    public function render()
    {
        return view('livewire.admin.workshop.workshop', [
            'products' => Order::latest()
                ->where('Product', 'like', "%{$this->search}%")
                ->orWhere('ChassisNumber', 'like', "%{$this->search}%")
                ->orWhere('Color', 'like', "%{$this->search}%")
                ->paginate(10),
        ]);
    }
}
