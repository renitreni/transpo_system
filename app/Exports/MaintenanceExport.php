<?php

namespace App\Exports;

use App\Models\Maintenance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MaintenanceExport implements FromView
{
    public function view(): View
    {
        return view('export-template.maintenance', [
            'maintenance' => Maintenance::all(),
        ]);
    }
}
