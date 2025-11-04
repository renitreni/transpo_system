<div>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Workshop Warranty</h1>
        <div class="flex items-center gap-2">
            <button wire:click='download' class="gap-1 bg-white shadow hover:bg-blue-500 hover:text-white btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <span class="text-sm text-nowrap">Download Report</span>
            </button>
            <select wire:model.live="selectStatus"
                class="px-3 text-sm border rounded-md shadow cursor-pointer border-black/10 w-40">
                <option value="">All Stocks</option>
                <option value="empty">Pending</option>
                <option value="Rejected">Rejected</option>
                <option value="Approved">Approved</option>
            </select>
            <button wire:click='create' class="gap-1 bg-white shadow hover:bg-blue-500 hover:text-white btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
                <span class="text-sm text-nowrap">Create Warranty</span>
            </button>
            <div>

            </div>
            @include('livewire.admin.inquire.includes.search-box')
        </div>
    </div>
    @include('success.success')
    @include('livewire.admin.workshop.includes.warranty-table')
    @include('livewire.admin.workshop.includes.view-warranty')
</div>
