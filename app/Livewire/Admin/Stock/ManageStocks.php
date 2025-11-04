<?php

namespace App\Livewire\Admin\Stock;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Stocks')]
#[Layout('/livewire/layout/app')]
class ManageStocks extends Component
{
    public string $selected = 'trucks';

    public string $generalSearch = '';

    public $results = [];

    public function mount(string $type)
    {
        $this->selected = $type;
    }

    public function goSearch()
    {
        $this->redirect(route('admin_generalSearch', ['lang' => 'en', 'chassisNumber' => $this->generalSearch]), navigate: true);
    }

    public function toggleSelected(string $value)
    {
        $this->selected = $value;

        return $this->redirect('en@stocks='.$value, navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.stock.manage-stocks');
    }
}
