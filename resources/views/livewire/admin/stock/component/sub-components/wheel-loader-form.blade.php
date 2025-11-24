<div x-show="open" x-transition>
    <form wire:submit='save' class="flex flex-col gap-4">
        <div class="grid grid-cols-4 gap-3">

            <input wire:model='BrandModel'
                class="col-span-2 bg-transparent rounded-md shadow-md border-black/20 placeholder:text-sm"
                placeholder="Brand Model" type="text">
            <input required wire:model='ChassisNumber'
                class="col-span-2 bg-transparent rounded-md shadow-md border-black/20 placeholder:text-sm"
                placeholder="Chassis Number" type="text">
            {{-- <input wire:model='Warehouse'
                class="col-span-2 bg-transparent rounded-md shadow-md border-black/20 placeholder:text-sm"
                placeholder="Warehouse" type="text"> --}}

            <select
                class="col-span-2 bg-transparent rounded-md shadow-md cursor-pointer border-black/20 placeholder:text-sm"
                wire:model='Warehouse'>
                <option selected value="WAREHOUSE RIYADH">Warehouse Riyadh</option>
                <option value="WAREHOUSE DAMMAM">Warehouse Dammam</option>
            </select>

            <div class="col-span-2">
                <select wire:model='Stocks'
                    class="text-sm bg-transparent rounded-md shadow-md cursor-pointer border-black/20">
                    <option selected value="FAW">FAW</option>
                </select>

                <select wire:model='Type'
                    class="text-sm bg-transparent rounded-md shadow-md cursor-pointer border-black/20">
                    <option selected value="MIXER">Wheel Loader</option>
                </select>

                <select wire:model='isAvailable'
                    class="text-sm bg-transparent rounded-md shadow-md cursor-pointer border-black/20">
                    <option selected value="AVAILABLE">Available</option>
                    <option value="NOT AVAILABLE">Not Available</option>
                </select>
            </div>
            </select>
        </div>

        <div class="flex justify-end gap-2">
            @if (session('saved'))
                <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="mr-3 text-sm font-medium text-green-500">{{ session('saved') }}
                </span>
            @endif

            @if (session('error'))
                <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="mr-3 text-sm font-medium text-rose-500">{{ session('error') }}
                </span>
            @endif
            <button type="button" x-on:click="open = !open"
                class="px-3 py-1 text-sm text-white rounded bg-slate-500">Cancel</button>
            <button type="submit" class="px-3 py-1 text-sm text-white bg-blue-500 rounded">Save</button>
        </div>
    </form>
</div>
