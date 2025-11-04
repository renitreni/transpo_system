<div class="flex w-full py-8 overflow-x-auto">
    <table class="table max-w-5xl mt-10 table-compact">
        <thead>
            <tr>
                <th>Brand</th>
                <th>Company</th>
                <th>VIN</th>
                <th>Location</th>
                <th>Status</th>
                <th>Approval</th>
                <th>Return Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $collections as $collection )
                <tr wire:key='{{ $collection->id }}'>
                    <th>{{ $collection->Brand }}</th>
                    <td>{{ str($collection->Company)->limit(35) }}</td>
                    <td>{{ $collection->VIN_ID }}</td>
                    <td>{{ str($collection->Location)->limit(35) }}</td>
                    <td>
                        @if ($collection->Status)
                            <span class="badge badge-outline-success">Working</span>
                        @else
                            <span class="badge badge-outline-error">Need Repair</span>
                        @endif
                    </td>
                    <td>
                    @if (isset($collection->supplierStatus->Decision) && $collection->supplierStatus->Decision && $selectStatus != 'empty')
                        <span
                            class="badge badge-{{ $collection->supplierStatus->Decision == 'Rejected' ? 'error' : 'success' }}">{{ $collection->supplierStatus->Decision }}</span>
                    @else
                        <span class="badge badge-warning">Pending</span>
                    @endif
                </td>
                <td>
                    @isset($collection->supplierStatus->Decision)
                        @if ($collection->supplierStatus->return_date)
                            <span class="relative inline-flex">
                                <label
                                    class="inline-flex items-center px-2 py-1 font-semibold leading-6 text-sm text-pink-500 bg-white"
                                    disabled="">
                                    {{ \Carbon\Carbon::parse($collection->supplierStatus->return_date)->format('F j, Y') }} - 
                                    {{ $collection->supplierStatus->courier }}
                                </label>
                                <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-500"></span>
                                </span>
                            </span>
                        @endif
                    @endisset
                </td>
                <td>
                    <div class="dropdown ">
                        <label class="p-0 mx-2 bg-transparent cursor-pointer btn" tabindex="0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                            </svg>
                        </label>
                        @include('livewire.admin.workshop.includes.actions-warranty')
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="12">No list</td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>
<div>
@if ($search === '' && $selectStatus === '')
    {{ $collections->links('vendor.livewire.tailwind') }}
@endif
</div>
