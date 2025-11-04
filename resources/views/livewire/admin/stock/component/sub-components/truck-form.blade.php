<div x-transition x-show="open">
    <form wire:submit='save' class="flex flex-col items-end gap-4">
        <div>
            <select wire:model='Stocks'
                class="text-sm bg-transparent rounded-md shadow-md cursor-pointer border-black/20">
                <option selected value="CAMAC">CAMAC</option>
                <option  value="CAMAC HEAD">CAMAC HEAD</option>
                <option  value="CAMAC HEAD H7">CAMAC HEAD H7</option>
            </select>
            <select wire:model='Type'
                class="text-sm bg-transparent rounded-md shadow-md cursor-pointer border-black/20">
                <option  value="N/A">None</option>
                <option selected value="MIXER">Mixer</option>
                <option  value="MIXER-H7">Mixer H7</option>
                <option  value="MANUAL GEAR">Manual Gear</option>
                <option  value="AUTOMATIC GEAR">Automatic Gear</option>
            </select>
            <input required wire:model='ChassisNumber'
                class="bg-transparent rounded-md shadow-md border-black/20 placeholder:text-sm"
                placeholder="Chassis Number" type="text">

            <input style="max-width:6rem;width:100%;" required wire:model='Color'
                class="bg-transparent rounded-md shadow-md border-black/20 placeholder:text-sm"
                placeholder="Color" type="text">

            <select class="text-sm bg-transparent rounded-md shadow-md cursor-pointer border-black/20" wire:model='Warehouse'>
                <option selected value="WAREHOUSE RIYADH" >Warehouse Riyadh</option>
                <option value="WAREHOUSE DAMMAM" >Warehouse Dammam</option>
            </select>
            {{-- <input wire:model='Warehouse'
                class="bg-transparent rounded-md shadow-md border-black/20 placeholder:text-sm"
                placeholder="Warehouse" type="text"> --}}
        </div>

        <div>
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
