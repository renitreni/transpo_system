<?php

namespace App\Livewire\Admin\Renting;

use App\Notifications\RentNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class AccountantApproval extends Component
{
    public string $decision;

    public string $personAccountant;

    public string $remark;

    public int $rent_id;

    public function openApproval(int $id)
    {
        $this->rent_id = $id;
        $this->dispatch('open-modal', 'approval-form-modal');
    }

    public function save()
    {
        $this->validate([
            'decision' => 'required',
            'personAccountant' => 'required',
            'remark' => 'sometimes',
        ]);

        $update = \App\Models\Rent::where('id', $this->rent_id)->first();
        $update->isAccountantApproved = $this->decision;
        $update->personAccountant = $this->personAccountant;
        $update->AccountantRemark = $this->remark;
        $track = $update->track_number;
        $update->update();
        $this->dispatch('close-modal', 'approval-form-modal');
        $msg = $this->decision ? "{$track} has been approved by accountant." : "{$track} has been rejected by accountant.";
        $person = auth()->user()->role;
        $date = Carbon::now();
        session()->flash('success', $msg);
        $this->reset('decision', 'personAccountant', 'remark');
        $user = \App\Models\User::find(1);
        Notification::send($user, new RentNotification($this->rent_id, $msg, $person, $date));

    }

    public function render()
    {
        $approvals = \App\Models\Rent::select('id', 'track_number', 'isAccountantApproved', 'isFleetApproved', 'isWorkshopApproved', 'isSalesApproved', 'personAccountant')
            ->where('personFleet', '!=', null)->where('personSales', '!=', null)->where('personWorkshop', '!=', null)
            ->get();

        return view('livewire.admin.renting.accountant-approval', compact('approvals'));
    }
}
