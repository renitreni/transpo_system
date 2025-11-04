<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $receiver;

    public $subject;

    public $body;

    public function __construct($receiver, $subject, $body)
    {
        $this->receiver = $receiver;
        $this->subject = $subject;
        $this->body = $body;
    }

    public function build()
    {
        return $this->from('info@sultanalfouzanco.online', 'Sultan Al Fouzan')
            ->to($this->receiver)
            ->subject($this->subject)
            ->view('livewire.admin.renting.mail.mail')
            ->with(['body' => $this->body]);
    }
}
