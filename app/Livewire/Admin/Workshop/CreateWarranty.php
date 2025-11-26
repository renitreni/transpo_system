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
            $this->form->File->storeAs('uploads/files', $fileName, 'public');
            $File->FileName = $fileName;
            $File->save();
        }

        foreach ($this->form->Images as $key => $image) {
            $Image = new WarrantyFiles;
            $Image->Report_id = $report->id;

            $fileName = Carbon::now()->timestamp.uniqid().'_'.$key.'.'.$this->form->Images[$key]->extension();
            $this->form->Images[$key]->storeAs('uploads/images', $fileName, 'public');

            $Image->FileName = $fileName;
            $Image->save();
        }

        $this->form->reset();

        return $this->redirect(route('admin_Approval', [
            'lang' => 'en',
            'id' => $report->id,
        ]), navigate: true);
    }

    /**
     * Get the next kilometer for Change Oil (current odometer + 9500)
     *
     * @return int|null
     */
    public function getNextKilometerProperty(): ?int
    {
        if (empty($this->form->Odometer)) {
            return null;
        }

        $value = (int) $this->form->Odometer;
        
        if ($value <= 0) {
            return null;
        }

        return $value + 9500;
    }

    public function render()
    {
        return view('livewire.admin.workshop.create-warranty');
    }
}
