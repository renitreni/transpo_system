<?php

namespace App\Livewire\Admin\Supplier;

use App\Models\FileLog;
use App\Models\Replacement;
use App\Models\SupplierWarranty;
use App\Models\WarrantyFiles;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Edit')]
#[Layout('/livewire/layout/app')]
class Edit extends Component
{
    use WithFileUploads;

    public array $replacements = [];

    public $Files;

    public $allFiles;

    public $techSig;

    public $custSig;

    public $approvalSig;

    public string $ProductName = '';

    public string $Dealer = '';

    public string $OrderNumber = '';

    public string $MachineNumber = '';

    public string $WorkingHours = '';

    public string $DateOfPurchased = '';

    public string $FeedbackTime = '';

    public string $CustomerName = '';

    public string $Contact = '';

    public bool $LooseMaterial = false;

    public bool $Dust = false;

    public bool $CoalField = false;

    public bool $Stones = false;

    public bool $Gravel = false;

    public bool $MetalOre = false;

    public bool $Plateau = false;

    public bool $TGreat = false;

    public bool $ZeroCel = false;

    public bool $TLess = false;

    public string $FailureDescription = '';

    public string $CausesAnalysis = '';

    public $SignatureTech;

    public string $DateSignatureTech = '';

    public $SignatureCustomer;

    public string $DateSignatureCustomer = '';

    public string $ApprovedBy = '';

    public string $DateApproved = '';

    public string $SupplierWarrantyApproval = '';

    public string $DealerRequestApproval = '';

    public string $DateWarrantySupplierRequest = '';

    public $ApprovalSignature;

    public string $SignatureDate = '';

    public int $report_id;

    public int $supplier_id;

    public string $dir = 'ltr';

    public $lang = 'en';

    public $warrantyId;

    public $id;

    public function mount()
    {
        $this->warrantyId = $this->id;
        $data = SupplierWarranty::where('Report_id', $this->warrantyId)->with('report')->first();
        $this->supplier_id = $data->id;
        $this->report_id = $data->report->id;
        $replacement = Replacement::where('supplier_id', $data->id)->get();

        foreach ($replacement as $value) {
            $this->replacements[] = [
                'FPCN' => $value->FPCN,
                'RPCN' => $value->RPCN,
                'NameModel' => $value->NameModel,
                'Quantity' => $value->Quantity,
            ];
        }

        $this->allFiles = WarrantyFiles::where('Report_id', $this->warrantyId)->get();
        $this->ProductName = $data->report->Brand.' '.$data->report->Model;
        $this->OrderNumber = $data->OrderNumber;
        $this->MachineNumber = $data->report->VIN_ID;
        $this->WorkingHours = $data->report->Odometer;
        $this->DateOfPurchased = $data->DateOfPurchased ?? '';
        $this->FeedbackTime = $data->FeedbackTime;
        $this->WorkingHours = $data->report->Odometer;
        $this->Dealer = $data->report->Company;
        $this->CustomerName = $data->report->Name;
        $this->Contact = $data->report->PhoneNumber;
        $this->LooseMaterial = $data->LooseMaterial;
        $this->Dust = $data->Dust;
        $this->CoalField = $data->CoalField;
        $this->Stones = $data->Stones;
        $this->Gravel = $data->Gravel;
        $this->MetalOre = $data->MetalOre;
        $this->Plateau = $data->Plateau;
        $this->TGreat = $data->TGreat;
        $this->ZeroCel = $data->ZeroCel;
        $this->TLess = $data->TLess;
        $this->FailureDescription = $data->FailureDescription;
        $this->CausesAnalysis = $data->CausesAnalysis;
        $this->techSig = $data->SignatureTech;
        $this->DateSignatureTech = date('F/d/Y', strtotime($data->DateSignatureTech));
        $this->DateSignatureCustomer = date('F/d/Y', strtotime($data->DateSignatureCustomer));
        $this->custSig = $data->SignatureCustomer;
        $this->ApprovedBy = $data->ApprovedBy;
        $this->DateApproved = date('F/d/Y', strtotime($data->DateApproved));
        $this->SupplierWarrantyApproval = $data->SupplierWarrantyApproval;
        $this->DealerRequestApproval = $data->DealerRequestApproval;
        $this->DateWarrantySupplierRequest = date('F/d/Y', strtotime($data->DateWarrantySupplierRequest));
        $this->approvalSig = $data->ApprovalSignature;
        $this->SignatureDate = date('F/d/Y', strtotime($data->SignatureDate));
        App::setLocale($this->lang);
    }

    public function addRows(): void
    {
        $this->replacements[] = [
            'FPCN' => '',
            'RPCN' => '',
            'NameModel' => '',
            'Quantity' => 0,
        ];
    }

