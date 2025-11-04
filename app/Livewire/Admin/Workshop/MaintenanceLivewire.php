<?php

namespace App\Livewire\Admin\Workshop;

use App\Models\Maintenance;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Maintenance | Workshop')]
class MaintenanceLivewire extends Component
{
    public $maintenance_id;

    public $company_cr; // 'company_cr',

    public $contact_person; //'contact_person',

    public $phone_no; //'phone_no',

    public $email; //'email',

    public $address; //'address',

    public $note; //'note',

    public $brand_name; //'brand_name',

    public $kilometers; //'kilometers',

    public $hour; //'hour',

    public $warranty; //'warranty',

    public $others; //'others',

    public $vin_no; //'vin_no',

    public $remarks; //'remarks'

    #[Layout('/livewire/layout/workshop')]
    public function render()
    {
        return view('livewire.maintenance-livewire');
    }

    public function resetFormFields()
    {
        $this->maintenance_id = null;
        $this->company_cr = null;
        $this->contact_person = null;
        $this->phone_no = null;
        $this->email = null;
        $this->address = null;
        $this->note = null;
        $this->brand_name = null;
        $this->kilometers = null;
        $this->hour = null;
        $this->warranty = null;
        $this->others = null;
        $this->vin_no = null;
        $this->remarks = null;
    }

    public function store()
    {
        $maintenance = app(Maintenance::class)->fill([
            'company_cr' => $this->company_cr,
            'contact_person' => $this->contact_person,
            'phone_no' => $this->phone_no,
            'email' => $this->email,
            'address' => $this->address,
            'note' => $this->note,
            'brand_name' => $this->brand_name,
            'kilometers' => $this->kilometers,
            'hour' => $this->hour,
            'warranty' => $this->warranty,
            'others' => $this->others,
            'vin_no' => $this->vin_no,
            'remarks' => $this->remarks,
        ]);
        $maintenance->save();

        $this->resetFormFields();
        $this->dispatch('pg:eventRefresh-MaintenanceTable');
        $this->js('$dispatch(\'close-modal\',\'add-new-maintenance\')');
    }

    #[On('fetch-maintenance')]
    public function fetchMaintenance($id)
    {
        $model = Maintenance::find($id);
        $this->maintenance_id = $model->id;
        $this->company_cr = $model->company_cr;
        $this->contact_person = $model->contact_person;
        $this->phone_no = $model->phone_no;
        $this->email = $model->email;
        $this->address = $model->address;
        $this->note = $model->note;
        $this->brand_name = $model->brand_name;
        $this->kilometers = $model->kilometers;
        $this->hour = $model->hour;
        $this->warranty = $model->warranty;
        $this->others = $model->others;
        $this->vin_no = $model->vin_no;
        $this->remarks = $model->remarks;
    }

    public function update()
    {
        $model = Maintenance::find($this->maintenance_id);
        $model->id = $this->maintenance_id;
        $model->company_cr = $this->company_cr;
        $model->contact_person = $this->contact_person;
        $model->phone_no = $this->phone_no;
        $model->email = $this->email;
        $model->address = $this->address;
        $model->note = $this->note;
        $model->brand_name = $this->brand_name;
        $model->kilometers = $this->kilometers;
        $model->hour = $this->hour;
        $model->warranty = $this->warranty;
        $model->others = $this->others;
        $model->vin_no = $this->vin_no;
        $model->remarks = $this->remarks;
        $model->save();

        $this->js('$dispatch(\'close-modal\',\'add-new-maintenance\')');
        $this->resetFormFields();
        $this->dispatch('pg:eventRefresh-MaintenanceTable');
    }

    public function delete()
    {
        Maintenance::destroy($this->maintenance_id);

        $this->js('$dispatch(\'close-modal\',\'add-new-maintenance\')');
        $this->resetFormFields();
        $this->dispatch('pg:eventRefresh-MaintenanceTable');
    }
}
