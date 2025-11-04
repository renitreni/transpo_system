<section class="container w-full h-full p-4 mx-auto mt-4 bg-white rounded">
    <div class="flex justify-end gap-2 text-sm">
        @if ($isEdit)
        @if ($isSalesApproved)
        <a href="{{ route('admin_Renting',['lang'=>'en','id'=>$rent_id,'page'=>'invoice-show']) }}"
            class="btn btn-xs gap-x-1 btn-solid-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
            </svg>

            <span>Payments</span>
        </a>
        @else
        <small class="text-yellow-600 badge">Not approved by sales.</small>
        @endif
        @endif
        <a href="{{ route('admin_Renting',['lang'=>'en']) }}" class="btn btn-xs btn-solid-error">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
            <span>Cancel</span>
        </a>
    </div>
    <form wire:submit='save' enctype="multipart/form-data">
        @include('success.success')
        @include('livewire.admin.renting.includes.client')
        <div class="divider"></div>
        @include('livewire.admin.renting.includes.services')
        <div class="divider"></div>
        @include('livewire.admin.renting.includes.receiver')
        <div class="divider"></div>
        @include('livewire.admin.renting.includes.sales-man')
        <div class="flex justify-end px-4 my-5 gap-x-2">
            @if ($isEdit)
            <button wire:loading.attr='disabled' wire:target='save' class="btn disabled:btn-secondary btn-primary"
                type="submit">
                <span wire:target='save' wire:loading.remove> Update Details
                    <span wire:target='save' wire:loading>Loading</span>
            </button>
            @else
            <button wire:loading.attr='disabled' wire:target='save' class="btn disabled:btn-secondary btn-primary"
                type="submit">
                <span wire:target='save' wire:loading.remove>Create Request/إنشاء طلب</span>
                <span wire:target='save' wire:loading>Loading</span>
            </button>
            @endif
        </div>
    </form>

    @if($isEdit)
    @include('livewire.admin.renting.includes.files')
    @endif
</section>
