<div class="container p-5 mx-auto">
    <div class="inline-flex items-center gap-2 mb-2">
        <button wire:click='back' class="gap-1 text-white bg-blue-500 btn btn-sm hover:bg-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
            <span>{{ __('Back') }}</span>
        </button>
        <span class="text-lg font-bold">View Details</span>
    </div>
    @include('success.success')
    <div class="grid grid-cols-1 gap-2 p-5 border rounded md:grid-cols-4 border-black/10">
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Product Name') }}</label>
            <input disabled wire:model='ProductName'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Order Number') }}</label>
            <input disabled wire:model='OrderNumber'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
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
            <input disabled wire:model='DateOfPurchased'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Feedback Time') }}</label>
            <input disabled wire:model='FeedbackTime'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="time">
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded md:grid-cols-4 border-black/10">
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Dealer') }}</label>
            <input disabled wire:model='Dealer'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
        </div>

        <div class="flex flex-col">
            <label class="text-sm">{{ __('Customer Name') }}</label>
            <input disabled disabled wire:model='CustomerName'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
        </div>

        <div class="flex flex-col">
            <label class="text-sm">{{ __('Contact') }}</label>
            <input disabled disabled wire:model='Contact'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded md:grid-cols-6 lg:grid-cols-10 border-black/10">
        <div class="mb-2 col-span-full">
            <span class="font-bold">{{ __('Operating Condition') }}</span>
        </div>
        <div class="inline-flex items-center gap-2">
            <input disabled wire:model='LooseMaterial' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Loose Material') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input disabled wire:model='Dust' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Dust') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input disabled wire:model='CoalField' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Coal Field') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input disabled wire:model='Stones' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Stones') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input disabled wire:model='Gravel' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Gravel') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input disabled wire:model='MetalOre' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Metal Ore') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input disabled wire:model='Plateau' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('Plateau') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input disabled wire:model='TGreat' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('T > 42*C') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input disabled wire:model='ZeroCel' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('0*C-42*C') }}</label>
        </div>

        <div class="inline-flex items-center gap-2">
            <input disabled wire:model='TLess' class="rounded-full" type="checkbox">
            <label class="text-sm">{{ __('T < 0*C') }}</label>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded md:grid-cols-2 border-black/10">
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Failure Description') }}</label>
            <textarea disabled wire:model='FailureDescription' class="border rounded focus:ring-0 border-black/10"
                rows="4"></textarea>
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Cause Analysis') }}</label>
            <textarea disabled wire:model='CausesAnalysis' class="border rounded focus:ring-0 border-black/10" rows="4"></textarea>
        </div>
        <div class="flex flex-col max-w-[240px]">
            <label class="mb-3 text-sm font-medium">{{ __('Uploaded Files') }}</label>
            @forelse ($Files ?? [] as $file)
                @if (file_exists(public_path('storage/uploads/supplier/files/' . $file->FileName)))
                    <a class="text-sm text-blue-500" download
                        href="{{ asset('storage/uploads/supplier/files/' . $file->FileName) }}">{{ $file->FileName }}</a>
                @endif
                @if (file_exists(public_path('storage/uploads/files/' . $file->FileName)))
                    <a class="text-sm text-blue-500" download
                        href="{{ asset('storage/uploads/files/' . $file->FileName) }}">{{ $file->FileName }}</a>
                @endif
            @empty
                <span class="text-rose-500">No Files Uploaded</span>
            @endforelse
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded md:grid-cols-2 border-black/10">
        <div>
            <label class="text-base font-bold">{{ __('Handling Result') }}</label>
            <div class="flex flex-wrap gap-2 mt-2">
                <div class="flex flex-col w-full">
                    <label class="text-sm">{{ __('Uploaded Signature of Service Technician') }}</label>
                    @if (file_exists(public_path('storage/uploads/supplier/' . $SignatureTech)))
                        <a class="text-sm text-blue-500 max-w-[250px]" download
                            href="{{ asset('storage/uploads/supplier/' . $SignatureTech) }}">{{ $SignatureTech }}</a>
                    @endif
                    @if (!$SignatureTech)
                        <div class="mt-4">
                            <small class=" badge badge-warning">No uploaded signature</small>
                        </div>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label class="text-sm">{{ __('Date') }}</label>
                    <input disabled wire:model='DateSignatureTech'
                        class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
                </div>
            </div>
        </div>
        <div>
            <label class="text-base font-bold">{{ __('Customer') }}</label>
            <div class="flex flex-wrap gap-2 mt-2">

                <div class="flex flex-col w-full">
                    <label class="text-sm">{{ __('Uploaded Signature of Customer') }}</label>
                    @if (file_exists(public_path('storage/uploads/supplier/' . $SignatureCustomer)))
                        <a class="text-sm text-blue-500 max-w-[250px]" download
                            href="{{ asset('storage/uploads/supplier/' . $SignatureCustomer) }}">{{ $SignatureCustomer }}</a>
                    @endif
                    @if (!$SignatureCustomer)
                        <div class="mt-4">
                            <small class=" badge badge-warning">No uploaded signature</small>
                        </div>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label class="text-sm">{{ __('Date') }}</label>
                    <input disabled wire:model='DateSignatureCustomer'
                        class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">

                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded md:grid-cols-2 border-black/10">
        <div class="flex flex-wrap items-center justify-between col-span-full">
            <span class="w-full font-bold">{{ __('Part Replacement Record') }}</span>
            <div class="flex flex-wrap items-center gap-3 mt-4">
                <label class="text-sm ">{{ __('Approved By') }}</label>
                <input disabled wire:model='ApprovedBy' required
                    class="p-1 w-[230px] disabled:bg-slate-200 border rounded-md shadow border-black/20"
                    type="text">
                <label class="text-sm">{{ __('Date') }}</label>
                <input disabled wire:model='DateApproved'
                    class="p-1 disabled:bg-slate-200 w-[230px] border rounded-md shadow border-black/20"
                    type='text'>
            </div>

        </div>
        <div class="flex w-full mt-3 overflow-x-auto col-span-full">
            <table class="table w-full table-compact">
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
                                <input disabled wire:model='replacements.{{ $index }}.FPCN'
                                    class="p-1.5 border rounded-md shadow border-black/20" type="text">
                            </th>
                            <td>
                                <input disabled wire:model='replacements.{{ $index }}.RPCN'
                                    class="p-1.5 border rounded-md shadow border-black/20" type="text">
                            </td>
                            <td>
                                <input disabled wire:model='replacements.{{ $index }}.NameModel'
                                    class="p-1.5 border rounded-md shadow border-black/20" type="text">
                            </td>
                            <td>
                                <input disabled wire:model='replacements.{{ $index }}.Quantity'
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
            <input disabled wire:model='SupplierWarrantyApproval'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Dealer Request Approval') }}</label>

            <input disabled wire:model='DealerRequestApproval'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Date') }}</label>
            <input disabled wire:model='DateWarrantySupplierRequest'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type='text'>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded border-black/10">
        <div>
            <h2 class="text-sm">{{ __('Uploaded Images and Videos') }}</h2>
        </div>
        <div class="flex flex-wrap gap-3 ">
            @forelse ($Files ?? [] as $file )
                @php
                    $extension = explode('.', $file->FileName);
                @endphp
                @if (file_exists(public_path('storage/uploads/images/' . $file->FileName)))
                    @if ($extension[1] != 'mp4')
                        <a class="text-sm text-blue-500" download
                            href="{{ asset('storage/uploads/images/' . $file->FileName) }}">
                            <img class="size-[250px] md:size-[150px]"
                                src="{{ asset('storage/uploads/images/' . $file->FileName) }}"
                                alt="{{ $file->FileName }}">
                        </a>
                    @else
                        <a class="text-sm text-blue-500" download
                            href="{{ asset('storage/uploads/images/' . $file->FileName) }}">
                            <video class="size-[250px]  md:size-[150px]" controls
                                src="{{ asset('storage/uploads/images/' . $file->FileName) }}"></video>
                        </a>
                    @endif
                @endif
            @empty
                <span class="text-rose-500">No Files Uploaded</span>
            @endforelse
        </div>
    </div>

    <div class="grid grid-cols-1 gap-2 p-5 mt-5 border rounded md:grid-cols-2 border-black/10">
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Uploaded Signature') }}</label>
            @if (file_exists(public_path('storage/uploads/supplier/' . $ApprovalSignature)))
                <a class="text-sm text-blue-500 max-w-[250px]" download
                    href="{{ asset('storage/uploads/supplier/' . $ApprovalSignature) }}">{{ $ApprovalSignature }}</a>
            @endif
            @if (!$ApprovalSignature)
                <div class="mt-4">
                    <small class=" badge badge-warning">No uploaded signature</small>
                </div>
            @endif
        </div>
        <div class="flex flex-col">
            <label class="text-sm">{{ __('Date') }}</label>
            <input disabled wire:model='SignatureDate'
                class="p-2 border rounded-md shadow disabled:bg-slate-200 border-black/20" type='text'>
        </div>
    </div>

    <form wire:submit='save' class="grid grid-cols-1 gap-2 p-5 my-5 border rounded border-black/10"
        x-data="{ isOpen: '{{ $decision }}' == 'Approved' ? true : false }">
        <div class="col-span-full">
            <h1 class="text-xl font-bold">{{ __('Decision') }}</h1>
        </div>
        <div class="flex flex-col gap-4">
            <div class="gap-1 tabs">
                <input type="radio" id="tab-10" value="Approved" wire:model='decision' class="tab-toggle"
                    x-on:click='isOpen = true' />
                <label for="tab-10" class="tab tab-pill">{{ __('Approve') }}</label>
                <input type="radio" id="tab-11" value="Rejected" wire:model='decision' class="tab-toggle"
                    x-on:click='isOpen = false' />
                <label for="tab-11" class="tab tab-pill">{{ __('Reject') }}</label>
            </div>
            <div x-show="isOpen" class="flex gap-2 w-2/4">
                <div class="flex flex-col w-full">
                    <label class="text-sm">{{ __('Return Date') }}</label>
                    <input wire:model='returnDate' class="p-2 border rounded-md shadow border-black/20"
                        type='date'>
                    @error('returnDate')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col w-full">
                    <label class="text-sm">{{ __('Courier') }}</label>
                    <input wire:model='courier' class="p-2 border rounded-md shadow border-black/20"
                        type='text'>
                    @error('courier')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
            <div class="flex flex-col">
                <label class="text-sm">{{ __('Signed By') }}</label>
                <input wire:model='signedBy' class="p-2 border rounded-md shadow border-black/20" type='text'>
            </div>

            @if ($isSigned)
                <div class="{{ $isSigned ? 'flex flex-col w-full' : 'hidden' }} ">
                    <label class="text-sm">{{ __('Uploaded Signature of Service Technician') }}</label>
                    @if (file_exists(public_path('storage/uploads/supplier/' . $isSigned)))
                        <div>
                            <button wire:click='deleteFile("SignedSignature","{{ $isSigned }}")' type="button"
                                class="badge badge-error">Delete</button>
                            <a class="text-sm text-blue-500 max-w-[250px]" download
                                href="{{ asset('storage/uploads/supplier/' . $isSigned) }}">{{ $isSigned }}
                            </a>
                        </div>
                    @endif
                </div>
            @else
                <div class="flex flex-col">
                    <label class="text-sm">{{ __('Signature of Person who signed') }}</label>
                    <input wire:model='signedSignature' class="w-full p-1 border rounded-md shadow border-black/20"
                        type="file">
                    <small wire:loading wire:target='signedSignature' class="text-yellow-500">Uploading: Please
                        wait...</small>
                </div>
            @endif

        </div>

        <div>
            <label class="text-sm">{{ __('Reason') }}</label>
            <textarea wire:model='reason' class="w-full border rounded focus:ring-0 border-black/10" rows="4"></textarea>
        </div>
        <div class="flex justify-end">
            <button wire:target='save' wire:loading.attr='disabled' type="submit"
                class="gap-1 text-white bg-blue-400 shadow disabled:bg-slate-300 hover:bg-blue-600 btn">
                <span>{{ __('Submit Decision') }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                </svg>
            </button>
        </div>
    </form>
</div>
