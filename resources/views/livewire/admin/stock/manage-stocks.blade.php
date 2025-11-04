<div>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Stocks</h1>
        <form wire:submit.prevent='goSearch' class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-[25px] left-2 top-2  absolute">
                <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <input list="generalSearchResult" placeholder="Search chassis number" class="border pl-[2.5em] placeholder:text-sm placeholder:italic rounded shadow border-black/10" type="search" wire:model='generalSearch'>
        </form>
    </div>
    @include('livewire.admin.stock.includes.tabs')

    <section>
        @if ($selected == "trucks")
            <livewire:admin.stock.component.truck-component >
        @endif

        @if ($selected == "wheel_loader")
            <livewire:admin.stock.component.wheel-loader-component >
        @endif

        @if ($selected == "forklift")
        <livewire:admin.stock.component.forklift-component >
    @endif
    </section>
</div>
