<tr wire:key='{{ $truck->id }}'>
    <th>{{ $loop->iteration }}</th>

    @if ($editID === $truck->id)
    <td>
        <input class="w-full text-sm rounded-md border-black/10" type="text" wire:model='editable_ChassisNumber'>
    </td>

    <td>
        <input class="w-full text-sm rounded-md border-black/10" type="text" wire:model='editable_Color'>
    </td>

    <td>
        <select class="text-xs rounded-full border-black/10" wire:model='editable_Type'>
            <option value="N/A" @if($editable_Type == "N/A") selected @endif>None</option>
            <option value="MIXER" @if($editable_Type == "MIXER") selected @endif>Mixer</option>
            <option value="MIXER-H7" @if($editable_Type == "MIXER-H7") selected @endif>Mixer H7</option>
            <option value="MANUAL GEAR" @if($editable_Type == "MANUAL GEAR") selected @endif>Manual Gear</option>
            <option value="AUTOMATIC GEAR" @if($editable_Type == "AUTOMATIC GEAR") selected @endif>Automatic Gear</option>
        </select>
    </td>

    <td>
        <select class="text-xs rounded-full border-black/10" wire:model='editable_Stock'>
            <option value="CAMAC" @if($editable_Stock == "CAMAC") selected @endif>CAMAC</option>
            <option value="CAMAC HEAD" @if($editable_Stock == "CAMAC HEAD") selected @endif>CAMAC HEAD</option>
            <option value="CAMAC HEAD H7" @if($editable_Stock == "CAMAC HEAD H7") selected @endif>CAMAC HEAD H7</option>
        </select>
    </td>

    <td>
        <select class="text-xs rounded-full border-black/10" wire:model='editable_Warehouse'>
            <option value="WAREHOUSE RIYADH" @if($editable_Warehouse == "WAREHOUSE RIYADH") selected @endif>Warehouse Riyadh</option>
            <option value="WAREHOUSE DAMMAM" @if($editable_Warehouse == "WAREHOUSE DAMMAM") selected @endif>Warehouse Dammam</option>
        </select>
    </td>

    <td class="space-x-3 ">
        <button wire:click='saveEdit({{ $truck->id }})' class="text-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
        </button>

        <button
            wire:click='cancelEdit'
            type="button"
            class="text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </td>
    @else
    <td>{{ $truck->ChassisNumber }} </td>
    <td>{{ $truck->Color }} </td>
    <td>{{ $truck->Type }}</td>
    <td>{{ $truck->Stocks }}</td>
    <td>{{ $truck->Warehouse }}</td>
    <td class="space-x-3 ">
        <button
            type="button"
            wire:click='edit({{ $truck->id }})' class="text-blue-500 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
            </svg>
        </button>

        <button
            type="button"
            wire:click='delete({{ $truck->id }})'
            class="text-rose-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>
        </button>
    </td>
    @endif
</tr>


