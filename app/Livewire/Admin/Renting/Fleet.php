<?php

namespace App\Livewire\Admin\Renting;

use App\Exports\FleetReportExport;
use App\Models\Fleet as ModelsFleet;
use App\Models\Rent;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Fleet extends Component
{
    public string $area;

    public string $date;

    public string $dayName;

    public string $branch_manager;

    public string $motion_official;

    public string $forman;

    public int $rent_id;

    public string $purchasedNumber;

    public string $companyCR;

    public string $contactPerson;

    public string $fleetArea;

    public $selectDownloadable;

    public function mount(): void
    {
        $this->date = Carbon::now()->toDateString();
        $this->dayName = Carbon::parse($this->date)->format('l');
        $this->selectDownloadable = ModelsFleet::all()->unique(function ($report) {
            return $report->area.$report->date;
        });
    }

    public function updatedRentId()
    {
        if ($this->rent_id == 0) {
            return $this->reset('purchasedNumber', 'companyCR', 'contactPerson');
        }
        $data = Rent::select('purchase_number', 'company_cr', 'contact_person')->where('id', $this->rent_id)->first();
        $this->purchasedNumber = $data->purchase_number;
        $this->companyCR = $data->company_cr;
        $this->contactPerson = $data->contact_person;
    }

    public function updatedDate(): void
    {
        $this->dayName = Carbon::parse($this->date)->format('l');
    }

    public function save()
    {
        $fleetArray = $this->validate([
            'area' => 'required|min:3',
            'date' => 'required',
            'dayName' => 'required',
            'branch_manager' => 'required',
            'motion_official' => 'required',
            'forman' => 'required',
            'rent_id' => 'required',
        ]);

        ModelsFleet::create($fleetArray);
        $this->dispatch('close-modal', 'add-fleet-report');
        session()->flash('success', 'Fleet Report was created. Add logs to the report.');
        $this->reset();
    }

    public function delete(ModelsFleet $fleet): void
    {
        $fleet->delete();
        session()->flash('success', 'Fleet report successfully deleted.');
    }

    public function log(int $id)
    {
        return $this->redirect(route('admin_Renting', ['id' => $id, 'lang' => 'en', 'page' => 'fleet-logs']));
    }

    public function downloadFleetReport()
    {
        $area = explode('/', $this->fleetArea);
        $fleets = ModelsFleet::where('area', $area[1])->where('date', $area[2])->with('logs')->get();

        $logs = [];
        foreach ($fleets as $fleet) {
            foreach ($fleet->logs as $log) {
                $logs[] = $log;
            }
        }
        $equipmentCounts = [
            'Working' => [],
            'Breakdown' => [],
        ];

        foreach ($logs as $log) {
            $equipmentType = $log->equipment_type;
            $equipmentStatus = $log->equipment_status;

            if ($equipmentStatus == 'Working') {
                if (isset($equipmentCounts['Working'][$equipmentType])) {
                    $equipmentCounts['Working'][$equipmentType]++;
                } else {
                    $equipmentCounts['Working'][$equipmentType] = 1;
                }
            } elseif ($equipmentStatus == 'Breakdown') {
                if (isset($equipmentCounts['Breakdown'][$equipmentType])) {
                    $equipmentCounts['Breakdown'][$equipmentType]++;
                } else {
                    $equipmentCounts['Breakdown'][$equipmentType] = 1;
                }
            }
        }

        return Excel::download(new FleetReportExport($fleets, $logs, $area[0], $equipmentCounts), "{$area[1]}-{$area[2]}-report.xlsx");
    }

    public function render()
    {
        $companies = Rent::select('id', 'track_number', 'purchase_number', 'company_name')->get();
        $reports = ModelsFleet::with('rent')->get();

        return view('livewire.admin.renting.fleet')->with(
            [
                'companies' => $companies,
                'reports' => $reports,
            ]
        );
    }
}