    public function saveChanges()
    {
        $SigFileNameTech = '';
        $SigFileNameCustomer = '';
        $ApprovalSignature = '';

        if (isset($this->SignatureTech)) {
            $filename = uniqid().'-'.Carbon::now()->timestamp.'.'.$this->SignatureTech->extension();
            $this->SignatureTech->storeAs('uploads/supplier', $filename, 'public');
            $SigFileNameTech = $filename;
        }

        if (isset($this->SignatureCustomer)) {
            $filename = uniqid().'-'.Carbon::now()->timestamp.'.'.$this->SignatureCustomer->extension();
            $this->SignatureCustomer->storeAs('uploads/supplier', $filename, 'public');
            $SigFileNameCustomer = $filename;
        }

        if (isset($this->ApprovalSignature)) {
            $filename = uniqid().'-'.Carbon::now()->timestamp.'.'.$this->ApprovalSignature->extension();
            $this->ApprovalSignature->storeAs('uploads/supplier', $filename, 'public');
            $ApprovalSignature = $filename;
        }

        $data = SupplierWarranty::findOrFail($this->supplier_id);
        $data->OrderNumber = strtoupper($this->OrderNumber);
        $data->DateOfPurchased = $this->DateOfPurchased;
        $data->FeedbackTime = strtoupper($this->FeedbackTime);
        $data->CausesAnalysis = strtoupper($this->CausesAnalysis);
        $data->LooseMaterial = $this->LooseMaterial;
        $data->Dust = $this->Dust;
        $data->CoalField = $this->CoalField;
        $data->Stones = $this->Stones;
        $data->Gravel = $this->Gravel;
        $data->MetalOre = $this->MetalOre;
        $data->Plateau = $this->Plateau;
        $data->TGreat = $this->TGreat;
        $data->ZeroCel = $this->ZeroCel;
        $data->TLess = $this->TLess;
        $data->FailureDescription = strtoupper($this->FailureDescription);
        $data->SignatureTech = $SigFileNameTech == '' ? $this->techSig : $SigFileNameTech;
        $data->DateSignatureTech = strtoupper($this->DateSignatureTech);
        $data->DateSignatureCustomer = strtoupper($this->DateSignatureCustomer);
        $data->SignatureCustomer = $SigFileNameCustomer == '' ? $this->custSig : $SigFileNameCustomer;
        $data->ApprovedBy = strtoupper($this->ApprovedBy);
        $data->DateApproved = strtoupper($this->DateApproved);
        $data->SupplierWarrantyApproval = strtoupper($this->SupplierWarrantyApproval);
        $data->DealerRequestApproval = strtoupper($this->DealerRequestApproval);
        $data->DateWarrantySupplierRequest = strtoupper($this->DateWarrantySupplierRequest);
        $data->ApprovalSignature = $ApprovalSignature == '' ? $this->approvalSig : $ApprovalSignature;
        $data->SignatureDate = strtoupper($this->SignatureDate);

        $data->update();

        if (! empty($this->replacements)) {
            foreach ($this->replacements as $parts) {
                $trimmedPart = array_map('trim', $parts);
                $trimmedPart = array_map(function ($value) {
                    return preg_replace('/\s+/', ' ', strtoupper($value));
                }, $trimmedPart);

                $existingReplacement = Replacement::where([
                    'supplier_id' => $this->supplier_id,
                    'FPCN' => $trimmedPart['FPCN'],
                    'RPCN' => $trimmedPart['RPCN'],
                    'NameModel' => $trimmedPart['NameModel'],
                ])->first();

                if ($existingReplacement) {
                    $existingReplacement->fill($trimmedPart);
                    $existingReplacement->save();
                }
            }
        }

        if (isset($this->Files)) {
            foreach ($this->Files as $key => $file) {
                $File = new WarrantyFiles;
                $File->Report_id = $this->report_id;

                $fileName = Carbon::now()->timestamp.$key.'.'.$this->Files[$key]->extension();
                $this->Files[$key]->storeAs('uploads/supplier/files', $fileName, 'public');

                $File->FileName = $fileName;
                $File->save();
            }
        }
        session()->flash('success', 'Successfully updated');

        return $this->redirect(route('admin_EditSupplier', [
            'lang' => 'en',
            'id' => $this->report_id,
        ]));
    }

    public function removeRows(): void
    {
        array_pop($this->replacements);
    }

    public function deleteFile(int $id): void
    {
        $file = WarrantyFiles::where('id', $id)->first();
        $filePath = public_path("storage/uploads/supplier/files/{$file->FileName}");
        if (file_exists($filePath)) {
            unlink($filePath);
            FileLog::updateOrCreate([
                'path' => $filePath,
            ], [
                'path' => $filePath,
                'is_sync' => 3,
            ]);
        }
        $file->delete();
    }

    public function deleteSignatures(string $col, string $signature)
    {
        $sig = SupplierWarranty::where($col, $signature)->first();
        $filePath = public_path("storage/uploads/supplier/{$signature}");
        if (file_exists($filePath)) {
            unlink($filePath);
            FileLog::updateOrCreate([
                'path' => $filePath,
            ], [
                'path' => $filePath,
                'is_sync' => 3,
            ]);
        }
        $sig->$col = '';
        $sig->update();
        session()->flash('success', "{$signature} successfully deleted.");

        return $this->redirect(route('admin_EditSupplier', [
            'lang' => 'en',
            'id' => $this->report_id,
        ]));
    }

    public function render()
    {
        return view('livewire.admin.supplier.edit');
    }
}
