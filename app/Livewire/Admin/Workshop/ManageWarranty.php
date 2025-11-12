<?php

namespace App\Livewire\Admin\Workshop;

use App\Exports\WarrantyReportExport;
use App\Models\FileLog;
use App\Models\WarrantyReport;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Title('Warranty')]
#[Layout('/livewire/layout/app')]
class ManageWarranty extends Component
{
    use WithPagination;

    public string $search = '';

    public $viewData;

    public $selectStatus = '';

    public string $bgColor = '';

    public function mount()
    {
        session(['warrantyURL' => url()->current()]);
    }

    public function create()
    {
        return $this->redirect('@create', navigate: true);
    }

    public function viewWarranty(int $id)
    {
        $this->viewData = WarrantyReport::where('id', $id)->with('files')->with('supplierStatus')->first();

        if (isset($this->viewData->supplierStatus->Decision) && $this->viewData->supplierStatus->Decision == 'Approved') {
            $this->bgColor = '#53d55b';
        } elseif (isset($this->viewData->supplierStatus->Decision) && $this->viewData->supplierStatus->Decision == 'Rejected') {
            $this->bgColor = '#cb3737';
        } elseif (! isset($this->viewData->supplierStatus->Decision)) {
            $this->bgColor = '#f5d954';
        }

        $this->dispatch('open-warranty-modal');
    }

    public function cancel(): array
    {
        return $this->viewData = [];
    }

    public function edit(int $id)
    {
        return $this->redirect("@edit={$id}", navigate: true);
    }

    public function delete(int $id)
    {
        $warranty = WarrantyReport::where('id', $id)->with('files')->first();

        if (! $warranty) {
            return redirect()->back()->withErrors(['error' => 'Warranty report not found.']);
        }

        try {
            if (! empty($warranty->files)) {
                foreach ($warranty->files as $file) {
                    $imagePath = public_path("storage/uploads/images/{$file->FileName}");
                    $filePath = public_path("storage/uploads/files/{$file->FileName}");

                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                        FileLog::updateOrCreate([
                            'path' => $imagePath,
                        ], [
                            'path' => $imagePath,
                            'is_sync' => 3,
                        ]);
                    } elseif (file_exists($filePath)) {
                        unlink($filePath);
                        FileLog::updateOrCreate([
                            'path' => $filePath,
                        ], [
                            'path' => $filePath,
                            'is_sync' => 3,
                        ]);
                    }
                }
            }

            $warranty->delete();

            return redirect()->back()->with('success', 'Delete Successfully.');
        } catch (Exception $e) {
            Log::error("Error deleting warranty report with ID $id: " . $e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Failed to delete warranty report.']);
        }
    }

    public function render(): View
    {
        $collections = ($this->search === '') && ($this->selectStatus === '') ?  $this->getAllData() : $this->searchData();

        return view('livewire.admin.workshop.manage-warranty', [
            'collections' => $collections,
        ]);
    }

    private function getAllData(): LengthAwarePaginator
    {
        $collection = WarrantyReport::with('supplierStatus')->paginate(10);

        return $collection;
    }

    private function searchData(): Collection
    {
        $collection = WarrantyReport::oldest()
            ->with('supplierStatus')
            ->selectRaw('warranty_reports.*, supplier_warranties.Decision')
            ->leftJoin('supplier_warranties', 'supplier_warranties.Report_id', 'warranty_reports.id')
            ->where('supplier_warranties.Decision', $this->selectStatus == 'empty' ? null : $this->selectStatus)
            ->when($this->search, function ($query) {
                $query->where('Name', 'LIKE', "%{$this->search}%")
                    ->orWhere('Company', 'LIKE', "%{$this->search}%")
                    ->orWhere('Model', 'LIKE', "%{$this->search}%")
                    ->orWhere('VIN_ID', 'LIKE', "%{$this->search}%")
                    ->orWhere('Location', 'LIKE', "%{$this->search}%")
                    ->orWhere('PlateNumber', 'LIKE', "%{$this->search}%");
            })
            ->get();
        return $collection;
    }

    public function download()
    {
        return Excel::download(new WarrantyReportExport($this->search), 'warranty-report ' . now() . '.xlsx');
    }
}
