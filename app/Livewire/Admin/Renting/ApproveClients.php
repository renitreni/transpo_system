<?php

namespace App\Livewire\Admin\Renting;

use App\Notifications\RentNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ApproveClients extends Component
{
    use WithFileUploads;

    public $num_units;

    public $unitsDetails;

    public bool $decision;

    public string $personFleet = '';

    public string $remark = '';

    public $images;

    public int $rent_id;

    public function AddUnit(int $id, int $units)
    {
        $this->dispatch('open-modal', 'approval-fleet-form');
        $this->num_units = $units;
        $this->rent_id = $id;

        while ($units > 0) {
            $this->unitsDetails[] = [
                'truck_brand' => '',
                'truck_model' => '',
                'truck_size' => 0,
                'truck_vin' => '',
                'plate_number' => '',
                'insurance' => '',
                'operator_name' => '',
                'current_location' => '',
            ];
            $units--;
        }
    }

    #[On('reset-forms')]
    public function resetArray()
    {
        $this->unitsDetails = [];
    }

    public function save()
    {
        $validated = $this->validate([
            'decision' => 'required',
            'personFleet' => 'required',
            'remark' => 'sometimes',
            'images' => 'max:1024',
        ]);

        $update = \App\Models\Rent::where('id', $this->rent_id)->first();

        $update->isFleetApproved = $validated['decision'];
        $update->fleetRemark = $validated['remark'];
        $update->personFleet = $validated['personFleet'];

        if ($validated['decision']) {
            foreach ($this->unitsDetails as $details) {
                $update->approvalFleet()->create($details);
            }
        }

        if (! empty($this->images)) {
            foreach ($this->images as $image) {
                $filename = $image->getClientOriginalName();
                $image->storeAs('uploads/renting', $filename, 'public');
                $update->files()->create([
                    'rent_id' => $this->rent_id,
                    'filename' => $filename,
                ]);
            }
        }

        $track = $update->track_number;
        $msg = $this->decision ? "{$track} has been approved by fleet." : "{$track} has been rejected by fleet.";
        $person = auth()->user()->role;
        $date = Carbon::now();
        $update->update();
        $this->dispatch('close-modal', 'approval-fleet-form');
        session()->flash('success', 'Successfully done.');
        $this->reset('decision', 'remark', 'personFleet', 'images');
        $user = \App\Models\User::find(1);
        Notification::send($user, new RentNotification($this->rent_id, $msg, $person, $date));
        $this->dispatch('refreshNotif');
    }

    public function render()
    {
        $notApprovedData = \App\Models\Rent::where('isFleetApproved', false)
            ->where('personFleet', null)
            ->get();

        return view(
            'livewire.admin.renting.approve-clients',
            [
                'notApprovedData' => $notApprovedData,
            ]
        );
    }
}
