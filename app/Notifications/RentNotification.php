<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RentNotification extends Notification
{
    use Queueable;

    public int $rentid;

    public string $msg;

    public string $person;

    public string $date;

    public function __construct(int $rentid, string $msg, string $person, string $date)
    {
        $this->rentid = $rentid;
        $this->msg = $msg;
        $this->person = $person;
        $this->date = $date;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'rent_id' => $this->rentid,
            'msg' => $this->msg,
            'person' => $this->person,
            'date' => $this->date,
        ];
    }
}
