<?php

namespace App\Livewire\Admin\Stock;

use App\Models\Forklift;
use App\Models\Truck;
use App\Models\WheelLoader;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Stocks')]
#[Layout('/livewire/layout/app')]
class GeneralSearchResult extends Component
{
    public $data;

    public function mount(string $chassisNumber)
    {
        $models = ['Truck' => Truck::class, 'WheelLoader' => WheelLoader::class, 'Forklift' => Forklift::class];

        foreach ($models as $modelName => $model) {
            $result = $model::where('ChassisNumber', $chassisNumber)->first();
            if ($result !== null) {
                $this->data[$modelName] = $result;
            }
        }

        return $this->data;
    }

    public function render()
    {

        return view('livewire.admin.stock.general-search-result');
    }
}
