<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentEmailNotification extends Notification
{
    use Queueable;

    public function __construct($record)
    {
        $this->record = $record;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $date = Carbon::parse($this->record->next_payment);
        $formattedDate = $date->format('F d, Y');

        return (new MailMessage)
            ->greeting("Good Day Mr/Ms. {$this->record->contact_person}")
            ->subject('Payment due')
            ->line("Please be reminded that your next payment is on {$formattedDate}.")
            ->line('Thank you for using our service!');
    }
}
