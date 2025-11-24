<?php

namespace App\Livewire\Admin\Stock\Component;

use App\Exports\WheelLoaderExport;
use App\Models\WheelLoader;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class WheelLoaderComponent extends Component
{
    use WithPagination;

    public string $search = '';

    public string $selectModels = '';

    public string $selectStatus = '';

    public string $BrandModel;

    public $optionModels = [];

    public string $ChassisNumber;

    public string $Warehouse = 'WAREHOUSE RIYADH';

    public string $Stocks = 'FAW';

    public string $Type = 'WHEEL LOADER';

    public string $isAvailable = 'AVAILABLE';

    public int $totalLoaders = 0;

    public $editID;

    public string $editable_BrandModel;

    public string $editable_ChassisNumber;

    public string $editable_Type;

    public string $editable_Stock;

    public string $editable_Warehouse;

    public string $editable_isAvailable;

    public function mount()
    {
        $this->optionModels = WheelLoader::select('BrandModel')->get();
    }

    public function downloadRecords()
    {
        return Excel::download(new WheelLoaderExport($this->selectModels, $this->selectStatus), 'Wheel Loaders.xlsx');
    }

    public function edit($id)
    {
        $this->editID = $id;
        $loader = WheelLoader::find($id);
        $this->editable_BrandModel = $loader->BrandModel;
        $this->editable_ChassisNumber = $loader->ChassisNumber;
        $this->editable_Type = $loader->Type;
        $this->editable_Stock = $loader->Stocks;
        $this->editable_Warehouse = $loader->Warehouse;
        $this->editable_isAvailable = $loader->isActive;
    }

    public function saveEdit($id)
    {
        $loader = WheelLoader::find($id);
        $loader->BrandModel = $this->editable_BrandModel ?? 'N/A';
        $loader->ChassisNumber = $this->editable_ChassisNumber ?? 'N/A';
        $loader->Warehouse = $this->editable_Warehouse ?? 'N/A';
        $loader->Type = $this->editable_Type ?? 'N/A';
        $loader->Stocks = $this->editable_Stock ?? 'N/A';
        $loader->isActive = $this->editable_isAvailable ?? 'N/A';
        $loader->update();
        $this->reset();

        return session()->flash('success', 'Update Successfully!');
    }

    public function cancelEdit()
    {
        $this->reset();
    }

    public function delete(WheelLoader $loader)
    {
        $loader->delete();

        return session()->flash('success', 'Successfully delete record!');
    }

    public function save()
    {
        $ifExist = WheelLoader::where('ChassisNumber', $this->ChassisNumber)->first();

        if ($ifExist) {
            return session()->flash('error', 'Chassis Number already exist!');
        }
        try {
            $wheel_loader = new WheelLoader;
            $wheel_loader->BrandModel = $this->BrandModel ?? 'N/A';
            $wheel_loader->ChassisNumber = $this->ChassisNumber ?? 'N/A';
            $wheel_loader->Warehouse = $this->Warehouse ?? 'N/A';
            $wheel_loader->Type = $this->Type ?? 'N/A';
            $wheel_loader->Stocks = $this->Stocks;
            $wheel_loader->isActive = $this->isAvailable;
            $wheel_loader->save();
            $this->reset();

            return session()->flash('saved', 'Saved Successfully!');
        } catch (Exception $error) {
            Log::error('error saving wheel loader record', ['reason' => $error->getMessage()]);
        }
    }

    public function render()
    {
        $this->optionModels = WheelLoader::distinct()->pluck('BrandModel');
        $this->totalLoaders = WheelLoader::count();

        $WheelLoader = WheelLoader::oldest()->where('ChassisNumber', 'like', "%{$this->search}%")->paginate(10);

        if ($this->selectModels !== '') {
            $WheelLoader = WheelLoader::oldest()->where('BrandModel', $this->selectModels)->paginate(8);
        }

        if ($this->selectStatus !== '') {
            $WheelLoader = WheelLoader::oldest()->where('isActive', $this->selectStatus)->paginate(8);
        }

        if ($this->selectModels !== '' && $this->selectStatus !== '') {
            $WheelLoader = WheelLoader::oldest()->where('BrandModel', $this->selectModels)->where('isActive', $this->selectStatus)->paginate(8);
        }

        if ($this->search !== '') {
            $this->selectModels = '';
            $this->selectStatus = '';
        }

        return view('livewire.admin.stock.component.wheel-loader-component', [
            'wheel_Loader' => $WheelLoader]);
    }
}
