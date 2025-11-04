<div class="relative">
    <div class="fixed w-full opacity-60 blur inset-0 bg-black -z-[2]"></div>
    <img class="fixed inset-0 w-full -z-10 " src="{{ asset('wsbg.jpg') }}" alt="">
    <nav class="mt-5">
        <div class="container mx-auto rounded-lg navbar">
            <div class="navbar-start">
                <a href="{{ route('admin_Workshop',['lang'=>'en']) }}" class="font-semibold navbar-item">Workshop</a>
            </div>
            <div class="navbar-end">
                <div class="avatar ">
                    <div class="dropdown-container">
                        <div class="dropdown">
                            <label class="flex px-0 cursor-pointer btn btn-ghost" tabindex="0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>

                            </label>
                            <div class="dropdown-menu dropdown-menu-bottom-left">
                                <a href="{{ route('admin_Workshop',['lang'=>'en','page'=>'approval']) }}" tabindex="-1" class="text-sm dropdown-item">Approvals</a>
                                <a href="{{ route('admin_Workshop',['lang'=>'en','page'=>'report']) }}" tabindex="-1" class="text-sm dropdown-item">Report</a>
                                {{-- <a tabindex="-1" class="text-sm dropdown-item">Account settings</a> --}}
                                @if ($page == "")
                                    <label class="text-sm dropdown-item" for="invoice-modal">Create Invoice</label>
                                @endif
                                <a href="{{ route('maintenance', ['lang' => 'en']) }}"
                                        tabindex="-1" class="text-sm dropdown-item">Maintenance</a>
                                <a href="{{ route('admin_Logout') }}" tabindex="-1"
                                    class="text-sm text-rose-500 dropdown-item">Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @empty($page)
        <div class="relative w-full max-w-2xl mx-auto mt-10">
            <span class="absolute right-3 top-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>

            </span>
            <input wire:model.live.debounce.500ms='search'
                class="w-full placeholder:text-sm bg-[#f3f3f3] border border-black/30 rounded-md"
                placeholder="Search product name, chassis number .etc" type="text">
        </div>

        @if ($search != "")
        <div class="container mx-auto mt-10 bg-white rounded-md">
            <div class="flex w-full overflow-x-auto">
                <table class="table w-full table-compact">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Buyer</th>
                            <th>Product</th>
                            <th>Color</th>
                            <th>Chassis Number</th>
                            <th>Year Model</th>
                            <th>Warranty Expiration</th>
                            <th>Warranty Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $products as $product )
                        <tr wire:key='{{ $product->id }}'>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $product->customer->FullName }}</td>
                            <td>{{ $product->Product }}</td>
                            <td>{{ $product->Color }}</td>
                            <td>{{ $product->ChassisNumber }}</td>
                            <td>{{ $product->YearModel }}</td>
                            <td>{{ $product->WarrantyExpiration }}</td>
                            <td>
                                @php
                                $hasExpired = new DateTime($product->WarrantyExpiration);
                                $today = new DateTime();
                                @endphp

                                @if($today > $hasExpired)
                                <span
                                    class="px-4 py-1 font-semibold border rounded text-rose-700 bg-rose-200 border-rose-500">Expired</span>
                                @else
                                <span
                                    class="px-4 py-1 font-semibold text-blue-700 bg-blue-200 border border-blue-500 rounded">Valid</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12"><span class=" text-rose-600">No record</span></td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

        @else
        <div class="flex items-center justify-center mt-14">
            {{-- <img class="w-[500px] h-auto" src="{{ asset('svgs/Software code testing-pana.svg') }}" alt="search"> --}}
        </div>
        @endif
        @include('livewire.admin.workshop.includes.create-invoice')
    @endempty


    @isset($page)
        @if ($page == 'report')
            <livewire:admin.workshop.report />
        @endif
        @if ($page == 'approval')
            <livewire:admin.workshop.approval />
        @endif
    @endisset


</div>
