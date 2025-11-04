<?php

namespace App\Livewire\Admin\Supplier;

use App\Models\WarrantyReport;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Supplier extends Component
{
    use WithFileUploads;
    use WithPagination;

    public string $search = '';

    public string $dir = 'ltr';

    public function mount(string $lang)
    {
        App::setLocale($lang);
        $lang == 'ar' ? $this->dir = 'rtl' : 'ltr';
    }

    public function render(): View
    {
        $collections = $this->search !== '' ? $this->searchData() : $this->getAllData();

        return view('livewire.admin.supplier.supplier', [
            'supplies' => $collections,
        ])->layout('/livewire/layout/app', ['dir' => $this->dir])->title(strtoupper(auth()->user()->role));
    }

    private function getAllData(): LengthAwarePaginator
    {
        $collection = WarrantyReport::where('Brand', strtoupper(auth()->user()->role))->paginate(10);

        return $collection;
    }

    private function searchData(): Collection
    {
        $collection = WarrantyReport::where('Brand', strtoupper(auth()->user()->role))
            ->where(function ($query) {
                $query->where('Name', 'LIKE', "%{$this->search}%")
                    ->orWhere('Company', 'LIKE', "%{$this->search}%")
                    ->orWhere('Model', 'LIKE', "%{$this->search}%")
                    ->orWhere('VIN_ID', 'LIKE', "%{$this->search}%")
                    ->orWhere('PlateNumber', 'LIKE', "%{$this->search}%");
            })
            ->get();

        return $collection;
    }
}
