<?php

namespace App\Livewire\Admin\Workshop;

use App\Exports\ReportExcelWorkshop;
use App\Models\ReportWorkshop;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Report extends Component
{
    use WithPagination;

    public string $company_name;

    public string $supplier_name;

    public string $description;

    public string $vin;

    public string $date_services;

    public float $labor_cost;

    public float $total_price;

    public string $remarks;

    public $company_select;

    public $year_select;

    public $supplier_select;

    public string $selectedCompany;

    public string $selectedSupplier;

    public $selectedYear;

    public function save()
    {
        $validated = $this->validate([
            'company_name' => 'required',
            'supplier_name' => 'required',
            'description' => 'required',
            'vin' => 'required|unique:report_workshops,vin',
            'date_services' => 'required',
            'labor_cost' => 'required|numeric',
            'total_price' => 'required|numeric',
            'remarks' => 'sometimes',
        ]);

        ReportWorkshop::create($validated);
        $this->dispatch('close-modal', 'add-new-report');
        $this->reset();
        session()->flash('success', 'New report has been added.');
    }

    public function populateSelect()
    {
        $this->company_select = ReportWorkshop::select('company_name')->get();
        $this->supplier_select = ReportWorkshop::select('supplier_name')->get();
        $this->year_select = ReportWorkshop::selectRaw('YEAR(date_services) as year')
            ->distinct()
            ->orderBy('year', 'asc')
            ->get();
    }

    public function download()
    {
        $this->populateSelect();
        $this->validate([
            'selectedCompany' => 'required',
            'selectedSupplier' => 'required',
            'selectedYear' => 'required',
        ]);

        $data = ReportWorkshop::where('company_name', $this->selectedCompany)
            ->where('supplier_name', $this->selectedSupplier)
            ->whereYear('date_services', $this->selectedYear)
            ->get();

        return Excel::download(new ReportExcelWorkshop($this->selectedCompany, $this->selectedSupplier, $this->selectedYear, $data), "{$this->selectedCompany}-{$this->selectedYear}.xlsx");
    }

    public function render()
    {
        $reports = ReportWorkshop::paginate(10);

        return view('livewire.admin.workshop.report', [
            'reports' => $reports,
        ]);
    }
}
