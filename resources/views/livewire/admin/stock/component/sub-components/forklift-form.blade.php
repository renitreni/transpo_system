<div x-show="open" x-transition>
    <form wire:submit='save' class="flex flex-col gap-4">
        <div class="grid grid-cols-4 gap-3">

                <input required wire:model='ChassisNumber'
                class="col-span-2 bg-transparent rounded-md shadow-md border-black/20 placeholder:text-sm"
                placeholder="Chassis Number" type="text">
                <input wire:model='Size'
                    class="bg-transparent rounded-md shadow-md border-black/20 placeholder:text-sm"
                    placeholder="Size in meters" type="number" min="0">

                <input wire:model='Height'
                    class="bg-transparent rounded-md shadow-md border-black/20 placeholder:text-sm"
                    placeholder="Height in meters" type="number" min="0">

                <select class="text-sm bg-transparent rounded-md shadow-md cursor-pointer border-black/20" wire:model='Type'>
                    <option selected value="DUPLEX MAST" >Duplex Mast</option>
                    <option value="DUPLEX MAST 3 WAY" >Duplex Mast 3 Way</option>
                    <option value="DUPLEX MAST 4 WAY" >Duplex Mast 4 Way</option>
                </select>
                <select class="text-sm bg-transparent rounded-md shadow-md cursor-pointer border-black/20" wire:model='Warehouse'>
                    <option selected value="WAREHOUSE RIYADH" >Warehouse Riyadh</option>
                    <option value="WAREHOUSE DAMMAM" >Warehouse Dammam</option>
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
