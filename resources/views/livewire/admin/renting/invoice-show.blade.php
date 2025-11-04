<div>
    @isset($data)
    <div class="flex items-center justify-between">
        <div class="text-black">
            <h1 class="text-base">Purchased #: {{ $data->purchase_number }}</h1>
            <small class="text-slate-600">Entry Date: {{ $data->entry_date }}</small>
        </div>
        <div class="flex gap-x-1 items-center">
            <button x-data x-on:click="$dispatch('open-modal','create-new-payment')" type="button"
            class="btn gap-x-1 btn-sm btn-solid-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
            </svg>
            <span>New Payment</span>
        </button>
        <a class="btn gap-x-1 btn-sm btn-solid-primary" href="{{ route('admin_Renting',['lang'=>'en','page'=>'invoice']) }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
              </svg>
            <span>Back</span>
        </a>
        </div>
    </div>
    <div class="grid grid-cols-1 my-3 gap-x-4 sm:grid-cols-2 md:grid-cols-2">
        <div class="flow-root py-3 border border-gray-100 rounded-lg shadow-sm">
            <dl class="-my-3 text-sm divide-y divide-gray-100">
                <div class="p-3">
                    <dt class="text-lg font-medium text-gray-900">Client/العميل</dt>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Company</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $data->company_name }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Contact Person</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $data->contact_person }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Mobile Number</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $data->mobile_number }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Email</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $data->contact_email }}</dd>
                </div>
            </dl>
        </div>

        <div class="flow-root py-3 border border-gray-100 rounded-lg shadow-sm">
            <dl class="-my-3 text-sm divide-y divide-gray-100">
                <div class="p-3">
                    <dt class="text-lg font-medium text-gray-900 ">Services Renting/خدمات الإيجار</dt>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Payment</dt>
                    <dd class="text-gray-700 sm:col-span-2">
                        @php
                        $payment = "";
                        if($data->paymentMethod == 12){
                        $payment = "Monthly (12 months)";
                        }else if($data->paymentMethod == 52){
                        $payment = "Weekly (52 weeks)";
                        }else{
                        $payment = "Daily (365 days)";
                        }
                        @endphp
                        {{ $payment }}
                    </dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Amount</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $data->service_amount }} SAR </sub></dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Total Amount</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $data->total_service_amount }} SAR <sub>per year</sub>
                    </dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Advance</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $data->advance_payment }} SAR</dd>
                </div>
            </dl>
        </div>
    </div>
    <section>
        <div class="py-2">
            <h2 class="text-lg font-medium">Payments</h2>
            <small>Total amount paid: {{ $totalAmountPaid }} SAR </small>
        </div>
        <div class="flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 ">
                            <thead class="bg-gray-50 ">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        <div class="flex items-center gap-x-3">
                                            <button class="flex items-center gap-x-2">
                                                <span>Invoice</span>
                                            </button>
                                        </div>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Paid Date
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Status
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Amount (SAR)
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Advance (SAR)
                                    </th>

                                    <th scope="col"
                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">

                                </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 ">
                                @forelse ( $data->invoices as $invoice )
                                <tr>
                                    <td
                                        class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex items-center gap-x-3">

                                            <span>{{ $invoice->invoice_number }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">{{ date('F d,Y',strtotime($invoice->paid_date)) }}</td>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        @if ($invoice->status)
                                        <div
                                            class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-emerald-500 bg-emerald-100/60 ">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>

                                            <h2 class="text-sm font-normal">Paid</h2>

                                        </div>
                                        @else
                                        <div
                                            class="inline-flex items-center px-3 py-1 text-red-500 rounded-full gap-x-2 bg-red-100/60 ">

                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 3L3 9M3 3L9 9" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>

                                            <h2 class="text-sm font-normal">Not Yet</h2>
                                            <div></div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $invoice->amount_paid }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $invoice->advance_payment > 0 ? $invoice->advance_payment : "None" }}
                                    </td>
                                    <td>
                                        <button wire:confirm="Are you sure to delete invoice number of {{ $invoice->invoice_number }}" wire:click='delete({{ $invoice }})' class="hover:text-rose-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                              </svg>

                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12">
                                        <span class="px-4 text-sm ml-7 text-rose-600">No payments</span>
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endisset

    <x-modal maxWidth="lg" name="create-new-payment" :show="false">
        <form wire:submit='addPayment' class="p-6">
            @include('success.success')
            <div class="flow-root py-3 border border-gray-100 rounded-lg shadow-sm">
                <dl class="-my-3 text-sm divide-y divide-gray-100">
                    <div class="w-full p-3">
                        <dt class="text-lg font-medium text-gray-900">Add Payment/إضافة دفعة</dt>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Date</dt>
                        <dd class="text-gray-700 sm:col-span-2"><input wire:model='paid_date' type="date"
                                class="w-full p-1 border rounded border-black/10"></dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Amount (SAR)</dt>
                        <dd class="text-gray-700 sm:col-span-2"><input wire:model='amount_paid' type="number"
                                class="w-full p-1 border rounded border-black/10"></dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Advance (SAR)</dt>
                        <dd class="text-gray-700 sm:col-span-2"><input wire:model='advance_payment' type="number"
                                class="w-full p-1 border rounded border-black/10"></dd>
                    </div>

                    {{-- <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Status</dt>
                        <dd class="space-y-2 text-gray-700 sm:col-span-2">
                            <label class="flex gap-2 cursor-pointer">
                                <input wire:model='status' value="1" name="status" type="radio" class="radio " />
                                <span>Paid</span>
                            </label>
                            <label class="flex gap-2 cursor-pointer">
                                <input wire:model='status' value="0" name="status" type="radio"
                                    class="radio radio-error" />
                                <span>Not yet</span>
                            </label>
                        </dd>
                    </div> --}}
                </dl>
            </div>

            <div class="flex justify-end mt-3 gap-x-2">
                <button wire:click='clear' type="button" class="btn btn-sm btn-solid-error">Clear</button>
                <button type="submit" class="btn btn-sm btn-solid-primary">Add Payment</button>
            </div>
        </form>
    </x-modal>
</div>
