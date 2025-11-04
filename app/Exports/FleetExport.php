<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class FleetExport implements FromView, ShouldAutoSize, WithDrawings
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function drawings()
    {
        $drawing = new Drawing;
        $drawing->setName('Logo');
        $drawing->setDescription('Sultanalfouzanco Logo');
        $drawing->setPath(public_path('long_logo.png'));
        $drawing->setHeight(90);
        $drawing->setWidth(630);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function view(): View
    {
        return view('livewire.admin.renting.excel.excel', [
            'fleet' => $this->data,
        ]);
    }
}
