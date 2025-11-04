<?php

namespace App\Livewire\Admin\Workshop;

use App\Livewire\Forms\WarrantyReportForm;
use App\Models\WarrantyFiles;
use App\Models\WarrantyReport;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Create Warranty Report')]
#[Layout('/livewire/layout/app')]
class CreateWarranty extends Component
{
    use WithFileUploads;

    public WarrantyReportForm $form;

    public function create_report()
    {
        $report = new WarrantyReport;
        $data = $this->form->all();

        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = strtoupper($value);
            }
        }

        $report->fill($data);
        $report->save();
        //$this->report_id = $report->id;
        if ($this->form->File !== null) {
            $File = new WarrantyFiles;
            $File->Report_id = $report->id;
            $fileName = Carbon::now()->timestamp.uniqid().'.'.$this->form->File->extension();
            $this->form->File->storeAs('storage/uploads/files', $fileName);
            $File->FileName = $fileName;
            $File->save();
        }

        foreach ($this->form->Images as $key => $image) {
            $Image = new WarrantyFiles;
            $Image->Report_id = $report->id;

            $fileName = Carbon::now()->timestamp.$key.'.'.$this->form->Images[$key]->extension();
            $this->form->Images[$key]->storeAs('storage/uploads/images', $fileName);

            $Image->FileName = $fileName;
            $Image->save();
        }

        $this->form->reset();

        return $this->redirect(route('admin_Approval', [
            'lang' => 'en',
            'id' => $report->id,
        ]), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.workshop.create-warranty');
    }
}
