<input class="modal-state" id="invoice-modal" type="checkbox" />
<div class="w-screen modal">
    {{-- <label class="modal-overlay" for="invoice-modal"></label> --}}
    <div class="flex flex-col w-full max-w-5xl gap-5 modal-content">
        <div class="flex items-center justify-between gap-2">
            <h2 class="text-xl">Create Invoice</h2>
            <button  @if($customerID !== null) disabled @endif wire:click='add' type="button" class="absolute w-32 space-x-1 text-blue-500 btn-ghost btn-sm btn right-14 top-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                  </svg>
                <span class="text-sm">Add Row</span>
            </button>
            <label x-on:click='$wire.cancel' for="invoice-modal"
                class="absolute btn-sm btn-ghost btn right-4 top-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 text-rose-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </label>
        </div>
        @include('success.success')
        <form wire:submit.prevent='create'>
            <input
                @if($customerID !== null) disabled @endif
                required
                wire:model='Customer_Name'
                placeholder="Customer Name"
                type="text"
                class="max-w-[400px] mb-3 w-full rounded border border-yellow-500/40 shadow"
            >

            <input
                @if($customerID !== null) disabled @endif
                required
                step=".01"
                wire:model.live='Balance_Amount'
                placeholder="Balance Amount (SAR)"
                type="number"
                min="0"
                class="max-w-[400px] mb-3 w-full rounded border border-yellow-500/40 shadow"
            >
            <div class="max-h-[250px] overflow-y-auto">
                @forelse ($services as $index => $service )
                <div class="flex gap-2 my-2">
                    <button wire:click='remove({{ $index }})' class="w-10" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-rose-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                    <div class="grid grid-cols-4 gap-2">
                        <input
                            @if($customerID !== null) disabled @endif
                            required
                            step=".01"
                            class="z-0 w-full border rounded-md shadow-md border-black/20"
                            type="number"
                            min="0"
                            wire:model.live.debounce.300ms='services.{{ $index }}.ServiceFee'
                            placeholder="Service Fee (SAR)">
                        <input
                            @if($customerID !== null) disabled @endif
                            required
                            step=".01"
                            class="z-0 w-full border rounded-md shadow-md border-black/20"
                            type="number"
                            min="0"
                            wire:model.live.debounce.300ms='services.{{ $index }}.WorkshopFee'
                            placeholder="Workshop Fee (SAR)">
                        <input
                            @if($customerID !== null) disabled @endif
                            required
                            step=".01"
                            class="w-full border rounded-md shadow-md border-black/20"
                            type="number"
                            min="0"
                            wire:model.live.debounce.300ms='services.{{ $index }}.UnitAmount'
                            placeholder="Unit Amount (SAR)">

                        <input
                            disabled
                            step=".01"
                            required
                            class="w-full border rounded-md shadow-md border-black/20"
                            type="text"
                            wire:model.live.debounce.300ms='services.{{ $index }}.TotalAmount'
                            placeholder="Total Amount (SAR)">
                    </div>
                </div>
                @empty
                <div class="text-yellow-600 border w-full border-yellow-600/80 bg-yellow-100/60 px-2 py-1.5 rounded-md">
                    <span>Add services</span>
                </div>
                @endforelse
            </div>
            <hr>
            @empty(!$services)
            <div class="flex justify-end mt-5 text-sm">
                <div class="flex flex-col gap-1.5 w-full max-w-64">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Subtotal (SAR)</span>
                        <div class="w-24 text-left">
                            <span>: {{ $SubTotal }} </span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between text-blue-600">
                        <span class="font-semibold">Balance Amount (SAR)</span>
                        <div class="w-24 text-left">
                            <span>: {{ $Balance_Amount }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-10">
                <button
                    wire:target='create'
                    @if($customerID !== null) disabled @endif
                    type="submit"
                    class="text-white disabled:bg-slate-300 disabled:cursor-not-allowed bg-blue-500 rounded-md max-w-32 w-full shadow-md border-black-600/40 px-2 py-1.5">
                    <span wire:target='create' wire:loading.remove>Create</span>
                    <span wire:target='create'  wire:loading>Loading</span>
                </button>

                @if($customerID !== null)
                <button
                    wire:click='downloadInvoice({{ $customerID }})'
                    type="button"
                    class="text-white bg-slate-800 rounded-md max-w-32 w-full shadow-md border-black-600/40 px-2 py-1.5">
                    <span wire:loading.remove>Download</span>
                    <span wire:loading>Loading</span>
                </button>
                @endif
            </div>
            @endempty

        </form>
    </div>
</div>
