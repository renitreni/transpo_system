<?php

namespace App\Livewire\Admin\Inquire;

use App\Models\Inquire;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Inquiries')]
#[Layout('/livewire/layout/app')]
class ManageInquiries extends Component
{
    use WithPagination;

    public string $search = '';

    public ?Inquire $selectedInquiry = null;

    public function mount()
    {
        session(['inquireURL' => url()->current()]);
    }

    public function details(?string $inquiry_uuid = null)
    {
        try {
            $this->selectedInquiry = Inquire::where('inquire_uuid', $inquiry_uuid)->firstOrFail();
        } catch (Exception $error) {
            session()->flash('error', 'No Details: Something went wrong.');
            Log::error('Error @details method', [
                'reason' => $error->getMessage(),
            ]);
        }
    }

    public function deleteInquiry(?string $inquiry_uuid = null)
    {
        try {
            $inquiry = Inquire::where('inquire_uuid', $inquiry_uuid)->firstOrFail();
            if ($inquiry) {
                $inquiry->delete();
                session()->flash('success', 'Inquiry: Delete successfully.');
                \App\Models\Log::newLog('Delete', 'Inquire delete successfully.');
                $this->resetInquiryModal();
            } else {
                return session()->flash('error', 'Inquiry: Failed to delete.');
            }
        } catch (Exception $error) {
            session()->flash('notfound', 'No Details: Failed to delete.');
            Log::error('Error @deleteInquiry method', [
                'reason' => $error->getMessage(),
            ]);
        }
    }

    public function resetInquiryModal()
    {
        return $this->selectedInquiry = null;
    }

    public function render()
    {
        return view('livewire.admin.inquire.manage-inquiries', [
            'inquiries' => Inquire::latest()->where('FullName', 'like', "%{$this->search}%")->paginate(7),
        ]);
    }
}
