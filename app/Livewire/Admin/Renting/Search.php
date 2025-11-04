<?php

namespace App\Livewire\Admin\Renting;

use App\Models\Rent;
use Livewire\Component;

class Search extends Component
{
    public string $search = '';

    public function show(int $id)
    {
        $this->dispatch('display-view-details', $id);
        $this->dispatch('close-modal', 'search-modal');
        $this->reset();
        //return redirect()->route('admin_Renting',['id'=>$id,'lang'=>'en','page'=>'request-edit']);
    }

    public function render()
    {
        $removeSpaceSearch = trim($this->search);
        $results = Rent::where('purchase_number', 'LIKE', "%{$removeSpaceSearch}%")
            ->orWhere('track_number', 'LIKE', "%{$removeSpaceSearch}%")
            ->orWhere('company_name', 'LIKE', "%{$removeSpaceSearch}%")
            ->orWhere('contact_person', 'LIKE', "%{$removeSpaceSearch}%")
            ->get();

        return view('livewire.admin.renting.search')->with('results', $results);
    }
}
