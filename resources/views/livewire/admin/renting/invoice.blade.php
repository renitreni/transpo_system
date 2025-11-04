<section>
    <div class="flex items-center justify-between mb-3">
        <div class="text-black">
            <h1 class="text-2xl font-medium">Invoice/ الفاتورة</h1>
            <small class="font-light"> Records for the current month/سجلات للشهر الحالي</small>
        </div>

    </div>
    <div class="flex flex-col">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 ">
                        <thead class="bg-gray-50 ">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 px-4  text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                    <div class="flex items-center ml-7 gap-x-3">

                                        <button class="flex items-center gap-x-2">
                                            <span>Invoice/الفاتورة</span>
                                        </button>
                                    </div>
                                </th>

                                <th scope="col"
                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                    Date/التاريخ
                                </th>

                                <th scope="col"
                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                    Status/الحالة
                                </th>

                                <th scope="col"
                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                    Client/العميل
                                </th>

                                <th scope="col"
                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                    Purchase/شراء
                                </th>

                                <th scope="col" class="relative py-3.5 px-4">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 ">
                            @forelse ($invoices as $invoice )
                            <tr>
                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                    <div class="inline-flex items-center ml-7 gap-x-3">
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
                                    <div class="flex items-center gap-x-2">

                                        <div>
                                            <h2 class="text-sm font-medium text-gray-800 ">{{ $invoice->rent->contact_person
                                                }}
                                            </h2>
                                            <p class="text-xs font-normal text-gray-600 ">
                                                {{ $invoice->rent->contact_email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    @php
                                    $method = "";
                                    if($invoice->rent->paymentMethod == 12){
                                    $method = "Monthly Payment";
                                    }else if($invoice->rent->paymentMethod == 52){
                                    $method = "Weekly Payment";
                                    }else{
                                    $method = "Daily Payment";
                                    }
                                    @endphp
                                    {{ $method }}
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <a class="text-slate-600 hover:btn-solid-primary" href="{{ route('admin_Renting',['id'=>$invoice->rent->id,'lang'=>'en','page'=>'invoice-show']) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                          </svg>

                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12">
                                    <span class="px-3 text-sm ml-7 text-rose-500">No invoice</span>
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        {{ $invoices->links('vendor.livewire.tailwind') }}
    </div>
</section>
