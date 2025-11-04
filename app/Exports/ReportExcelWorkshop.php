<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ReportExcelWorkshop implements FromView, ShouldAutoSize, WithDrawings
{
    public function __construct(string $company, string $supplier, string $year, $data)
    {
        $this->company = $company;
        $this->supplier = $supplier;
        $this->year = $year;
        $this->data = $data;
    }

    public function drawings()
    {
        $drawing = new Drawing;
        $drawing->setName('Logo');
        $drawing->setDescription('alesnaad Logo');
        $drawing->setPath(public_path('long_logo.png'));
        $drawing->setHeight(90);
        $drawing->setWidth(630);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        return view('livewire.admin.workshop.excel.report', [
            'company' => $this->company,
            'supplier' => $this->supplier,
            'year' => $this->year,
            'data' => $this->data,
        ]);
    }
}
