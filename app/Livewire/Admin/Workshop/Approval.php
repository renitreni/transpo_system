<?php

namespace App\Livewire\Admin\Workshop;

use App\Notifications\RentNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Approval extends Component
{
    public $unitsDetails;

    public bool $decision;

    public string $personWorkshop = '';

    public string $remark = '';

    public int $rentID;

    public function open(int $id)
    {
        $this->rentID = $id;
        $this->unitsDetails = \App\Models\FleetApproval::where('rent_id', $id)->get();
        $this->dispatch('open-modal', 'approval-workshop-modal');
    }

    public function unitApprove()
    {
        $this->validate([
            'decision' => 'required',
            'personWorkshop' => 'required',
            'remark' => 'sometimes',
        ]);

        $update = \App\Models\Rent::where('id', $this->rentID)->first();
        $update->isWorkshopApproved = $this->decision;
        $update->personWorkshop = $this->personWorkshop;
        $update->workshopRemark = $this->remark;
        $track = $update->track_number;
        $msg = $this->decision ? "{$track} has been approved by workshop." : "{$track} has been rejected by workshop.";
        $person = auth()->user()->role;
        $date = Carbon::now();
        $update->update();
        $this->dispatch('close-modal', 'approval-workshop-modal');
        session()->flash('success', 'Workshop Approved.');
        $this->reset('decision', 'remark', 'personWorkshop');
        $user = \App\Models\User::find(1);
        Notification::send($user, new RentNotification($this->rentID, $msg, $person, $date));

    }

    public function render()
    {
        $rentData = \App\Models\Rent::where('personFleet', '!=', null)
            ->where('personSales', '!=', null)
            ->get();

        return view('livewire.admin.workshop.approval', compact('rentData'));
    }
}
