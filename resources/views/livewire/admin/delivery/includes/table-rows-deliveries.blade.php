@forelse ( $customers as $index => $customer)

    @php
        $rowClass = '';
        if ($customer->insurance_expiry_date) {
            $expiryDate = \Carbon\Carbon::parse($customer->insurance_expiry_date);
            $today = \Carbon\Carbon::now();
            $daysUntilExpiry = $today->diffInDays($expiryDate);

            if ($daysUntilExpiry < 0) {
                // Expired - Red with blinking
                $rowClass = 'bg-red-100 animate-pulse';
            } elseif ($daysUntilExpiry <= 60) {
                // Before 2 months (60 days) - Yellow
                $rowClass = 'bg-yellow-100';
            } else {
                // Not expired - Green
                $rowClass = 'bg-green-100';
            }
        }
    @endphp
    <tr wire:key='{{ $customer->Customer_uuid }}' class="{{ $rowClass }}">
        <th>{{ $loop->iteration }}</th>
        <td>{{ $customer->PlateNo }}</td>
        <td>{{ $customer->PhoneNumber }}</td>
        <td>{{ $customer->CompanyName }}</td>
        <td>{{ str($customer->OfficeAddress)->limit(30) }}</td>
        <td>{{ str($customer->OtherLocation)->limit(30) }}</td>
        <td>{{ $customer->OrderDate }}</td>
        <td>{{ $customer->driver_name }}</td>
        <td>{{ $customer->car_insurance_company }}</td>
        <td>{{ $customer->resident_iqama_number }}</td>
        <td>{{ $customer->driver_license_number }}</td>
        <td>{{ $customer->driver_license_expiry_date ? \Carbon\Carbon::parse($customer->driver_license_expiry_date)->format('M d, Y') : '' }}</td>
        <td>{{ $customer->insurance_expiry_date ? \Carbon\Carbon::parse($customer->insurance_expiry_date)->format('M d, Y') : '' }}</td>
        <td>
            @if ($customer->driver_status)
                <span class="badge badge-{{ $customer->driver_status === 'active' ? 'success' : ($customer->driver_status === 'inactive' ? 'error' : 'warning') }}">
                    {{ ucfirst($customer->driver_status) }}
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
@empty
    <tr>
        <td colspan="15">No Clients</td>
    </tr>
@endforelse
