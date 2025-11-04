<?php

namespace App\Livewire\Admin\Renting;

use App\Models\Rent;
use App\Models\RentInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class InvoiceShow extends Component
{
    public $data;

    public $paid_date;

    public float $amount_paid;

    public float $advance_payment;

    public bool $status = true;

    public float $totalAmountPaid = 0;

    public function mount(?int $id = null)
    {
        $id && $this->data = Rent::where('id', $id)->with('invoices')->first();
        $this->paid_date = Carbon::now()->toDateString();
        $this->displayAmountPaid();
    }

    public function clear(): void
    {
        $this->reset('amount_paid', 'advance_payment', 'status');
    }

    public function addPayment(): void
    {
        $type = '';
        if ($this->data->paymentMethod == 12) {
            $type = 'Monthly';
        } elseif ($this->data->paymentMethod == 52) {
            $type = 'Weekly';
        } else {
            $type = 'Daily';
        }

        try {
            RentInvoice::create([
                'rent_id' => $this->data->id,
                'paid_date' => $this->paid_date,
                'amount_paid' => $this->amount_paid ?? 0,
                'advance_payment' => $this->advance_payment ?? 0,
                'status' => $this->status ?? false,
            ]);
            $this->updateNextPayment($type, $this->paid_date);
            $this->displayAmountPaid();
            session()->flash('success', 'New payment added.');
            $this->clear();
        } catch (\Exception $exception) {
            Log::error('@addPayment', ['reason' => $exception->getMessage()]);
            session()->flash('failed', 'Something went wrong.');
        }
    }

    public function delete(RentInvoice $invoice)
    {
        try {
            $invoice->delete();
            session()->flash('success', 'Delete successfully.');
        } catch (\Exception $exception) {
            Log::error('@deleteInvoice', ['reason' => $exception->getMessage()]);
            session()->flash('failed', 'Something went wrong.');
        }
    }

    public function render()
    {
        return view('livewire.admin.renting.invoice-show');
    }

    private function updateNextPayment(string $type, string $date)
    {
        $nextPayment = '';
        if ($type == 'Monthly') {
            $nextPayment = Carbon::createFromFormat('Y-m-d', $date)->addMonth();
        }
        if ($type == 'Weekly') {
            $nextPayment = Carbon::createFromFormat('Y-m-d', $date)->addWeek();
        }

        Rent::find($this->data->id)->update(
            [
                'next_payment' => $nextPayment,
            ]
        );
    }

    private function displayAmountPaid()
    {
        $this->totalAmountPaid = 0;
        if (isset($this->data->invoices)) {
            foreach ($this->data->invoices as $invoice) {
                $this->totalAmountPaid = $this->totalAmountPaid + ($invoice->amount_paid + $invoice->advance_payment);
            }
        }
    }
}
