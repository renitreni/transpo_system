@forelse ( $customers as $index => $customer)
    @foreach ($customer->orders as $order )
    <tr wire:key='{{ $order->id }}'>
        <td>{{ str($customer->FullName)->limit(30) }}</td>
        <td>{{ str($customer->CompanyName)->limit(35) }}</td>
        {{-- <td>{{ $customer->MethodPayment  }}</td>
        <td>{{ $order->Product  }}</td>
        <td>{{ $order->Color  }}</td>
        <td>{{ $order->Quantity  }}</td>
        <td>{{ $customer->OrderDate  }}</td> --}}
        <td>{{ $order->ChassisNumber }}</td>
        <td>
            @php
                $hasExpired = new DateTime($order->WarrantyExpiration);
                $today = new DateTime();
            @endphp

            @if ($today > $hasExpired )
                <span class="relative after:absolute after:-right-10 after:-top-6 after:rounded-full after:py-1 after:px-2 after:border after:text-rose-500 after:border-rose-600 after:bg-rose-200 after:text-xs after:content-['Expired'] after:w-auto after:h-6">
                    {{ $order->WarrantyExpiration }}
                </span>
            @else
                <span class="relative after:absolute after:-right-10 after:-top-6 after:rounded-full after:py-1 after:px-2 after:border after:text-blue-600 after:border-blue-600 after:bg-blue-200 after:text-xs after:content-['Valid'] after:w-auto after:h-6">
                    {{ $order->WarrantyExpiration }}
                </span>
            @endif

        </td>

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
    @endforeach
@empty
    <tr>
        <td colspan="12">No Clients</td>
    </tr>
@endforelse
