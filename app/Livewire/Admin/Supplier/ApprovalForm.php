<?php

namespace App\Livewire\Admin\Supplier;

use App\Models\Replacement;
use App\Models\SupplierWarranty;
use App\Models\WarrantyFiles;
use App\Models\WarrantyReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Supplier')]
class ApprovalForm extends Component
{
    use WithFileUploads;

    public array $replacements = [];

    public $Files;

    public string $ProductName = '';

    public string $Dealer = '';

    public string $OrderNumber = '';

    public string $DateOfPurchased = '';

    public string $MachineNumber = '';

    public string $WorkingHours = '';

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

    public string $lang = 'en';

    public function mount(string $lang, int $id)
    {

        $data = WarrantyReport::where('id', $id)->first();
        $this->report_id = $data->id;
        $this->ProductName = $data->Brand.' '.$data->Model;
        $this->Dealer = $data->Company;
        $this->CustomerName = $data->Name;
        $this->WorkingHours = $data->Odometer;
        $this->Contact = $data->PhoneNumber;
        $this->MachineNumber = $data->VIN_ID;
        $this->DateOfPurchased = Carbon::now()->format('Y-m-d');
        $this->DateSignatureTech = Carbon::now()->format('Y-m-d');
        $this->DateSignatureCustomer = Carbon::now()->format('Y-m-d');
        $this->DateApproved = Carbon::now()->format('Y-m-d');
        $this->DateWarrantySupplierRequest = Carbon::now()->format('Y-m-d');
        $this->SignatureDate = Carbon::now()->format('Y-m-d');
        App::setLocale($lang);
        $this->lang = $lang;
        //$lang == "ar" ? $this->dir = "rtl" : "ltr";
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

    public function removeRows(): void
    {
        array_pop($this->replacements);
    }

    public function submitApproval()
    {
        $SigFileNameTech = '';
        $SigFileNameCustomer = '';
        $ApprovalSignature = '';

        if ($this->SignatureTech !== null) {
            $filename = uniqid().'-'.Carbon::now()->timestamp.'.'.$this->SignatureTech->extension();
            $this->SignatureTech->storeAs('storage/uploads/supplier', $filename);
            $SigFileNameTech = $filename;
        }

        if ($this->SignatureCustomer !== null) {
            $filename = uniqid().'-'.Carbon::now()->timestamp.'.'.$this->SignatureCustomer->extension();
            $this->SignatureCustomer->storeAs('storage/uploads/supplier', $filename);
            $SigFileNameCustomer = $filename;
        }

        if ($this->ApprovalSignature !== null) {
            $filename = uniqid().'-'.Carbon::now()->timestamp.'.'.$this->ApprovalSignature->extension();
            $this->ApprovalSignature->storeAs('storage/uploads/supplier', $filename);
            $ApprovalSignature = $filename;
        }

        $array_of_supply_fields = [
            'Report_id' => $this->report_id,
            'OrderNumber' => $this->OrderNumber,
            'DateOfPurchased' => $this->DateOfPurchased,
            'FeedbackTime' => $this->FeedbackTime,
            'CausesAnalysis' => $this->CausesAnalysis,
            'LooseMaterial' => $this->LooseMaterial,
            'Dust' => $this->Dust,
            'CoalField' => $this->CoalField,
            'Stones' => $this->Stones,
            'Gravel' => $this->Gravel,
            'MetalOre' => $this->MetalOre,
            'Plateau' => $this->Plateau,
            'TGreat' => $this->TGreat,
            'ZeroCel' => $this->ZeroCel,
            'TLess' => $this->TLess,
            'FailureDescription' => $this->FailureDescription,
            'SignatureTech' => $SigFileNameTech,
            'DateSignatureTech' => $this->DateSignatureTech,
            'DateSignatureCustomer' => $this->DateSignatureCustomer,
            'SignatureCustomer' => $SigFileNameCustomer,
            'ApprovedBy' => $this->ApprovedBy,
            'DateApproved' => $this->DateApproved,
            'SupplierWarrantyApproval' => $this->SupplierWarrantyApproval,
            'DealerRequestApproval' => $this->DealerRequestApproval,
            'DateWarrantySupplierRequest' => $this->DateWarrantySupplierRequest,
            'SignatureDate' => $this->SignatureDate,
            'ApprovalSignature' => $ApprovalSignature,
        ];

        foreach ($array_of_supply_fields as $key => $value) {
            if ($key !== 'SignatureTech' && $key !== 'SignatureCustomer' && $key !== 'ApprovalSignature') {
                if (is_string($value)) {
                    $array_of_supply_fields[$key] = strtoupper($value);
                }
            }
        }

        $supplierWarranty = SupplierWarranty::create($array_of_supply_fields);
        $this->supplier_id = $supplierWarranty->id;

        if (! empty($this->replacements)) {
            foreach ($this->replacements as $parts) {
                $trimmedPart = array_map('trim', $parts);
                $trimmedPart = array_map(function ($value) {
                    return preg_replace('/\s+/', ' ', strtoupper($value));
                }, $trimmedPart);
                $replaceParts = new Replacement;
                $replaceParts->supplier_id = $this->supplier_id;
                $replaceParts->fill($trimmedPart);
                $replaceParts->save();
            }
        }

        if (isset($this->Files)) {
            foreach ($this->Files as $key => $file) {
                $File = new WarrantyFiles;
                $File->Report_id = $this->report_id;

                $fileName = Carbon::now()->timestamp.$key.'.'.$this->Files[$key]->extension();
                $this->Files[$key]->storeAs('storage/uploads/supplier/files', $fileName);

                $File->FileName = $fileName;
                $File->save();
            }
        }

        session()->flash('success', 'Successfully submit approval.');
        $this->reset();

        return $this->redirect(route('admin_ManageWarranty', [
            'lang' => 'en',
        ]), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.supplier.approval-form')
            ->layout('/livewire/layout/app', ['dir' => $this->dir]);
    }
}
