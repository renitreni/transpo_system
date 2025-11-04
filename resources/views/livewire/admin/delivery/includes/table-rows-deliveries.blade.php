@forelse ( $customers as $index => $customer)
    <tr wire:key='{{ $customer->Customer_uuid }}'>
        <th>{{ $loop->iteration  }}</th>
        <td>{{ $customer->FullName }}</td>
        <td>{{ $customer->CompanyName}}</td>
        <td>{{ $customer->MethodPayment  }}</td>
        <td>{{ $customer->OrderDate }}</td>

        <td>
            <div class="dropdown ">
                <label class="p-0 mx-2 bg-transparent cursor-pointer btn" tabindex="0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                    </svg>
                </label>
                @include('livewire.admin.delivery.includes.actions-delivery')
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="12">No Clients</td>
    </tr>
@endforelse
