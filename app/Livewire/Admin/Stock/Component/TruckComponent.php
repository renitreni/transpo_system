<?php

namespace App\Livewire\Admin\Stock\Component;

use App\Exports\TruckExcelExport;
use App\Models\Truck;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class TruckComponent extends Component
{
    use WithPagination;

    public string $search = '';

    public string $selectTypes = '';

    public string $selectStocks = '';

    public string $ChassisNumber;

    public string $Warehouse = 'WAREHOUSE RIYADH';

    public string $Type = 'MIXER';

    public string $Color;

    public string $Stocks = 'CAMAC';

    public int $totalTrucks = 0;

    public $editable_ChassisNumber;

    public $editable_Warehouse;

    public $editable_Stock;

    public $editable_Type;

    public $editable_Color;

    public $editID;

    public function downloadRecords()
    {
        return Excel::download(new TruckExcelExport($this->selectTypes, $this->selectStocks), 'Trucks.xlsx');
    }

    public function edit($id): void
    {
        $this->editID = $id;
        $truck = Truck::find($id);
        $this->editable_ChassisNumber = $truck->ChassisNumber;
        $this->editable_Warehouse = $truck->Warehouse;
        $this->editable_Type = $truck->Type;
        $this->editable_Stock = $truck->Stocks;
        $this->editable_Color = strtoupper($truck->Color);
    }

    public function saveEdit($id)
    {
        $truck = Truck::find($id);
        $truck->ChassisNumber = $this->editable_ChassisNumber ?? 'N/A';
        $truck->Warehouse = $this->editable_Warehouse ?? 'N/A';
        $truck->Type = $this->editable_Type ?? 'N/A';
        $truck->Color = strtoupper($this->editable_Color) ?? 'N/A';
        $truck->Stocks = $this->editable_Stock;
        $truck->update();
        $this->reset();

        return session()->flash('success', 'Update Successfully!');
    }

    public function cancelEdit(): void
    {
        $this->reset();
    }

    public function delete(Truck $truck)
    {
        $truck->delete();

        return session()->flash('success', 'Successfully delete truck record!');
    }

    public function save()
    {
        $ifExist = Truck::where('ChassisNumber', $this->ChassisNumber)->first();

        if ($ifExist) {
            return session()->flash('error', 'Chassis Number already exist!');
        }
        try {
            $truck = new Truck;
            $truck->ChassisNumber = $this->ChassisNumber ?? 'N/A';
            $truck->Warehouse = $this->Warehouse ?? 'N/A';
            $truck->Type = $this->Type ?? 'N/A';
            $truck->Color = strtoupper($this->Color) ?? 'N/A';
            $truck->Stocks = $this->Stocks;
            $truck->save();
            $this->reset();

            return session()->flash('saved', 'Saved Successfully!');
        } catch (Exception $error) {
            Log::error('error saving truck record', ['reason' => $error->getMessage()]);
        }
    }

    public function render()
    {
        $this->totalTrucks = Truck::count();

        $trucks = Truck::oldest()->where('ChassisNumber', 'like', "%{$this->search}%")->paginate(8);

        if ($this->selectTypes !== '') {
            $trucks = Truck::oldest()->where('Type', $this->selectTypes)->paginate(8);
        }

        if ($this->selectStocks !== '') {
            $trucks = Truck::oldest()->where('Stocks', $this->selectStocks)->paginate(8);
        }

        if ($this->selectTypes !== '' && $this->selectStocks !== '') {
            $trucks = Truck::oldest()->where('Type', $this->selectTypes)->where('Stocks', $this->selectStocks)->paginate(8);
        }

        if ($this->search !== '') {
            $this->selectStocks = '';
            $this->selectTypes = '';
        }

        return view('livewire.admin.stock.component.truck-component', ['trucks' => $trucks]);
    }
}
