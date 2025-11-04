<?php

namespace App\Http\Controllers;

use App\Exports\MaintenanceExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportFileController extends Controller
{
    public function downloadXLSX(Request $request)
    {
        return Excel::download(new MaintenanceExport, 'maintenance-excel.xlsx');
    }
}
