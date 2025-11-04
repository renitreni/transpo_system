<div>
    <section>
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-medium text-black">Fleet Report / تقرير الأسطول</h2>
                <p class="mt-1 text-sm font-light text-black ">Equipment movement daily / حركة المعدات اليومية</p>
            </div>
            <div>
                @if (auth()->user()->role === "Fleet" || auth()->user()->role === "Accountant" )
                <a href="{{ route('admin_Renting',['lang'=>'en','page'=>'fleet-approval']) }}"
                    class="btn btn-solid-primary gap-x-1 btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>

                    <span>Approve Clients</span>
                </a>
                @endif
                <button x-on:click="$dispatch('open-modal','add-fleet-report')"
                    class="btn btn-solid-primary gap-x-1 btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>

                    <span>Add Report</span>
                </button>

                <button x-on:click="$dispatch('open-modal','download-fleet-report')"
                    class="btn btn-solid-primary gap-x-1 btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m-6 3.75 3 3m0 0 3-3m-3 3V1.5m6 9h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                      </svg>

                    <span>Monitoring</span>
                </button>


            </div>
        </div>
        @include('success.success')
        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 md:rounded-lg">

                        <table class="min-w-full divide-y divide-gray-200 ">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        <button class="flex items-center gap-x-3 focus:outline-none">
                                            <span>Area / المنطقة</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Date / التاريخ
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Day / اليوم
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Branch Manager / مدير الفرع</th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Motion Official / مسؤول الحركة</th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Forman / مشرف</th>

                                    <th scope="col" class="relative py-3.5 px-4">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 ">
                                @forelse ($reports as $report )
                                <tr wire:key='{{ $report->id }}'>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                        <div>
                                            <h2 class="font-medium text-gray-800 ">{{ $report->area }}</h2>
                                        </div>
                                    </td>
                                    <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                        <div class="inline px-3 py-1 text-sm font-normal rounded-full">
                                            {{ $report->date }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div>
                                            <h4 class="text-gray-700 ">{{ $report->dayName }}</h4>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        {{ $report->branch_manager }}
                                    </td>

                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        {{ $report->motion_official }}
                                    </td>

                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        {{ $report->forman }}
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="btn-group btn-group-scrollable">
                                            <button wire:click='log({{ $report->id }})'
                                                class="btn btn-solid-primary gap-x-1 btn-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                                </svg>
                                                <span>Logs</span>
                                            </button>
                                            <button
                                                wire:confirm='Deleting a record, results to permanent delete.\nAre you sure to delete record area of {{ $report->area }}?'
                                                wire:click='delete({{ $report }})'
                                                class="btn btn-solid-error gap-x-1 btn-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                                <span>Delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12">
                                        <span class="ml-4 text-sm text-rose-500">No fleet reports</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <x-modal focusable name="add-fleet-report" :show="false">
        <div class="p-6">
            <div class="mb-7">
                <h1 class="text-lg font-medium">Add Fleet Report / إضافة تقرير الأسطول</h1>
                <small>All fields are required / جميع الحقول مطلوبة</small>
            </div>
            <form wire:submit='save' class="grid grid-cols-1 gap-x-2 gap-y-4 md:grid-cols-3">

                <div class="col-span-full md:col-span-1">
                    <label for="area" class="block text-sm font-medium text-gray-700">Area / المنطقة</label>
                    <input wire:model.lazy='area' id="area" required type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                </div>
                <div class="col-span-full md:col-span-1">
                    <label for="date" class="block text-sm font-medium text-gray-700">Date / التاريخ</label>
                    <input wire:model.lazy='date' id="date" required type="date"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                </div>
                <div class="col-span-full md:col-span-1">
                    <label for="dayName" class="block text-sm font-medium text-gray-700">Day / اليوم</label>
                    <input wire:model.lazy='dayName' id="dayName" required type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                </div>


                <div class="col-span-full md:col-span-1">
                    <label for="branch_manager" class="block text-sm font-medium text-gray-700">Branch Manager / مدير
                        الفرع</label>
                    <input wire:model.lazy='branch_manager' id="branch_manager" required type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                </div>

                <div class="col-span-full md:col-span-1">
                    <label for="motion_official" class="block text-sm font-medium text-gray-700">Motion Official / مسؤول
                        الحركة</label>
                    <input wire:model.lazy='motion_official' id="motion_official" required type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                </div>

                <div class="col-span-full md:col-span-1">
                    <label for="forman" class="block text-sm font-medium text-gray-700">Forman / مشرف</label>
                    <input wire:model.lazy='forman' id="forman" required type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                </div>

                <div class="mt-3 mb-1 col-span-full">
                    <span class="text-sm font-medium">Company Details / تفاصيل الشركة</span>
                </div>
                <div class="flow-root py-3 border border-gray-100 rounded-lg shadow-sm col-span-full">
                    <dl class="-my-3 text-sm divide-y divide-gray-100">
                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Company / الشركة</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                <select wire:model.live='rent_id' id="rent_id"
                                    class="w-full p-1 border-0 rounded focus:px-2 focus:shadow focus:border-teal-950 focus:ring-teal-950">
                                    <option value="null" selected>Select Company</option>
                                    @forelse ($companies as $company )
                                    <option wire:key='{{ $company->id }}' value="{{ $company->id }}" selected>{{
                                        $company->company_name }} - {{
                                        $company->track_number }}</option>
                                    @empty
                                    <option disabled selected>No company</option>
                                    @endforelse
                                </select>
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Purchased # / رقم الشراء</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $purchasedNumber }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Company C.R. / السجل التجاري للشركة</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $companyCR }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Contact Person / الشخص المسؤول</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $contactPerson }}</dd>
                        </div>


                    </dl>
                </div>

                <div class="flex justify-end col-span-full">
                    <button type="submit" class="btn btn-solid-primary btn-sm">Create Report</button>
                </div>
            </form>
        </div>
    </x-modal>

    @isset($selectDownloadable)
    <x-modal maxWidth="lg" name="download-fleet-report" :show="false">
        <form wire:submit='downloadFleetReport' class="p-6">
            <div>
                <h1 class="font-medium">Download report</h1>
                <small>Select area to download all data related to that area.</small>
            </div>
            <div class="flex flex-col my-3">
                <label>Area</label>
                <select wire:model='fleetArea' class="text-sm border rounded shadow border-black/10 focus:border-black/40">
                    <option value="null" selected >Select Area</option>
                    @forelse ($selectDownloadable ?? [] as $report )
                     <option class="text-sm text-stone-800" value="{{ $report->rent->company_name }}/{{ $report->area }}/{{ $report->date }}" >{{ $report->area }} - {{ $report->date }} - {{ $report->dayName }}</option>
                    @empty
                        <option value="null"disabled>No list of area</option>
                    @endforelse
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn btn-solid-primary btn-sm">Download</button>
            </div>
        </form>
    </x-modal>
    @endisset
</div>
