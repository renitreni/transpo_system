<?php

namespace App\Livewire\Admin\Renting;

use App\Livewire\Forms\ClientRequestForm;
use App\Models\FileLog;
use App\Models\Rent;
use App\Models\RentFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class RequestEquipment extends Component
{
    use WithFileUploads;

    public ClientRequestForm $form;

    public bool $isEdit = false;

    public $rent_id;

    public $files;

    public $checkedRows = [];

    public $isSalesApproved;

    public function mount(?int $id = null)
    {
        $this->form->entry_date = Carbon::now()->toDateString();
        $id && $this->prepareEdit($id);
        $this->rent_id = $id;
    }

    public function updatedFormPaymentMethod()
    {
        $this->calculatePerYear();
    }

    public function updatedFormServiceAmount()
    {
        $this->calculatePerYear();
    }

    public function save()
    {
        $files = [];
        if (! empty($this->form->imgInputs)) {
            foreach ($this->form->imgInputs as $image) {
                $filename = Carbon::now()->timestamp.'-'.uniqid().'.'.$image->extension();
                $image->storeAs('uploads/renting', $filename, config('filesystems.default'));
                $files[] = [
                    'filename' => $filename,
                ];
            }
        }
        if (! empty($this->form->fileInputs)) {
            foreach ($this->form->fileInputs as $file) {
                $filename = Carbon::now()->timestamp.'-'.uniqid().'.'.$file->extension();
                $file->storeAs('uploads/renting', $filename, config('filesystems.default'));
                $files[] = [
                    'filename' => $filename,
                ];
            }
        }

        try {
            if ($this->isEdit) {
                $save = Rent::find($this->rent_id)->update($this->form->all());
                session()->flash('success', 'Successfully edit request form.');

                return redirect()->route('admin_Renting', ['lang' => 'en', 'page' => 'request-edit', 'id' => $this->rent_id]);
            } else {
                if ($this->form->paymentMethod == 12) {
                    $this->form->next_payment = Carbon::createFromFormat('Y-m-d', $this->form->entry_date)->addMonth();
                } elseif ($this->form->paymentMethod == 52) {
                    $this->form->next_payment = Carbon::createFromFormat('Y-m-d', $this->form->entry_date)->addWeek();
                } elseif ($this->form->paymentMethod == 1) {
                    $this->form->next_payment = Carbon::createFromFormat('Y-m-d', $this->form->entry_date)->addYear();
                } else {
                    $this->form->next_payment = Carbon::createFromFormat('Y-m-d', $this->form->entry_date)->addDay();
                }
                $save = Rent::create($this->form->all());
                foreach ($files as $file) {
                    $save->files()->create($file);
                }
                $files = [];
                $this->form->reset();
                session()->flash('success', 'Successfully created request form. Waiting for fleet approval.');

                return redirect()->route('admin_Renting', ['lang' => 'en', 'page' => 'request']);
            }
        } catch (\Exception $ex) {
            Log::error('@RequestRentingForm', [
                'reason' => $ex->getMessage(),
                'line' => $ex->getLine(),
            ]);
            session()->flash('error', 'Something went wrong.');

            return redirect()->back();
        }
    }

    public function bulkDelete()
    {
        try {
            $totalFiles = count($this->checkedRows);
            foreach ($this->checkedRows as $row_id) {
                $file = RentFile::select('id', 'filename')->where('id', $row_id)->first();
                Storage::disk(config('filesystems.default'))->delete('uploads/renting/'.$file->filename);
                $file->delete();
                FileLog::updateOrCreate([
                    'path' => 'storage/uploads/renting/'.$file->filename,
                ], [
                    'path' => 'storage/uploads/renting/'.$file->filename,
                    'is_sync' => 3,
                ]);
            }
            session()->flash('success', "{$totalFiles} files were deleted.");

            return redirect()->route('admin_Renting', ['id' => $this->rent_id, 'lang' => 'en', 'page' => 'request-edit']);
        } catch (\Exception $error) {
            Log::error('@bulkDelete', [
                'reason' => $error->getMessage(),
            ]);
            session()->flash('error', 'Failed to delete the files. Something went wrong.');

            return redirect()->route('admin_Renting', ['id' => $this->rent_id, 'lang' => 'en', 'page' => 'request-edit']);
        }
    }

    public function uploadFiles()
    {
        try {
            $totalFiles = count($this->form->fileInputs);
            if (! empty($this->form->fileInputs)) {
                foreach ($this->form->fileInputs as $file) {
                    $filename = Carbon::now()->timestamp.'-'.uniqid().'.'.$file->extension();
                    $file->storeAs('uploads/renting', $filename, config('filesystems.default'));
                    RentFile::create([
                        'rent_id' => $this->rent_id,
                        'filename' => $filename,
                    ]);
                }
            }
            session()->flash('success', "{$totalFiles} files were successfully uploaded.");
            $this->form->fileInputs = null;

            return redirect()->route('admin_Renting', ['id' => $this->rent_id, 'lang' => 'en', 'page' => 'request-edit']);
        } catch (\Exception $exception) {
            Log::error('@uploadFiles', [
                'reason' => $exception->getMessage(),
            ]);
            session()->flash('error', 'Something went wrong.');

            return redirect()->route('admin_Renting', ['id' => $this->rent_id, 'lang' => 'en', 'page' => 'request-edit']);
        }
    }

    public function clear()
    {
        $this->form->fileInputs = null;
    }

    public function render()
    {
        return view('livewire.admin.renting.request-equipment');
    }

    private function calculatePerYear()
    {
        if ($this->form->service_amount == '') {
            $this->form->service_amount = 0;
        }

        return $this->form->total_service_amount = $this->form->paymentMethod * ($this->form->service_amount ?? 0);
    }

    private function prepareEdit(int $id)
    {
        $rent = Rent::where('id', $id)->with('files')->first();
        $this->form->assingValue($rent);
        $this->files = $rent->files;
        $this->isSalesApproved = $rent->isSalesApproved;
        $this->isEdit = true;
    }
}
