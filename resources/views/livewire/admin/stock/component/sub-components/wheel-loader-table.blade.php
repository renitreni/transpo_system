<tr wire:key='{{ $truck->id }}'>
    <th>{{ $loop->iteration }}</th>

    @if ($editID === $truck->id)
    <td>
        <input class="w-full text-sm rounded-md border-black/10" type="text" wire:model='editable_BrandModel'>
    </td>

    <td>
        <input class="w-full text-sm rounded-md border-black/10" type="text" wire:model='editable_ChassisNumber'>
    </td>

    <td>
        <select class="text-xs rounded-full border-black/10" wire:model.live='editable_Type'>
            <option selected value="WHEEL LOADER">WHEEL LOADER</option>
        </select>
    </td>

    <td>
        <select class="text-xs rounded-full border-black/10" wire:model='editable_Stock'>
            <option value="{{$editable_Stock}}">{{ $editable_Stock }}
            </option>
        </select>
    </td>

    <td>
        <input class="w-full text-sm rounded-md border-black/10" type="text" wire:model='editable_Warehouse'>
    </td>

    <td>
        <select class="text-xs rounded-full border-black/10" wire:model='editable_isAvailable'>
            <option {{$editable_isAvailable == "AVAILABLE" ? "selected":""  }} value="AVAILABLE">Available</option>
            <option {{$editable_isAvailable == "NOT AVAILABLE" ? "selected":""  }} value="NOT AVAILABLE">Not Available</option>
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
    <td>{{ $truck->BrandModel }}</td>
    <td>{{ $truck->ChassisNumber }}</td>
    <td>{{ $truck->Type }}</td>
    <td>{{ $truck->Stocks }}</td>
    <td>{{ $truck->Warehouse }}</td>
    <td>{{ $truck->isActive }}</td>
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
