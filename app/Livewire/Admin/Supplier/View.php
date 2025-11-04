<?php

namespace App\Livewire\Admin\Supplier;

use App\Models\FileLog;
use App\Models\Replacement;
use App\Models\SupplierWarranty;
use App\Models\WarrantyFiles;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('View')]
#[Layout('/livewire/layout/app')]
class View extends Component
{
    use WithFileUploads;

    public $replacements = [];

    public $Files;

    public string $ProductName = '';

    public string $Dealer = '';

    public string $OrderNumber = '';

    public string $DateOfPurchased = '';

    public string $MachineNumber = '';

    public string $WorkingHours = '';

    public string $DateOfPurchase = '';

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

    public string $decision = '';

    public string $reason = '';

    public string $signedBy = '';

    public $signedSignature;

    public string $isSigned;

    public $returnDate;

    public $courier;

    public int $supply_id;

    public int $report_id;

    public function mount(int $id)
    {
        $data = SupplierWarranty::where('Report_id', $id)->with('report')->first();
        $this->supply_id = $data->id;
        $this->report_id = $id;
        $replacement = Replacement::where('supplier_id', $data->id)->get();

        foreach ($replacement as $value) {
            $this->replacements[] = [
                'FPCN' => $value->FPCN,
                'RPCN' => $value->RPCN,
                'NameModel' => $value->NameModel,
                'Quantity' => $value->Quantity,
            ];
        }

        $this->Files = WarrantyFiles::where('Report_id', $id)->get();
        $this->ProductName = $data->report->Brand.' '.$data->report->Model;
        $this->OrderNumber = $data->OrderNumber;
        $this->MachineNumber = $data->report->VIN_ID;
        $this->WorkingHours = $data->report->Odometer;
        $this->DateOfPurchased = date('F/d/Y', strtotime($data->DateOfPurchased));
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
        $this->SignatureTech = $data->SignatureTech;
        $this->DateSignatureTech = date('F/d/Y', strtotime($data->DateSignatureTech));
        $this->DateSignatureCustomer = date('F/d/Y', strtotime($data->DateSignatureCustomer));
        $this->SignatureCustomer = $data->SignatureCustomer;
        $this->ApprovedBy = $data->ApprovedBy;
        $this->DateApproved = date('F/d/Y', strtotime($data->DateApproved));
        $this->SupplierWarrantyApproval = $data->SupplierWarrantyApproval;
        $this->DealerRequestApproval = $data->DealerRequestApproval;
        $this->DateWarrantySupplierRequest = date('F/d/Y', strtotime($data->DateWarrantySupplierRequest));
        $this->ApprovalSignature = $data->ApprovalSignature;
        $this->SignatureDate = date('F/d/Y', strtotime($data->SignatureDate));
        $this->decision = $data->Decision ?? '';
        $this->reason = $data->Reason ?? '';
        $this->signedBy = $data->SignedBy ?? '';
        $this->isSigned = $data->SignedSignature ?? '';
        $this->returnDate = ! empty($data->return_date) ? Carbon::parse($data->return_date)->format('Y-m-d') : '';
        $this->courier = $data->courier ?? '';
    }

    public function back()
    {
        return $this->redirect(route('admin_Supplier', ['lang' => 'en']), navigate: true);
    }

    public function save()
    {
        $this->validate([
            'decision' => 'required',
            'returnDate' => 'required_if:decision,Approved',
            'courier' => 'required_if:decision,Approved',
        ]);

        if ($this->decision != 'Approved') {
            $this->returnDate = null;
            $this->courier = null;
        }

        $decision = SupplierWarranty::findOrFail($this->supply_id);
        $decision->Decision = $this->decision;
        $decision->Reason = $this->reason;
        $decision->SignedBy = $this->signedBy;
        $decision->return_date = $this->returnDate;
        $decision->courier = $this->courier;

        $file = '';
        if (isset($this->signedSignature)) {
            $filename = uniqid().'-'.Carbon::now()->timestamp.'.'.$this->signedSignature->extension();
            $this->signedSignature->storeAs('storage/uploads/supplier', $filename);
            $file = $filename;
        }

        $decision->SignedSignature = $file == '' ? $this->isSigned : $file;
        $decision->update();
        session()->flash('success', 'Successfully updated');

        return $this->redirect(route('admin_View_Supplier', [
            'lang' => 'en',
            'id' => $this->report_id,
        ]));
    }

    public function deleteFile(string $col, string $signature)
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

        return $this->redirect(route('admin_View_Supplier', [
            'lang' => 'en',
            'id' => $this->report_id,
        ]));
    }

    public function render()
    {
        return view('livewire.admin.supplier.view');
    }
}
