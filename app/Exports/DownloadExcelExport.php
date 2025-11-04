<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DownloadExcelExport implements FromView, ShouldAutoSize, WithEvents
{
    private string $year;

    private string $product;

    public function __construct(?string $year, ?string $product)
    {
        $this->year = $year;
        $this->product = $product;
    }

    public function view(): View
    {
        $data = [];
        if ($this->year !== '') {
            if ($this->product !== '') {
                $data = Order::where('Product', $this->product)->whereYear('Order_Date', $this->year)->get();
            } else {
                $data = Order::whereYear('Order_Date', $this->year)->get();
            }
        } else {
            $data = Order::all();
        }

        return view('livewire.admin.delivery.excels.export', [
            'data' => $data,
            'year' => $this->year,
            'product' => $this->product,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setShowGridlines(false);
            },
        ];
    }
}
