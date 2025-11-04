<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class FleetReportExport implements FromView, ShouldAutoSize, WithDrawings
{
    public function __construct($fleets, array $logs, string $company, array $counts)
    {
        $this->fleets = $fleets;
        $this->logs = $logs;
        $this->company = $company;
        $this->counts = $counts;
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
        return view('livewire.admin.renting.excel.fleet-report', [
            'fleets' => $this->fleets,
            'logs' => $this->logs,
            'company' => $this->company,
            'equipment_summary' => $this->counts,
        ]);
    }
}
