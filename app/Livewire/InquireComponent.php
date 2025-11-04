<?php

namespace App\Livewire;

use App\Models\Inquire;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Inquire | Visual Angle Advertising Company')]
class InquireComponent extends Component
{
    #[Validate('required|min:3')]
    public string $FullName;

    #[Validate('required')]
    public string $Email;

    #[Validate('required')]
    public string $PhoneNumber;

    #[Validate('required|min:3')]
    public string $Message;

    //* Method for sending inquiry form
    public function send()
    {
        $this->validate();
        try {
            Inquire::create($this->all());
            session()->flash('success', 'Your Inquiry Has Been Sent Successfully! ');
            $this->reset();
        } catch (Exception $error) {
            Log::error('Database not connected @inquireComponent', [
                'reason' => $error->getMessage(),
            ]);
            session()->flash('error', 'Something went wrong! ');

        }
    }

    public function render()
    {
        return view('livewire.inquire-component');
    }
}
