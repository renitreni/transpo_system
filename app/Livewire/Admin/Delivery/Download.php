<?php

namespace App\Livewire\Admin\Delivery;

use App\Exports\DownloadExcelExport;
use App\Models\Customer;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Download extends Component
{
    public string $selectedYear = '';

    public string $selectedProduct = '';

    public $dates = [];

    public $years = [];

    public $products = [];

    public function mount()
    {

        $this->dates = Customer::distinct()->pluck('OrderDate');
        $getYears = [];

        foreach ($this->dates as $date) {
            $getYears[] = Carbon::createFromFormat('Y-m-d', $date)->year;
        }

        $this->years = array_unique($getYears);
    }

    public function updatedSelectedYear($value)
    {
        $this->selectedProduct = '';

        if (! empty($value)) {
            $this->products = Customer::whereYear('OrderDate', $value)
                ->join('orders', 'customers.id', '=', 'orders.Customer_id')
                ->distinct()
                ->pluck('orders.product')
                ->map(function ($product) {

                    return preg_replace('/\s+/', ' ', trim($product));
                })
                ->unique();

            $this->products = $this->products->values()->all();
        } else {
            $this->products = [];
        }
    }

    public function download()
    {
        $fileName = 'Sales-all-years.xlsx';
        if ($this->selectedYear !== '') {

            $selectedProduct = $this->selectedProduct;
            if (strpos($selectedProduct, '/') !== false) {
                $selectedProduct = str_replace('/', '-', $selectedProduct);
            }
            $fileName = 'Sales-'.$this->selectedYear.'-'.$selectedProduct.'.xlsx';
        }

        return Excel::download(new DownloadExcelExport($this->selectedYear, $this->selectedProduct), $fileName);
    }

    public function render()
    {
        return view('livewire.admin.delivery.download');
    }
}
