<?php

namespace App\Exports;

use App\Models\Forklift;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ForkliftExcelExport implements FromView, ShouldAutoSize, WithEvents
{
    //private string $size;
    //private string $height;
    private string $type;

    public function __construct(?string $type = '')
    {
        $this->type = $type;
    }

    public function view(): View
    {
        /*if( $this->size !== "" ){
            $trucks = Forklift::oldest()->where("Size",$this->size)->get();
        }

        if($this->height !== "" ){
            $trucks = Forklift::oldest()->where("Height",$this->height)->get();
        }

        if($this->size !== "" && $this->height !== ""){
            $trucks = Forklift::oldest()->where("Size",$this->size)->where("Height",$this->height)->get();
        }

        if($this->size === "" && $this->height === ""){
            $trucks = Forklift::oldest()->get();
        }*/

        if ($this->type !== '') {
            $trucks = Forklift::oldest()->where('Type', $this->type)->get();
        } else {
            $trucks = Forklift::oldest()->get();
        }

        return view('livewire.admin.stock.component.excels.excel-forklift', [
            'trucks' => $trucks]);
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
