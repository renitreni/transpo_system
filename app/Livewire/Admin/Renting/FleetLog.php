<?php

namespace App\Livewire\Admin\Renting;

use App\Exports\FleetExport;
use App\Models\FileLog;
use App\Models\Fleet;
use App\Models\FleetFile;
use App\Models\FleetLog as ModelsFleetLog;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class FleetLog extends Component
{
    use WithFileUploads;

    public int $fleet_id;

    public string $location;

    public string $working_hours;

    public string $equipment_type;

    public string $equipment_status;

    public string $equipment_no;

    public string $remarks;

    public string $driver_type;

    public string $driver_name;

    public string $employee_no;

    public $fileUpload;

    public $data;

    public function mount(int $id)
    {
        $this->fleet_id = $id;
        $this->equipment_status = 'Breakdown';
        $this->driver_type = 'Employee';
    }

    public function export(int $id)
    {
        $fleet = Fleet::where('id', $id)->with('rent', 'logs')->first();

        return Excel::download(new FleetExport($fleet), "fleet-report-{$fleet->date}.xlsx");
    }

    public function show(int $id): void
    {
        $this->data = ModelsFleetLog::where('id', $id)->with('files')->first();
        $this->dispatch('open-modal', 'log-details');
    }

    public function save()
    {
        $data = $this->validate([
            'fleet_id' => 'required',
            'location' => 'required',
            'working_hours' => 'required',
            'equipment_type' => 'required',
            'equipment_status' => 'required',
            'equipment_no' => 'required',
            'remarks' => 'required',
            'driver_type' => 'required',
            'driver_name' => 'required',
            'employee_no' => 'sometimes',
            'fileUpload.*' => 'max:1024',
        ]);

        $fleet = ModelsFleetLog::create($data);
        if (! empty($this->fileUpload)) {
            foreach ($this->fileUpload as $file) {
                $filename = $file->getClientOriginalName();
                $filesize = number_format($file->getSize() / 1024, 2).' KB';
                $fileMime = $file->getMimeType();
                $fileExtension = $file->getClientOriginalExtension();
                $file->storeAs('storage/uploads/renting/'.$filename);
                $fleet->files()->create([
                    'filename' => $filename,
                    'mime' => $fileMime,
                    'extension' => $fileExtension,
                    'size' => $filesize,
                ]);
            }
        }
        $this->dispatch('close-modal', 'add-log-report');
        session()->flash('success', 'New record has been added to the logs');
        $this->resetExcept('fleet_id');
    }

    public function delete(ModelsFleetLog $log): void
    {
        $files = FleetFile::where('log_id', $log->id)->get();
        if (! empty($files)) {
            foreach ($files as $file) {
                Storage::disk('public')->delete('uploads/renting/'.$file->filename);
                FileLog::updateOrCreate([
                    'path' => 'storage/uploads/renting/'.$file->filename,
                ], [
                    'path' => 'storage/uploads/renting/'.$file->filename,
                    'is_sync' => 3,
                ]);
            }
        }
        $log->delete();
        session()->flash('success', 'Successfully deleted.');
    }

    public function render()
    {
        $fleetData = Fleet::with('rent', 'logs')->where('id', $this->fleet_id)->first();

        return view('livewire.admin.renting.fleet-log')->with('fleetData', $fleetData);
    }
}
