<?php

namespace App\Livewire\Admin\Renting;

use App\Models\RentInvoice;
use Livewire\Component;
use Livewire\WithPagination;

class Invoice extends Component
{
    use WithPagination;

    public function render()
    {
        $data = RentInvoice::with('rent')->latest()->paginate(5);

        return view('livewire.admin.renting.invoice')->with('invoices', $data);
    }
}
