<div class="p-6">
    <div class="flex items-center justify-between mb-3">
        <div>
            <h1 class="font-medium">Purchased No. : {{ $view->purchase_number }}</h1>
            <h1 class="text-sm font-medium">Track No. : {{ $view->track_number }}</h1>
            <small class="text-slate-500">Entry Date: {{ $view->entry_date }}</small>
            <div class="flex items-center gap-x-1">
                @if ($view->isSalesApproved)
                <small class="text-green-600 badge badge-outline">Approved by sales.</small>
                @else
                <small class="text-yellow-600 badge badge-outline">Not approved by sales.</small>
                @endif

                @if (!$view->isFleetApproved)
                <small class="text-yellow-600 badge badge-outline">Not approved by fleet.</small>
                @else
                <small class="text-green-600 badge badge-outline">Approved by fleet.</small>
                @endif
                @if (!$view->isWorkshopApproved)
                <small class="text-yellow-600 badge badge-outline">Not approved by workshop.</small>
                @else
                <small class="text-green-600 badge badge-outline">Approved by workshop.</small>
                @endif
                @if (!$view->isAccountantApproved)
                <small class="text-yellow-600 badge badge-outline">Not approved by accountant.</small>
                @else
                <small class="text-green-600 badge badge-outline">Approved by accountant.</small>
                @endif
            </div>
        </div>
        <div class="flex gap-x-1">
            @if (auth()->user()->role === "Accountant")
            <button wire:click='exportPDF({{ $view }})' class="btn btn-sm btn-solid-primary">Download</button>
            @endif
            @if ($view->isSalesApproved)
                @if (auth()->user()->role === "Accountant")
                <a href="{{ route('admin_Renting',['id'=>$view->id,'lang'=>'en','page'=> 'invoice-show']) }}"
                    class="btn btn-sm btn-solid-primary">View Payments
                </a>
                @endif
            @endif
        </div>
    </div>

    <div class="grid gap-2 grid-co1 sm:grid-cols-2 md:grid-cols-3 max-h-[500px] overflow-scroll">
        <div class="flow-root py-3 border border-gray-100 rounded-lg shadow-sm">
            <dl class="-my-3 text-sm divide-y divide-gray-100">
                <div class="p-3">
                    <dt class="text-lg font-bold text-gray-900">Client</dt>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Company</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->company_name }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Company C.R.</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->company_cr }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Contact Person</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->contact_person }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Mobile Number</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->mobile_number }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Email Address</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->contact_email }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">National Address</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->national_address }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Note</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->note }}</dd>
                </div>
            </dl>
        </div>

        <div class="flow-root py-3 border border-gray-100 rounded-lg shadow-sm">
            <dl class="-my-3 text-sm divide-y divide-gray-100">
                <div class="p-3">
                    <dt class="w-full text-lg font-bold text-gray-900">Service Renting</dt>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Method</dt>
                    @php
                    if($view->paymentMethod === 12){
                    $method = "Monthly";
                    }elseif($view->paymentMethod === 56){
                    $method = "Weekly";
                    }else{
                    $method = "Daily";
                    }
                    @endphp
                    <dd class="text-gray-700 sm:col-span-2">{{ $method }}</dd>
                </div>

                @if (auth()->user()->role != "Fleet")
                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Amount</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->service_amount }} SAR</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Advance Payment</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->advance_payment }} SAR</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Total Amount (yearly)</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->total_service_amount }} SAR</dd>
                </div>
                @endif

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Transportation Details</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->transportation_details }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">TUV Certificate</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->tuv_certificate }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">SASO Certificate</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->saso_certificate ? "Has one": "None" }}
                    </dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Other Certificate</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->other_certificate ? "Has one": "None" }}
                    </dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">With Driver</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->driver ? "Yes": "None" }}</dd>
                </div>
                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Number of Units</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->number_units}} Units</dd>
                </div>
            </dl>
        </div>

        <div class="flow-root py-3 border border-gray-100 rounded-lg shadow-sm">
            <dl class="-my-3 text-sm divide-y divide-gray-100">
                <div class="p-3">
                    <dt class="text-lg font-bold text-gray-900">Receiver</dt>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Name</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->receiver_name }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Mobile Number</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->receiver_mobile_number }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">National ID No.</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->receiver_national_id }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Location</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->receiver_location }}</dd>
                </div>
            </dl>
        </div>

        <div class="flow-root py-3 border border-gray-100 rounded-lg shadow-sm">
            <dl class="-my-3 text-sm divide-y divide-gray-100">
                <div class="p-3">
                    <dt class="text-lg font-bold text-gray-900">Sales Person</dt>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Employee</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->emp_name }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Employee No.</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->emp_number }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Branch</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->branch }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="text-lg font-bold text-gray-900">Uploaded Files</dt>
                    <dd class="text-gray-700 sm:col-span-2">
                        @forelse ( $view->files as $file )
                        <a target="_blank" class="text-sm text-blue-500"
                            href="{{ route('show-file',['file'=>$file->filename]) }}">{{ $file->filename
                            }}</a><br>
                        @empty
                        <p class="badge badge-primary"> No files uploaded</p>
                        @endforelse
                    </dd>
                </div>
            </dl>
        </div>

        @if ($view->personSales != null)
        <div class="flow-root py-3 mt-3 border border-gray-100 rounded-lg shadow-sm">
            <dl class="-my-3 text-sm divide-y divide-gray-100">
                <div class="p-3">
                    <dt class="text-lg font-bold text-gray-900">Sales Approval</dt>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Decision</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->isSalesApproved ? "Approved" : "Rejected" }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Checked By</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->personSales }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Remark</dt>
                    <dd class="text-gray-700 break-words sm:col-span-2">{{ $view->salesRemark }}</dd>
                </div>
            </dl>
        </div>
        @endif

        @if ($view->personFleet != null)
        <div class="flow-root py-3 mt-3 border border-gray-100 rounded-lg shadow-sm">
            <dl class="-my-3 text-sm divide-y divide-gray-100">
                <div class="p-3">
                    <dt class="text-lg font-bold text-gray-900">Fleet Approval</dt>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Decision</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->isFleetApproved ? "Approved" : "Rejected" }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Checked By</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->personFleet }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Remark</dt>
                    <dd class="text-gray-700 break-words sm:col-span-2">{{ $view->fleetRemark }}</dd>
                </div>
            </dl>
        </div>
        @endif

        @if ($view->personWorkshop != null)
        <div class="flow-root py-3 mt-3 border border-gray-100 rounded-lg shadow-sm">
            <dl class="-my-3 text-sm divide-y divide-gray-100">
                <div class="p-3">
                    <dt class="text-lg font-bold text-gray-900">Workshop Approval</dt>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Decision</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->isWorkshopApproved ? "Approved" : "Rejected" }}
                    </dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Checked By</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->personWorkshop }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Remark</dt>
                    <dd class="text-gray-700 break-words sm:col-span-2">{{ $view->workshopRemark }}</dd>
                </div>
            </dl>
        </div>
        @endif

        @if ($view->personAccountant != null)
        <div class="flow-root py-3 mt-3 border border-gray-100 rounded-lg shadow-sm">
            <dl class="-my-3 text-sm divide-y divide-gray-100">
                <div class="p-3">
                    <dt class="text-lg font-bold text-gray-900">Accountant Approval</dt>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Decision</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->isAccountantApproved ? "Approved" : "Rejected" }}
                    </dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Checked By</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $view->personAccountant }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Remark</dt>
                    <dd class="text-gray-700 break-words sm:col-span-2">{{ $view->accountantRemark }}</dd>
                </div>
            </dl>
        </div>
        @endif

        @isset($view->approvalFleet)
        <div class="mt-4 col-span-full">
            <h1 class="text-lg font-bold">Requested Units</h1>
        </div>
        <div class="overflow-x-auto border border-gray-200 rounded-lg col-span-full">

            <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="text-left">
                    <tr>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Brand</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Model</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Height</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">VIN #</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Plate #</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Insurance</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Operator Name</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Location</th>
                    </tr>
                </thead>

                <tbody class="text-xs divide-y divide-gray-200">
                    @isset($view->approvalFleet)
                    @forelse ($view->approvalFleet as $detail )
                    <tr>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $detail->truck_brand }}
                        </td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $detail->truck_model }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $detail->truck_size }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $detail->truck_vin }}</td>
                        <td class="px-4 py-2 text-gray-900 whitespace-nowrap">{{ $detail->plate_number }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $detail->insurance }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $detail->operator_name }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $detail->current_location }}</td>
                    </tr>

                    @empty
                    <tr>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">No requested units</td>

                    </tr>
                    @endforelse
                    @endisset
                </tbody>
            </table>
        </div>
        @endisset
    </div>
</div>
