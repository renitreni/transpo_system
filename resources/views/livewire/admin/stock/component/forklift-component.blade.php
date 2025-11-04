<div class="w-full py-3 space-y-3">
    <div x-cloak x-data="{open:false}" class="px-3 py-4 bg-white rounded-md shadow">
        <div class="flex justify-between gap-3">

            <div x-show='!open' x-transition class="relative w-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute top-3 left-2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                  </svg>
                  <input wire:model.live.debounce.500ms='search' type="text" class="w-full pl-10 border rounded-full border-black/20 placeholder:text-sm" placeholder="Total Forklifts: {{ $totalForklifters }}">
            </div>

            <div x-show='!open' x-transition class="flex gap-2 max-w-[300px] w-full">

                <select wire:model.live='selectType' class="w-full p-1 px-3 text-sm border rounded-md shadow cursor-pointer border-black/10">
                    <option selected value="">All Types</option>
                    @forelse ($types as $type )
                        <option wire:key='{{ $type }}' value="{{ $type }}">{{ $type }}</option>
                    @empty
                        <option disabled> No Types</option>
                    @endforelse
                </select>

                {{-- <select wire:model.live='selectHeights' class="w-full p-1 px-3 text-sm border rounded-md shadow cursor-pointer border-black/10">
                    <option selected value="">All Heights</option>
                    @forelse ($heights as $height )
                        <option wire:key='{{ $height }}' value="{{ $height }}">{{ $height }} meters</option>
                    @empty
                        <option disabled> No Heights</option>
                    @endforelse
                </select> --}}

            </div>
            <button x-transition x-show="!open" x-on:click="open = !open"
                class="w-full px-2 py-1 text-sm text-white duration-200 bg-blue-400 rounded-full hover:bg-blue-600 max-w-36">Add
                Forklift
            </button>

            <button x-transition x-show="!open" x-on:click="$wire.downloadRecords()"
                class="w-full px-2 py-1 text-sm text-blue-500 duration-200 bg-white border rounded-full shadow-md border-blue-600/20 hover:bg-slate-600 max-w-24">
                Download
            </button>
        </div>
        @include('livewire.admin.stock.component.sub-components.forklift-form')
    </div>

    <div>
        @include('success.success')
        <div class="flex w-full overflow-x-auto">
            <table class="table w-full table-compact">
                <thead>
                    <tr>
                        <th>Series</th>
                        <th>Chassis Number</th>
                        <th>Size</th>
                        <th>Height</th>
                        <th>Type</th>
                        <th>Stock</th>
                        <th>Warehouse</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $forklifts as $forklift )
                        @include('livewire.admin.stock.component.sub-components.forklift-table')
                    @empty
                    <tr>
                        <td colspan="12">No Forklifts</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{-- {{ $forklifts->withPath(session('forkliftURL'))->links('vendor.livewire.tailwind') }} --}}
            {{ $forklifts->links('vendor.livewire.tailwind') }}

        </div>
    </div>
</div>
