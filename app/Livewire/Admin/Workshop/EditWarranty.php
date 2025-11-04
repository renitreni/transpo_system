<?php

namespace App\Livewire\Admin\Workshop;

use App\Livewire\Forms\WarrantyReportForm;
use App\Models\FileLog;
use App\Models\WarrantyFiles;
use App\Models\WarrantyReport;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Edit Warranty Report')]
#[Layout('/livewire/layout/app')]
class EditWarranty extends Component
{
    use WithFileUploads;

    public WarrantyReportForm $form;

    public int $warranty_id;

    public $files;

    public $supplier;

    public function mount(int $warranty_id)
    {
        $this->warranty_id = $warranty_id;
        $report = WarrantyReport::where('id', $warranty_id)->with('files')->with('supplierStatus')->first();
        $this->supplier = $report->supplierStatus;
        $this->form->Name = $report->Name;
        $this->form->PhoneNumber = $report->PhoneNumber;
        $this->form->Company = $report->Company;
        $this->form->Location = $report->Location;
        $this->form->Brand = $report->Brand;
        $this->form->Model = $report->Model;
        $this->form->VIN_ID = $report->VIN_ID;
        $this->form->Odometer = $report->Odometer;
        $this->form->Hours = $report->Hours;
        $this->form->PlateNumber = $report->PlateNumber;
        $this->form->Color = $report->Color;
        $this->form->ApprovedBy = $report->ApprovedBy;
        $this->form->DateApproved = $report->DateApproved;
        $this->form->Destination = $report->Destination;
        $this->form->Status = $report->Status;
        $this->form->Report = $report->Report;
        $this->files = $report->files;
    }

    public function save_edit()
    {
        $report = WarrantyReport::where('id', $this->warranty_id)->with('files')->first();
        $data = $this->form->all();

        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = strtoupper($value);
            }
        }
        $report->fill($data);
        $report->update();

        if ($this->form->File !== null) {
            $File = new WarrantyFiles;
            $File->Report_id = $report->id;
            $fileName = Carbon::now()->timestamp.uniqid().'.'.$this->form->File->extension();
            $this->form->File->storeAs('storage/uploads/files', $fileName);
            $File->FileName = $fileName;
            $File->save();
        }

        if (! empty($this->form->Images)) {
            foreach ($this->form->Images as $key => $image) {
                $Image = new WarrantyFiles;
                $Image->Report_id = $report->id;

                $fileName = Carbon::now()->timestamp.$key.'.'.$this->form->Images[$key]->extension();
                $this->form->Images[$key]->storeAs('storage/uploads/images', $fileName);

                $Image->FileName = $fileName;
                $Image->save();
            }
        }

        session()->flash('success', 'Updated successfully.');

        return $this->redirect("@edit={$this->warranty_id}", navigate: true);
    }

    public function delete_file(int $id)
    {
        $file = WarrantyFiles::where('id', $id)->first();
        $filePath = public_path("storage/uploads/files/{$file->FileName}");
        if (file_exists($filePath)) {
            unlink($filePath);
            FileLog::updateOrCreate([
                'path' => $filePath,
            ], [
                'path' => $filePath,
                'is_sync' => 3,
            ]);
        }
        $file->delete();
    }

    public function render()
    {
        return view('livewire.admin.workshop.edit-warranty');
    }
}
