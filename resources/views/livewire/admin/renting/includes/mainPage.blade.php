<div class="container p-6 mx-auto bg-white rounded-md mt-7">
    @include('success.success')
    <section>
        <div class="flex items-center justify-between mb-3">
            <div class="text-black">
                <h1 class="text-2xl font-medium">Clients/العميل</h1>
                <small class="font-light">All records of clients/جميع سجلات العملاء.</small>
            </div>

            <div class="">
                @if (auth()->user()->role === "Accountant")
                <button x-on:click="$dispatch('open-modal','open-accountant-modal')"
                    class="px-2 py-1 rounded btn gap-x-1 btn-sm btn-solid-primary hover:btn-outline-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                    </svg>
                    <span>Approvals</span>
                </button>
                @endif

                <button x-on:click="$dispatch('open-modal','send-email-modal')"
                    class="px-2 py-1 rounded btn gap-x-1 btn-sm hover:text-white hover:btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    <span>Send Mail</span>
                </button>
            </div>

        </div>
        <div class="flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 ">
                            <thead class="bg-gray-50 ">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        <div class="flex items-center gap-x-3">
                                            <button class="flex items-center gap-x-2">
                                                <span>Track # / </span>
                                            </button>
                                        </div>
                                    </th>

                                    <th scope="col"
                                        class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        <div class="flex items-center gap-x-3">
                                            <button class="flex items-center gap-x-2">
                                                <span>Purchased #/ رقم الشراء</span>
                                            </button>
                                        </div>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Company/الشركة
                                    </th>

                                    {{-- <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Contact Person/الشخص المتواصل
                                    </th> --}}

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Method Payment/ طريقة الدفع
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        # of Units
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Entry Date/ تاريخ الإدخال
                                    </th>

                                    <th scope="col" class="relative py-3.5 px-4">
                                        @if (auth()->user()->role != "Fleet")
                                        <a class="float-right btn btn-sm btn-solid-primary hover:btn-primary"
                                            href="{{ route('admin_Renting',['lang'=>'en','page'=>'request']) }}">
                                            New Client</a>
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 ">
                                @forelse ( $collection as $record )
                                <tr wire:key='{{ $record->id }}'>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex items-center gap-x-3">
                                            <span>{{ $record->track_number }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        <div class="inline-flex items-center gap-x-3">
                                            <span>{{ $record->purchase_number }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $record->company_name }}</td>
                                    {{-- <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        <div class="flex items-center gap-x-2">
                                            <img class="object-cover w-8 h-8 rounded-full"
                                                src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80"
                                                alt="">
                                            <div>
                                                <h2 class="text-sm font-medium text-gray-800 ">
                                                    {{ $record->contact_person }}</h2>
                                                <p class="text-xs font-normal text-gray-600 ">
                                                    {{ $record->contact_email }}</p>
                                            </div>
                                        </div>
                                    </td> --}}

                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        @php
                                        if( $record->paymentMethod == 12){
                                        $method = "Monthly";
                                        }else if( $record->paymentMethod == 52){
                                        $method = "Weekly";
                                        }else{
                                        $method = "Yearly";
                                        }
                                        @endphp
                                        {{ $method }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $record->number_units }} units
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $record->entry_date }}
                                    </td>

                                    <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">

                                        <div class="flex items-center gap-x-1">

                                            @if (auth()->user()->role === "Sales")
                                                @if ($record->personSales != null)
                                                <button disabled wire:click='approval({{ $record->id }})'
                                                    class=" disabled:text-green-600">
                                                    <span class="text-xs">Approved</span>

                                                </button>
                                                @else
                                                <button wire:click='approval({{ $record->id }})'
                                                    class="px-2 py-1 rounded hover:text-white hover:btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>

                                                </button>
                                                @endif
                                            @endif
                                            <button wire:click='viewRent({{ $record }})'
                                                class="px-2 py-1 rounded hover:text-white hover:btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </button>


                                            @if (auth()->user()->role != "Fleet")
                                            <button wire:click='edit({{ $record }})'
                                                class="px-2 py-1 rounded hover:text-white hover:btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>

                                            </button>
                                            <button wire:confirm='Confirm permanent delete?'
                                                wire:click='delete({{ $record }})'
                                                class="px-2 py-1 rounded hover:text-white hover:btn-error">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12"><span class="ml-10 text-sm text-rose-600">No record</span></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $collection->links('vendor.livewire.tailwind') }}
        </div>
    </section>
    <livewire:admin.renting.accountant-approval />
</div>
