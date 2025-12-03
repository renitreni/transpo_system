<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Workshop;

use App\Models\SupplierWarranty;
use App\Models\WarrantyReport;
use App\Services\FileUploadService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

/**
 * Edit Warranty Report Component
 *
 * This component handles the editing of warranty reports including
 * form data updates and file uploads (images and documents).
 *
 * Key Features:
 * - Update warranty report information
 * - Upload multiple images (max 10)
 * - Upload single document file
 * - Delete existing files
 * - Proper validation and error handling
 */
#[Title('Edit Warranty Report')]
#[Layout('/livewire/layout/app')]
class EditWarranty extends Component
{
    use WithFileUploads;

    /**
     * The warranty report ID
     *
     * @var int
     */
    public $warrantyId;

    /**
     * Warranty report fields
     *
     * @var string
     */
    public $name = '';
    public $phoneNumber = '';
    public $company = '';
    public $location = '';
    public $brand = '';
    public $model = '';
    public $bodyType = '';
    public $vinId = '';
    public $odometer = '';
    public $hours = '';
    public $plateNumber = '';
    public $color = '';
    public $approvedBy = '';
    public $dateApproved = '';
    public $destination = '';
    public $report = '';

    /**
     * @var bool
     */
    public $status = false;

    /**
     * Existing files
     *
     * @var array
     */
    public $files = [];

    /**
     * Supplier warranty status
     *
     * @var SupplierWarranty|null
     */
    public $supplier = null;

    /**
     * New images to upload (multiple)
     *
     * @var array
     */
    public $images = [];

    /**
     * New document file to upload (single)
     *
     * @var \Livewire\Features\SupportFileUploads\TemporaryUploadedFile|null
     */
    public $file = null;

    /**
     * File upload service
     *
     * @var FileUploadService
     */
    private $fileUploadService;

    /**
     * Boot the component
     */
    public function boot(FileUploadService $fileUploadService): void
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Mount the component and load warranty data
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function mount(): void
    {
        $this->loadWarrantyData();
    }

    /**
     * Load warranty report data
     */
    private function loadWarrantyData(): void
    {
        $report = WarrantyReport::with(['files', 'supplierStatus'])
            ->findOrFail($this->warrantyId);

        $this->supplier = $report->supplierStatus;
        $this->files = $report->files->toArray();

        // Populate component properties with existing data
        $this->name = $report->Name;
        $this->phoneNumber = $report->PhoneNumber;
        $this->company = $report->Company;
        $this->location = $report->Location;
        $this->brand = $report->Brand;
        $this->model = $report->Model;
        $this->bodyType = $report->BodyType ?? '';
        $this->vinId = $report->VIN_ID;
        $this->odometer = $report->Odometer;
        $this->hours = $report->Hours;
        $this->plateNumber = $report->PlateNumber;
        $this->color = $report->Color;
        $this->approvedBy = $report->ApprovedBy;
        $this->dateApproved = $report->DateApproved;
        $this->destination = $report->Destination;
        $this->status = $report->Status;
        $this->report = $report->Report;
    }

    /**
     * Save the edited warranty report
     *
     * This method updates the warranty report and handles file uploads.
     * All text fields are converted to uppercase for consistency.
     */
    public function saveEdit()
    {
        try {
            // Update the warranty report
            $this->updateWarrantyReport();

            // Handle file uploads
            $this->handleFileUploads();

            // Clear uploaded files from component state
            $this->resetFileInputs();

            session()->flash('success', 'Updated successfully.');

            return $this->redirect("@edit={$this->warrantyId}");
        } catch (\Exception $e) {
            Log::error('Failed to update warranty report', [
                'warranty_id' => $this->warrantyId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            session()->flash('error', 'Failed to update warranty report: ' . $e->getMessage());
        }
    }

    /**
     * Update warranty report data
     */
    private function updateWarrantyReport(): void
    {
        $report = WarrantyReport::findOrFail($this->warrantyId);

        // Update report with component properties (converted to uppercase)
        $report->Name = strtoupper($this->name);
        $report->PhoneNumber = $this->phoneNumber;
        $report->Company = strtoupper($this->company);
        $report->Location = strtoupper($this->location);
        $report->Brand = strtoupper($this->brand);
        $report->Model = strtoupper($this->model);
        $report->BodyType = $this->bodyType;
        $report->VIN_ID = strtoupper($this->vinId);
        $report->Odometer = strtoupper($this->odometer);
        $report->Hours = strtoupper($this->hours);
        $report->PlateNumber = strtoupper($this->plateNumber);
        $report->Color = strtoupper($this->color);
        $report->ApprovedBy = strtoupper($this->approvedBy);
        $report->DateApproved = strtoupper($this->dateApproved);
        $report->Destination = strtoupper($this->destination);
        $report->Status = $this->status;
        $report->Report = strtoupper($this->report);

        $report->save();
    }

    /**
     * Handle file uploads (images and document)
     */
    private function handleFileUploads(): void
    {
        // Upload document if provided
        if ($this->file !== null) {
            $this->validate([
                'file' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,txt',
            ]);

            $this->fileUploadService->uploadDocument($this->file, $this->warrantyId);
        }

        // Upload images if provided
        if (!empty($this->images)) {
            $this->validate([
                'images.*' => 'required|image|max:10240|mimes:jpg,jpeg,png,gif,webp,svg,bmp',
            ]);

            $this->fileUploadService->uploadImages($this->images, $this->warrantyId);
        }
    }

    /**
     * Reset file inputs after upload
     */
    private function resetFileInputs(): void
    {
        $this->images = [];
        $this->file = null;
    }

    /**
     * Delete a file
     *
     * @param int $fileId The ID of the file to delete
     */
    public function deleteFile(int $fileId): void
    {
        try {
            $this->fileUploadService->deleteFile($fileId);

            // Reload warranty data to refresh file list
            $this->loadWarrantyData();

            session()->flash('success', 'File deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete file', [
                'file_id' => $fileId,
                'error' => $e->getMessage(),
            ]);

            session()->flash('error', 'Failed to delete file: ' . $e->getMessage());
        }
    }

    /**
     * Get the next kilometer for Change Oil (current odometer + 9500)
     *
     * @return int|null
     */
    public function getNextKilometerProperty(): ?int
    {
        if (empty($this->odometer)) {
            return null;
        }

        $value = (int) $this->odometer;

        if ($value <= 0) {
            return null;
        }

        return $value + 9500;
    }

    /**
     * Render the component
     */
    public function render(): View
    {
        return view('livewire.admin.workshop.edit-warranty');
    }
}
