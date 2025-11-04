<?php

namespace App\Livewire\Admin\Renting;

use App\Mail\SendEmail as Send;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class SendEmail extends Component
{
    public string $recipient;

    public string $subject;

    public string $body;

    public function send()
    {
        $this->validate([
            'recipient' => 'required|email',
            'subject' => 'required|min:3',
            'body' => 'required|min:3',
        ]);

        Mail::send(new Send($this->recipient, $this->subject, $this->body));
        session()->flash('success', 'Email was sent successfully.');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.renting.send-email');
    }
}
