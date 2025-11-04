<?php

namespace App\Livewire\Admin\Renting;

use App\Models\FileLog;
use App\Models\Rent;
use App\Models\User;
use App\Notifications\RentNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Renting Service')]
#[Layout('/livewire/layout/app')]
class Renting extends Component
{
    use WithPagination;

    public $view;

    public string $page = '';

    public int $rentId;

    public bool $decision;

    public string $personSales = '';

    public string $remark = '';

    public function mount(?string $page = '', ?int $id = null)
    {
        $this->page = $page ?? '';
        $id ? $this->view = $id : $this->view = null;
    }

    public function delete(Rent $rent)
    {
        foreach ($rent->files as $file) {
            $file != null && $this->deleteFile($file->filename);
        }
        $rent->delete();

        return redirect()->route('admin_Renting', ['lang' => 'en']);
    }

    #[On('display-view-details')]
    public function viewRent(Rent $rent): void
    {
        $this->dispatch('open-modal', 'view_rent');
        $this->view = $rent;

    }

    public function approval(int $id)
    {
        $this->rentId = $id;
        $this->dispatch('open-modal', 'approve-sales-modal');
    }

    public function saveApproval()
    {
        $this->validate([
            'decision' => 'required',
            'personSales' => 'required',
            'remark' => 'sometimes',
        ]);
        $update = Rent::where('id', $this->rentId)->first();
        $update->isSalesApproved = $this->decision;
        $update->personSales = $this->personSales;
        $update->salesRemark = $this->remark;
        $track = $update->track_number;
        $update->update();
        $this->dispatch('close-modal', 'approve-sales-modal');
        $msg = $this->decision ? "{$track} has been approved by sales." : "{$track} has been rejected by sales.";
        $person = auth()->user()->role;
        $date = Carbon::now();
        session()->flash('success', $msg);
        $this->reset('decision', 'personSales', 'remark');
        $user = User::find(1);
        Notification::send($user, new RentNotification($this->rentId, $msg, $person, $date));
        $this->dispatch('refreshNotif');
    }

    public function edit(Rent $rent): void
    {
        $this->redirect(route('admin_Renting', ['lang' => 'en', 'page' => 'request-edit', 'id' => $rent->id]));
    }

    public function exportPDF(Rent $rent)
    {
        $pdf = Pdf::loadView('livewire.admin.renting.download.summary', ['rent' => $rent]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, "{$rent->company_name}-summary.pdf");
    }

    #[On('refreshTable')]
    public function render()
    {
        $collection = Rent::with('files')->paginate(5);

        return view('livewire.admin.renting.renting')->with('collection', $collection);
    }

    private function deleteFile(string $filename): bool
    {
        FileLog::updateOrCreate([
            'path' => 'storage/uploads/renting/'.$filename,
        ], [
            'path' => 'storage/uploads/renting/'.$filename,
            'is_sync' => 3,
        ]);

        return Storage::disk('public')->delete('uploads/renting/'.$filename);
    }
}
