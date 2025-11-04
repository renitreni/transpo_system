<?php

namespace App\Livewire\Admin\Renting;

use App\Models\Rent;
use App\Models\User;
use App\Notifications\RentEmailNotification;
use App\Notifications\RentNotification;
use Carbon\Carbon;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Livewire\Attributes\On;
use Livewire\Component;

class Notification extends Component
{
    public function markAsRead($rent_id, $notif_id)
    {
        $notification = DatabaseNotification::find($notif_id);
        if ($notification) {
            $notification->markAsRead();
        }

        if (auth()->user()->role === 'Accounting') {
            return $this->redirect(route('admin_Renting', ['id' => $rent_id, 'lang' => 'en', 'page' => 'invoice-show']));
        }
    }

    #[On('refreshNotif')]
    public function render()
    {
        $users = User::find(1);
        $compareDate = Carbon::now()->addDays(2)->format('Y-m-d');

        $records = Rent::select('id', 'contact_email', 'contact_person', 'company_name', 'next_payment')
            ->whereDate('next_payment', $compareDate)
            ->where('paymentMethod', '<>', 365)
            ->where('notification_sent', false)
            ->get();

        if ($records->isNotEmpty()) {
            foreach ($records as $record) {
                $id = $record->id;
                $msg = "{$record->company_name} - Payment Due";
                $person = $record->contact_person;
                $date = $record->next_payment;
                FacadesNotification::send($users, new RentNotification($id, $msg, $person, $date));
                FacadesNotification::send($record, new RentEmailNotification($record));
                $record->notification_sent = true;
                $record->save();
            }
        }

        return view('livewire.admin.renting.notification', compact('users'));
    }
}
