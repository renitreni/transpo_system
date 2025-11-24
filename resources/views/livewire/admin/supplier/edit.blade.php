<form wire:submit='saveChanges' enctype="multipart/form-data" class="container p-5 mx-auto">
    @include('success.success')
    <div class="flex items-center justify-between gap-2 mb-3">
        <div class="inline-flex items-center gap-2">
            <button type="button"
                onclick="window.location.href='{{ route('admin_EditWarranty', ['lang' => 'en', 'warranty_id' => $report_id]) }}'"
                class="gap-2 text-white bg-blue-400 hover:bg-blue-600 btn btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
                <span>{{ __('Back') }}</span>
            </button>
            <h1 class="text-lg font-medium">{{ __('Approval Form') }}</h1>
        </div>
        <button type="button"
            onclick="window.location.href='{{ route('admin_EditSupplier', ['lang' => 'ar', 'id' => $report_id]) }}'"
            class="gap-2 {{ $lang == 'ar' ? 'hidden' : 'btn' }} hover:bg-blue-600 text-white bg-blue-400 btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m20.893 13.393-1.135-1.135a2.252 2.252 0 0 1-.421-.585l-1.08-2.16a.414.414 0 0 0-.663-.107.827.827 0 0 1-.812.21l-1.273-.363a.89.89 0 0 0-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 0 1-1.81 1.025 1.055 1.055 0 0 1-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 0 1-1.383-2.46l.007-.042a2.25 2.25 0 0 1 .29-.787l.09-.15a2.25 2.25 0 0 1 2.37-1.048l1.178.236a1.125 1.125 0 0 0 1.302-.795l.208-.73a1.125 1.125 0 0 0-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 0 1-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 0 1-1.458-1.137l1.411-2.353a2.25 2.25 0 0 0 .286-.76m11.928 9.869A9 9 0 0 0 8.965 3.525m11.928 9.868A9 9 0 1 1 8.965 3.525" />
            </svg>
            <span>{{ __('Arabic') }}</span>
        </button>

        <button type="button"
            onclick="window.location.href='{{ route('admin_EditSupplier', ['lang' => 'en', 'id' => $report_id]) }}'"
            class="gap-2 {{ $lang == 'ar' ? 'btn' : 'hidden' }} hover:bg-blue-600 text-white bg-blue-400 btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m20.893 13.393-1.135-1.135a2.252 2.252 0 0 1-.421-.585l-1.08-2.16a.414.414 0 0 0-.663-.107.827.827 0 0 1-.812.21l-1.273-.363a.89.89 0 0 0-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 0 1-1.81 1.025 1.055 1.055 0 0 1-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 0 1-1.383-2.46l.007-.042a2.25 2.25 0 0 1 .29-.787l.09-.15a2.25 2.25 0 0 1 2.37-1.048l1.178.236a1.125 1.125 0 0 0 1.302-.795l.208-.73a1.125 1.125 0 0 0-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 0 1-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 0 1-1.458-1.137l1.411-2.353a2.25 2.25 0 0 0 .286-.76m11.928 9.869A9 9 0 0 0 8.965 3.525m11.928 9.868A9 9 0 1 1 8.965 3.525" />
            </svg>
            <span>{{ __('English') }}</span>
        </button>
    </div>

    <div class="flex flex-wrap items-center justify-between gap-4 mt-4 text-xs">
        <span>Annex I Technical Service Information Sheet FAW </span>
        <span>No.: </span>
        <span>Dealer No.: </span>
        <span class="w-[300px]">Compensation Claim No.: </span>
    </div>
    <div class="grid grid-cols-1 gap-2 p-5 border rounded md:grid-cols-4 border-black/10">
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Product Name') }}</label>
            <input disabled wire:model='ProductName'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Order Number') }}</label>
            <input wire:model='OrderNumber' class="p-2 border rounded-md shadow border-black/20" type="text">
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Machine Number') }}</label>
            <input disabled wire:model='MachineNumber'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Working Hours') }}</label>
            <input disabled wire:model='WorkingHours'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
        </div>

        <div class="flex flex-col">
            <label class="text-sm">{{ __('Date of Purchase') }}</label>
            <input wire:model='DateOfPurchased' class="p-2 border rounded-md shadow border-black/20"
                onclick="this.type='date'" onblur="this.type='text'" type="text">
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Feedback Time') }}</label>
            <input wire:model='FeedbackTime' class="p-2 border rounded-md shadow border-black/20" type="time">
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded md:grid-cols-4 border-black/10">
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Delear') }}</label>
            <input disabled wire:model='Dealer'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
        </div>

        <div class="flex flex-col">
            <label class="text-sm">{{ __('Customer Name') }}</label>
            <input disabled wire:model='CustomerName'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
        </div>

        <div class="flex flex-col">
            <label class="text-sm">{{ __('Contact') }}</label>
            <input disabled wire:model='Contact'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded md:grid-cols-6 lg:grid-cols-10 border-black/10">
        <div class="mb-2 col-span-full">
            <span class="font-bold">{{ __('Operating Condition') }}</span>
        </div>
        <div class="inline-flex items-center gap-2">
            <input wire:model='LooseMaterial' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Loose Material') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input wire:model='Dust' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Dust') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input wire:model='CoalField' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Coal Field') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input wire:model='Stones' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Stones') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input wire:model='Gravel' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Gravel') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input wire:model='MetalOre' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Metal Ore') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input wire:model='Plateau' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Plateau') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input wire:model='TGreat' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('T > 42*C') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input wire:model='ZeroCel' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('0*C-42*C') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input wire:model='TLess' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('T < 0*C') }}</label>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded md:grid-cols-2 border-black/10">
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Failure Description') }}</label>
            <textarea wire:model='FailureDescription' class="border rounded focus:ring-0 border-black/10" rows="4"></textarea>
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Cause Analysis') }}</label>
            <textarea wire:model='CausesAnalysis' class="border rounded focus:ring-0 border-black/10" rows="4"></textarea>
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Upload Files') }}</label>
            <input wire:model='Files' multiple class="w-full p-1 border rounded-md shadow border-black/20"
                type="file">
            <small wire:loading wire:target='Files' class="text-yellow-500">Uploading: Please wait...</small>
            <div class="flex flex-col gap-1 mt-3">
                <label class="text-sm">{{ __('Uploaded Files') }}</label>
                @forelse ($allFiles as $file)
                    @if (file_exists(public_path('storage/uploads/supplier/files/' . $file->FileName)))
                        <div>
                            <button type="button" wire:click='deleteFile({{ $file->id }})'
                                class="badge badge-error">Delete</button>
                            <a class="text-sm text-blue-500" download
                                href="{{ asset('storage/uploads/supplier/files/' . $file->FileName) }}">{{ $file->FileName }}
                            </a>
                        </div>
                    @endif
                @empty
                    <span class="text-rose-500">No Files Uploaded</span>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded md:grid-cols-2 border-black/10">
        <div>
            <label class="text-base font-bold">{{ __('Handling Result') }}</label>
            <div class="flex flex-wrap gap-2 mt-2">
                <div class="w-full">
                    <div class="{{ $techSig ? 'hidden' : 'flex flex-col w-full' }} ">
                        <label class="text-sm">{{ __('Upload Signature of Service Technician') }}</label>
                        <input wire:model='SignatureTech' class="w-full p-1 border rounded-md shadow border-black/20"
                            type="file">
                        <small wire:loading wire:target='SignatureTech' class="text-yellow-500">Uploading: Please
                            wait...
                        </small>
                    </div>
                    <div class="{{ $techSig ? 'flex flex-col w-full' : 'hidden' }} ">
                        <label class="text-sm">{{ __('Uploaded Signature of Service Technician') }}</label>
                        @if (file_exists(public_path('storage/uploads/supplier/' . $techSig)))
                            <div>
                                <button wire:click='deleteSignatures("SignatureTech","{{ $techSig }}")'
                                    type="button" class="badge badge-error">Delete</button>
                                <a class="text-sm text-blue-500 max-w-[250px]" download
                                    href="{{ asset('storage/uploads/supplier/' . $techSig) }}">{{ $techSig }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col">
                    <label class="text-sm">{{ __('Date') }}</label>
                    <input wire:model='DateSignatureTech' class="p-1.5 border rounded-md shadow border-black/20"
                        onclick="this.type='date'" onblur="this.type='text'" type="text">
                </div>
            </div>
        </div>
        <div>
            <label class="text-base font-bold">{{ __('Customer') }}</label>
            <div class="flex flex-wrap gap-2 mt-2">
                <div class="w-full">
                    <div class="{{ $custSig ? 'hidden' : 'flex flex-col' }} ">
                        <label class="text-sm">{{ __('Upload Signature of Customer') }}</label>
                        <input wire:model='SignatureCustomer'
                            class="w-full p-1 border rounded-md shadow border-black/20" type="file">
                        <small wire:loading wire:target='SignatureCustomer' class="text-yellow-500">Uploading: Please
                            wait...
                        </small>
                    </div>
                    <div class="{{ $custSig ? 'flex flex-col w-full' : 'hidden' }} ">
                        <label class="text-sm">{{ __('Uploaded Signature of Customer') }}</label>
                        @if (file_exists(public_path('storage/uploads/supplier/' . $custSig)))
                            <div>
                                <button wire:click='deleteSignatures("SignatureCustomer","{{ $custSig }}")'
                                    type="button" class="badge badge-error">Delete</button>
                                <a class="text-sm text-blue-500 max-w-[250px]" download
                                    href="{{ asset('storage/uploads/supplier/' . $custSig) }}">{{ $custSig }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col">
                    <label class="text-sm">{{ __('Date') }}</label>
                    <input wire:model='DateSignatureCustomer' class="p-1.5 border rounded-md shadow border-black/20"
                        onclick="this.type='date'" onblur="this.type='text'" type="text">

                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded md:grid-cols-2 border-black/10">
        <div class="flex flex-wrap items-center justify-between col-span-full">
            <span class="w-full font-bold">{{ __('Part Replacement Record') }}</span>
            <div class="flex items-center gap-3 mt-4">
                <label class="text-sm ">{{ __('Approved By') }}</label>
                <input wire:model='ApprovedBy' required class="p-1 w-[230px] border rounded-md shadow border-black/20"
                    type="text">
                <label class="text-sm">{{ __('Date') }}</label>
                <input wire:model='DateApproved' class="p-1 w-[230px] border rounded-md shadow border-black/20"
                    onclick="this.type='date'" onblur="this.type='text'" type="text">
            </div>

            {{-- <div>
                <button type="button" wire:click='addRows'
                    class="gap-1 text-white bg-blue-400 shadow-md btn btn-sm hover:bg-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                    <span>{{ __('Add Row') }}</span>
                </button>
                <button type="button" wire:click='removeRows'
                    class="gap-1 text-white shadow-md btn btn-sm bg-rose-400 hover:bg-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                    </svg>

                    <span>{{ __('Remove Row') }}</span>
                </button>
            </div> --}}
        </div>
        <div class="flex w-full mt-3 overflow-x-auto col-span-full">
            <table class="table max-w-4xl table-compact">
                <thead>
                    <tr>
                        <th>{{ __('Failure Part Code and Number') }}</th>
                        <th>{{ __('Replcement Part Code and Number') }}</th>
                        <th>{{ __('Name and Model') }}</th>
                        <th>{{ __('Quantity') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($replacements as $index => $row)
                        <tr>
                            <th>
                                <input wire:model='replacements.{{ $index }}.FPCN'
                                    class="p-1.5 border rounded-md shadow border-black/20" type="text">
                            </th>
                            <td>
                                <input wire:model='replacements.{{ $index }}.RPCN'
                                    class="p-1.5 border rounded-md shadow border-black/20" type="text">
                            </td>
                            <td>
                                <input wire:model='replacements.{{ $index }}.NameModel'
                                    class="p-1.5 border rounded-md shadow border-black/20" type="text">
                            </td>
                            <td>
                                <input wire:model='replacements.{{ $index }}.Quantity'
                                    class="p-1.5 w-[120px] border rounded-md shadow border-black/20" type="text">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No rows</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded md:grid-cols-3 border-black/10">
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Supplier Warranty Approval') }}</label>
            <input wire:model='SupplierWarrantyApproval' class="p-2 border rounded-md shadow border-black/20"
                type="text">
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Dealer Request Approval') }}</label>
            <input wire:model='DealerRequestApproval' class="p-2 border rounded-md shadow border-black/20"
                type="text">
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Date') }}</label>
            <input wire:model='DateWarrantySupplierRequest' class="p-2 border rounded-md shadow border-black/20"
                onclick="this.type='date'" onblur="this.type='text'" type="text">
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded md:grid-cols-2 border-black/10">
        <div class=" {{ $approvalSig ? 'hidden' : 'flex flex-col' }} ">
            <label class="text-sm">{{ __('Upload Signature') }}</label>
            <input wire:model='ApprovalSignature' class="w-full p-1 border rounded-md shadow border-black/20"
                type="file">
            <small wire:loading wire:target='ApprovalSignature' class="text-yellow-500">Uploading: Please
                wait...</small>
        </div>
        <div class="{{ $approvalSig ? 'flex flex-col' : 'hidden' }} ">
            <label class="text-sm">{{ __('Uploaded Signature') }}</label>
            @if (file_exists(public_path('storage/uploads/supplier/' . $approvalSig)))
                <div>
                    <button wire:click='deleteSignatures("ApprovalSignature","{{ $approvalSig }}")' type="button"
                        class="badge badge-error">Delete</button>
                    <a class="text-sm text-blue-500 max-w-[250px]" download
                        href="{{ asset('storage/uploads/supplier/' . $approvalSig) }}">{{ $approvalSig }}
                    </a>
                </div>
            @endif
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Date') }}</label>
            <input wire:model='SignatureDate' class="p-2 border rounded-md shadow border-black/20"
                onclick="this.type='date'" onblur="this.type='text'" type="text">
        </div>
    </div>

    <div class="flex justify-end p-2 mt-4 mb-10">
        <button wire:target='saveChanges' wire:loading.attr='disabled' type="submit"
            class="gap-1 text-white bg-blue-400 shadow disabled:bg-slate-300 hover:bg-blue-600 btn">
            <span>{{ __('Save Changes') }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
            </svg>
        </button>
    </div>
</form>
