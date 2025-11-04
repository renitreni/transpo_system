<input class="modal-state" id="modal-inquire" type="checkbox" />
@if($selectedInquiry)
<div class="modal ">
	<label class="modal-overlay" for="modal-inquire"></label>
	<div class="modal-content flex flex-col gap-5 relative before:absolute before:content-[''] before:left-0 before:top-0 before:w-1 before:h-full before:bg-blue-500">
        <div>
            @if(session('notfound'))
            <div class="alert alert-error mt-4">
                <svg width="32" height="32" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M24 4C12.96 4 4 12.96 4 24C4 35.04 12.96 44 24 44C35.04 44 44 35.04 44 24C44 12.96 35.04 4 24 4ZM24 26C22.9 26 22 25.1 22 24V16C22 14.9 22.9 14 24 14C25.1 14 26 14.9 26 16V24C26 25.1 25.1 26 24 26ZM26 34H22V30H26V34Z"
                        fill="#E92C2C" />
                </svg>
                <div class="flex flex-col">
                    <span class="text-content2">{{ session('notfound') }}</span>
                </div>
            </div>
            @endif
            <label wire:click='resetInquiryModal' for="modal-inquire" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </label>
            <button wire:confirm='Are you sure to delete this?' wire:click='deleteInquiry("{{ $selectedInquiry->inquire_uuid }}")' class="btn btn-sm btn-circle btn-ghost text-rose-500 absolute right-11 top-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </button>
        </div>
		<div class="leading-3">
            <h2 class="text-xl font-semibold">{{ $selectedInquiry->FullName }}</h2>
            <div>
                <small>{{ $selectedInquiry->Email }}</small> •
                <small>{{ $selectedInquiry->PhoneNumber }}</small>
            </div>
        </div>
        <div class="overflow-y-auto pr-5">
            <p class="text-justify text-sm text-wrap break-words">{!! nl2br(e($selectedInquiry->Message)) !!}</p>
        </div>
        <hr>
        <div class="flex justify-end">
            <small class="text-xs">{{ date('F d, Y',strtotime($selectedInquiry->created_at)) }}</small>
        </div>
	</div>
</div>
@endif
