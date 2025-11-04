<div class="relative">
    <div class="fixed w-full bg-white opacity-60 blur inset-0 -z-[2]"></div>
    {{-- <img class="fixed inset-0 w-full -z-10 " src="{{ asset('wsbg.jpg') }}" alt=""> --}}
    <nav class="mt-5">
        <div class="container mx-auto rounded-lg navbar">
            <div class="navbar-start">
                <a class="font-semibold navbar-item">Supplier Approval</a>
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
                                {{-- <a class="text-sm dropdown-item">Profile</a> --}}
                                {{-- <a tabindex="-1" class="text-sm dropdown-item">Account settings</a> --}}
                                {{-- <label class="text-sm dropdown-item" for="invoice-modal">Create Invoice</label>
                                --}}
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
    <div class="relative max-w-lg mx-auto mt-10 md:max-w-2xl">
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

    <div class="container mx-auto mt-10 bg-white rounded-md">
        <div class="flex w-full overflow-x-auto">
            <table class="table w-full table-compact">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Company</th>
                        <th>VIN</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Approval</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $supplies as $supply )
                    <tr wire:key='{{ $supply->id }}'>
                        <th>{{ $supply->Brand }}</th>
                        <td>{{ str($supply->Company)->limit(35) }}</td>
                        <td>{{ $supply->VIN_ID }}</td>
                        <td>{{ str($supply->Location)->limit(35) }}</td>
                        <td>
                            @if ($supply->Status)
                            <span class="badge badge-outline-success">Working</span>
                            @else
                            <span class="badge badge-outline-error">Need Repair</span>
                            @endif
                        </td>
                        <td>
                            @isset($supply->supplierStatus->Decision)
                                @if ($supply->supplierStatus->Decision != "")
                                <span class="badge {{ $supply->supplierStatus->Decision == "Rejected" ? "badge-error":"badge-success"  }}">{{ $supply->supplierStatus->Decision }}</span>
                                @endif
                            @endisset
                            @empty ($supply->supplierStatus->Decision)
                                <span class="badge badge-warning">Pending</span>
                            @endempty
                        </td>
                        <td>
                            @if (!isset($supply->supplierStatus))
                                <small>No Other Details</small>
                            @endif
                            @isset($supply->supplierStatus)
                            <a wire:navigate class="gap-2 text-sm text-white bg-blue-600 btn hover:bg-blue-500 btn-sm" href="{{ route('admin_View_Supplier',['lang'=>'en','id'=> $supply->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <span>View</span>
                            </a>
                            @endisset
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12">No list</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $supplies->links('vendor.livewire.tailwind') }}
            </div>
        </div>
    </div>
</div>
