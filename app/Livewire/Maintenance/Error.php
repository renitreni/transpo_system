<?php

namespace App\Livewire\Maintenance;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Under Maintenance')]
#[Layout('livewire/layout/app')]
class Error extends Component
{
    public function render()
    {
        return view('livewire.maintenance.error');
    }
}
