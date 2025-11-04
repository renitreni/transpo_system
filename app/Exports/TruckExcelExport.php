<?php

namespace App\Exports;

use App\Models\Truck;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class TruckExcelExport implements FromView, ShouldAutoSize, WithEvents
{
    private string $type;

    private string $stock;

    public function __construct(?string $type = '', ?string $stock = '')
    {
        $this->type = $type;
        $this->stock = $stock;
    }

    public function view(): View
    {

        if ($this->type !== '') {
            $trucks = Truck::oldest()->where('Type', $this->type)->get();
        }

        if ($this->stock !== '') {
            $trucks = Truck::oldest()->where('Stocks', $this->stock)->get();
        }

        if ($this->type !== '' && $this->stock !== '') {
            $trucks = Truck::oldest()->where('Type', $this->type)->where('Stocks', $this->stock)->get();
        }

        if ($this->type === '' && $this->stock === '') {
            $trucks = Truck::oldest()->get();
        }

        return view('livewire.admin.stock.component.excels.excel-truck', [
            'trucks' => $trucks,
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
