<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Manage Inventories')]
#[Layout('/livewire/layout/app')]
class ManageInventories extends Component
{
    public function render()
    {
        return view('livewire.admin.inventory.manage-inventories');
    }
}
