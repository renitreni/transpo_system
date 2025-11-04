<x-modal name="search-modal" :show="false" focusable>
    <div class="p-6">
        <div class="relative">
            <label for="Search" class="sr-only"> Search </label>

            <input autocomplete="off" wire:model.live.debounce.200ms="search" type="text" id="Search"
                placeholder="Search for..."
                class="w-full rounded-md text-slate-800 border-gray-200 py-2.5 pe-10 shadow-sm sm:text-sm" />

            <span class="absolute inset-y-0 grid w-10 end-0 place-content-center">
                <button type="button" class="text-gray-600 hover:text-gray-700">
                    <span class="sr-only">Search</span>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </button>
            </span>
        </div>

        @empty($search)
        <div class="leading-none">
            <p class="px-2 mt-2 text-sm text-slate-400">Search for track number, purchased number, company or the client name.</p>
        <p class="text-xs px-2 mt-1 text-slate-400">ابحث عن رقم التتبع، رقم الشراء، الشركة أو اسم العميل.</p>
        </div>
        @endempty
        @if(!empty($search))
        <div class="mt-2 overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="text-left">
                    <tr>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Track #</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Purchased #</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Company</th>
                        {{-- <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Payment Method</th> --}}
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Entry Date</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap"></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($results as $result )
                    <tr wire:key='{{ $result->id }}'>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $result->track_number }}
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $result->purchase_number }}
                        </td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $result->company_name }}</td>
                        {{-- <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                            @php
                            $method = "";
                            if($result->paymentMethod == 12){
                            $method = "Monthly Payment";
                            }else if($result->paymentMethod == 52){
                            $method = "Weekly Payment";
                            }else{
                            $method = "Daily Payment";
                            }
                            @endphp
                            {{ $method }}
                        </td> --}}
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $result->entry_date }}</td>
                        <td>
                            <button wire:click='show({{ $result->id }})' class="btn btn-xs hover:btn-solid-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="px-4 py-2 text-gray-700 whitespace-nowrap">
                            No results for <span class="font-medium">"{{ $search }}"</span>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endif
    </div>

</x-modal>
