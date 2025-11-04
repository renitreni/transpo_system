<?php

namespace App\Exports;

use App\Models\WarrantyReport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class WarrantyReportExport implements FromQuery, WithHeadings, WithMapping
{
    public function __construct(public $search) {}

    public function query()
    {
        return WarrantyReport::oldest()
            ->where('Name', 'LIKE', "%{$this->search}%")
            ->orWhere('Company', 'LIKE', "%{$this->search}%")
            ->orWhere('Model', 'LIKE', "%{$this->search}%")
            ->orWhere('VIN_ID', 'LIKE', "%{$this->search}%")
            ->orWhere('Location', 'LIKE', "%{$this->search}%")
            ->orWhere('PlateNumber', 'LIKE', "%{$this->search}%");
    }

    public function map($row): array
    {
        return [
            $row->Name,
            $row->PhoneNumber,
            $row->Company,
            $row->Location,
            $row->Brand,
            $row->Model,
            $row->VIN_ID,
            $row->Odometer,
            $row->Hours,
            $row->PlateNumber,
            $row->Color,
            $row->ApprovedBy,
            $row->DateApproved,
            $row->Destination,
            $row->Status,
            $row->Report,
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'PhoneNumber',
            'Company',
            'Location',
            'Brand',
            'Model',
            'VIN_ID',
            'Odometer',
            'Hours',
            'PlateNumber',
            'Color',
            'ApprovedBy',
            'DateApproved',
            'Destination',
            'Status',
            'Report',
        ];
    }
}
