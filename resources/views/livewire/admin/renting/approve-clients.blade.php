<section class="flex flex-col">
    @include('success.success')
    <div class="mb-3 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-medium">Approval Table / جدول الموافقة</h1>
            <small>List of client's request that are pending. / قائمة طلبات العميل التي هي قيد الانتظار.</small>
        </div>

        <div>
            <a class="btn gap-x-1 btn-sm btn-solid-primary"
                href="{{ route('admin_Renting', ['lang' => 'en', 'page' => 'fleet-report']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
                <span>Back</span>
            </a>
        </div>
    </div>
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden border border-gray-200 md:rounded-lg">

                <table class="min-w-full divide-y divide-gray-200 ">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="py-3.5 px-2 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                <button class="flex items-center gap-x-3 focus:outline-none">
                                    <span>Track Number / رقم التتبع</span>
                                </button>
                            </th>

                            <th scope="col"
                                class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                Purchased Number / رقم الشراء
                            </th>

                            <th scope="col"
                                class="px-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                Company Name / اسم الشركة
                            </th>

                            <th scope="col"
                                class="px-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                Number of Units / عدد الوحدات
                            </th>

                            <th scope="col"
                                class="px-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                Approve / وافق
                            </th>


                            <th scope="col" class="relative py-3.5 px-2">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 ">
                        @forelse ($notApprovedData as $data)
                            <tr wire:key='{{ $data->track_number }}'>
                                <td class="px-2 py-4 text-sm font-medium whitespace-nowrap">
                                    <div>
                                        <h2 class="font-medium text-gray-800 ">{{ $data->track_number }}</h2>
                                    </div>
                                </td>
                                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                    <div class="inline px-3 py-1 text-sm font-normal rounded-full">
                                        {{ $data->purchase_number }}
                                    </div>
                                </td>
                                <td class="px-2 py-4 text-sm whitespace-nowrap">
                                    <div>
                                        <h4 class="text-gray-700 ">{{ $data->company_name }}</h4>
                                    </div>
                                </td>

                                <td class="px-2 py-4 text-sm whitespace-nowrap">
                                    <div>
                                        <h4 class="text-gray-700 ">{{ $data->number_units }} units</h4>
                                    </div>
                                </td>
                                <td class="px-2 py-4 text-sm whitespace-nowrap">
                                    @if (!$data->isFleetApproved && empty($data->personFleet))
                                        <span class="text-yellow-600">No Approval</span>
                                    @elseif(!$data->isFleetApproved && !empty($data->personFleet))
                                        <span class="text-rose-600">Rejected</span>
                                    @else
                                        <span class="text-green-600">Approved</span>
                                    @endif
                                </td>


                                <td class="px-2 py-4 text-sm whitespace-nowrap">
                                    <div class="btn-group btn-group-scrollable">
                                        <button wire:target='AddUnit' wire:loading.attr='disabled'
                                            wire:click='AddUnit("{{ $data->id }}","{{ $data->number_units }}")'
                                            class="btn btn-solid-primary gap-x-1 btn-xs">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                            </svg>
                                            <span wire:target='AddUnit' wire:loading.remove>Approval</span>
                                            <span wire:target='AddUnit' wire:loading>Loading...</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12">
                                    <span class="ml-4 text-sm text-rose-500">Nothing to approve / لا يوجد شيء للموافقة
                                        عليه</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-modal maxWidth="7xl" name="approval-fleet-form" :show="false">
        <form enctype="multipart/form-data" wire:submit='save' class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-lg font-medium">Request Units / وحدات الطلب</h1>
                    <small>All fields are required. / جميع الحقول مطلوبة.
                    </small>
                </div>
                <div>
                    <small class="font-bold">Requested : {{ $num_units ?? 0 }} units </small>
                </div>
            </div>

            <small><span class="text-rose-600">Note : </span> The number of rows was based on the number of units
                requested.</small><br>
            <small class="ml-11"> If not approved the units will not be saved.</small>
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><small class="text-rose-600">{{ $error }}</small></li>
                    @endforeach
                </ul>
            @endif
            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                    <thead class="text-left">
                        <tr>
                            <th class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">Brand / العلامة التجارية
                            </th>
                            <th class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">Model / الطراز</th>
                            <th class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">Height / الارتفاع</th>
                            <th class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">VIN # / رقم VIN</th>
                            <th class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">Plate # / رقم اللوحة</th>
                            <th class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">Insurance / التأمين</th>
                            <th class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">Operator Name / اسم المشغل
                            </th>
                            <th class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">Location / الموقع
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @isset($unitsDetails)
                            @forelse ($unitsDetails as $index=>$unit)
                                <tr wire:key='{{ $index }}'>
                                    <td class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        <select wire:model.lazy='unitsDetails.{{ $index }}.truck_brand'
                                            id="truck_brand"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                                            <option selected value="">Select</option>
                                            @foreach (\App\Enums\CarBrandsEnum::cases() as $item)
                                                <option selected value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        <input wire:model.lazy='unitsDetails.{{ $index }}.truck_model'
                                            id="truck_model" type="text"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                                    </td>
                                    <td class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        <input wire:model.lazy='unitsDetails.{{ $index }}.truck_size'
                                            min="0" id="truck_size" type="number"
                                            class="max-w-[60px] border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                                    </td>
                                    <td class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        <input wire:model.lazy='unitsDetails.{{ $index }}.truck_vin'
                                            id="truck_vin" min="0" type="text"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                                    </td>
                                    <td class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        <input wire:model.lazy='unitsDetails.{{ $index }}.plate_number'
                                            id="plate_number" type="text"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                                    <td class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        <input wire:model.lazy='unitsDetails.{{ $index }}.insurance'
                                            id="insurance" type="text"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                                    </td>
                                    <td class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        <input wire:model.lazy='unitsDetails.{{ $index }}.operator_name'
                                            id="operator_name" type="text"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                                    <td class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        <input wire:model.lazy='unitsDetails.{{ $index }}.current_location'
                                            id="current_location" type="text"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12">Zero required units.</td>
                                </tr>
                            @endforelse
                        @endisset
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col w-full my-3">
                <label class="text-sm">Upload image / تحميل الصورة</label>
                <input wire:model='images' type="file" accept="image/*" multiple
                    class="p-1 border rounded shadow file:border-none max-w-[300px] file:text-sm file:rounded-full border-black/10">
                <small class="mt-1 text-yellow-600" wire:target='images' wire:loading>Uploading...</small>
                @isset($images)
                    <div class="grid grid-cols-2 gap-1 mt-2 sm:grid-cols-4 md:grid-cols-8">
                        @foreach ($images as $image)
                            <div class="h-[100px]">
                                <img class="w-full h-full rounded" src="{{ $image->temporaryUrl() }}" alt="images">
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>

            <div class="mt-6">
                <h1 class="text-lg font-medium">Approval Form / نموذج الموافقة</h1>
                <small>All fields are required. / جميع الحقول مطلوبة.</small>
            </div>
            <div class="flow-root py-3 mt-3 border border-gray-100 rounded-lg shadow-sm">
                <dl class="-my-3 text-sm divide-y divide-gray-100">
                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Decision / القرار</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            <select required wire:model='decision'
                                class="w-full p-1 border-0 rounded focus:px-2 focus:shadow focus:border-teal-950 focus:ring-teal-950">
                                <option value="">--- Select ----</option>
                                <option value="1">Approved</option>
                                <option value="0">Reject</option>
                            </select>
                        </dd>
                    </div>


                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Checked By / فحص بواسطة</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            <input wire:model='personFleet' type="text" required
                                class="w-full p-2 border rounded shadow border-black/10" placeholder="Full Name">
                        </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Remarks / ملاحظات</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            <textarea wire:model='remark' rows="3" class="w-full p-2 border rounded shadow border-black/10"></textarea>
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="flex justify-end mt-5">
                <button type="submit" class="btn btn-sm btn-solid-primary">Approved Request</button>
            </div>
        </form>
    </x-modal>
</section>
