<?php

namespace App\Livewire\Admin\Stock\Component;

use App\Exports\ForkliftExcelExport;
use App\Models\Forklift;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ForkliftComponent extends Component
{
    use WithPagination;

    public string $search = '';

    //public string $selectSizes = "";
    //public string $selectHeights = "";

    //public $sizes = [];
    //public $heights = [];

    public string $selectType = '';

    public $types = [];

    public string $ChassisNumber;

    public string $Size;

    public string $Height;

    public string $Warehouse = 'WAREHOUSE RIYADH';

    public string $Stocks = 'FAW';

    public string $Type = 'DUPLEX MAST';

    public int $totalForklifters = 0;

    public $editID;

    public string $editable_ChassisNumber;

    public string $editable_Warehouse;

    public string $editable_Size;

    public string $editable_Height;

    public string $editable_Type;

    public string $editable_Stock;

    public function downloadRecords()
    {
        return Excel::download(new ForkliftExcelExport($this->selectType), 'Forklifts.xlsx');
    }

    public function edit($id)
    {
        $this->editID = $id;
        $forklift = Forklift::find($id);
        $this->editable_ChassisNumber = $forklift->ChassisNumber;
        $this->editable_Warehouse = $forklift->Warehouse;
        $this->editable_Size = $forklift->Size;
        $this->editable_Height = $forklift->Height;
        $this->editable_Type = $forklift->Type;
        $this->editable_Stock = $forklift->Stocks;
    }

    public function saveEdit($id)
    {
        $forklift = Forklift::find($id);
        $forklift->ChassisNumber = $this->editable_ChassisNumber ?? 'N/A';
        $forklift->Warehouse = $this->editable_Warehouse ?? 'N/A';
        $forklift->Size = $this->editable_Size ?? 'N/A';
        $forklift->Height = $this->editable_Height ?? 'N/A';
        $forklift->Type = $this->editable_Type ?? 'N/A';
        $forklift->Stocks = $this->editable_Stock;
        $forklift->update();
        $this->reset();

        return session()->flash('success', 'Update Successfully!');
    }

    public function cancelEdit()
    {
        $this->reset();
    }

    public function delete(Forklift $forklift)
    {
        $forklift->delete();

        return session()->flash('success', 'Successfully delete record!');
    }

    public function save()
    {
        $ifExist = Forklift::where('ChassisNumber', $this->ChassisNumber)->first();

        if ($ifExist) {
            return session()->flash('error', 'Chassis Number already exist!');
        }
        try {
            $forklift = new Forklift;
            $forklift->ChassisNumber = $this->ChassisNumber ?? 'N/A';
            $forklift->Warehouse = $this->Warehouse ?? 'N/A';
            $forklift->Type = $this->Type ?? 'N/A';
            $forklift->Stocks = $this->Stocks ?? 'N/A';
            $forklift->Size = $this->Size;
            $forklift->Height = $this->Height;
            $forklift->save();
            $this->reset();

            return session()->flash('saved', 'Saved Successfully!');
        } catch (Exception $error) {
            Log::error('error saving forklift record', ['reason' => $error->getMessage()]);
        }
    }

    public function render()
    {
        $this->totalForklifters = Forklift::count();
        //$this->sizes = Forklift::distinct()->pluck('Size');
        //$this->heights = Forklift::distinct()->pluck('Height');
        $this->types = Forklift::distinct()->pluck('Type');

        $Forklifts = Forklift::oldest()->where('ChassisNumber', 'like', "%{$this->search}%")->paginate(8);

        /*if( $this->selectSizes !== "" ){
            $Forklifts = Forklift::oldest()->where("Size",$this->selectSizes)->paginate(8);
        }

        if($this->selectHeights !=="" ){
            $Forklifts = Forklift::oldest()->where("Height",$this->selectHeights)->paginate(8);
        }

        if($this->selectSizes !== "" && $this->selectHeights !==""){
            $Forklifts = Forklift::oldest()->where("Size",$this->selectSizes)->where("Height",$this->selectHeights)->paginate(8);
        }

        if($this->search !==""){
            $this->selectSizes = "";
            $this->selectHeights = "";
        }*/

        if ($this->selectType !== '') {
            $Forklifts = Forklift::oldest()->where('Type', $this->selectType)->paginate(8);
        }

        if ($this->search !== '') {
            $this->selectType = '';
        }

        return view('livewire.admin.stock.component.forklift-component', [
            'forklifts' => $Forklifts]);
    }
}
