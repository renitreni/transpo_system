<div>
    <div class="flex items-center justify-between pt-1 pb-3 text-lg font-medium">
        <h1>Equipment Movement Daily Report / تقرير حركة المعدات اليومية</h1>
        <div class="flex items-center gap-2">
            <button type="button" x-on:click="$dispatch('open-modal','add-log-report')"
                class="btn btn-xs btn-solid-primary gap-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Add Record</span>
            </button>
            <button wire:click='export({{ $fleet_id }})' class="btn btn-xs btn-solid-primary gap-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                </svg>

                <span>Download</span>
            </button>
            <a class="btn btn-solid-primary btn-xs"
                href="{{ route('admin_Renting', ['lang' => 'en', 'page' => 'fleet-report']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
                <span>Back</span>
            </a>
        </div>
    </div>
    @include('success.success')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-2">
        <div class="flow-root py-3 border border-gray-100 rounded-lg shadow-sm">
            <dl class="-my-3 text-sm divide-y divide-gray-100">
                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Area / المنطقة</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $fleetData->area }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Date / التاريخ</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $fleetData->date }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Day / اليوم</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $fleetData->dayName }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Branch Manager / مدير الفرع
                        r</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $fleetData->branch_manager }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Motion Official / مسؤول الحركة</dt>
                    <dd class="text-gray-700 sm:col-span-2">
                        {{ $fleetData->motion_official }}
                    </dd>
                </div>
                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Forman / مشرف</dt>
                    <dd class="text-gray-700 sm:col-span-2">
                        {{ $fleetData->forman }}
                    </dd>
                </div>
            </dl>
        </div>

        <div class="flow-root py-3 border border-gray-100 rounded-lg shadow-sm">
            <dl class="-my-3 text-sm divide-y divide-gray-100">
                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Company / الشركة</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $fleetData->rent->company_name }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Purchased # / رقم الشراء/dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $fleetData->rent->purchase_number }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Company C.R. / السجل التجاري للشركة</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $fleetData->rent->company_cr }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Contact Person / الشخص المسؤول</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $fleetData->rent->contact_person }}</dd>
                </div>

            </dl>
        </div>
    </div>


    <div class="mt-3 overflow-x-auto border border-gray-200 rounded-lg">
        <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
            <thead class="text-left">
                <tr>
                    <th class="px-4 py-2 font-medium text-gray-900 bg-slate-200 whitespace-nowrap">Location / الموقع
                    </th>
                    <th class="px-4 py-2 font-medium text-gray-900 bg-slate-200 whitespace-nowrap">Employee No. / رقم
                        الموظف</th>
                    <th class="px-4 py-2 font-medium text-gray-900 bg-slate-200 whitespace-nowrap">Driver Name / اسم
                        السائق</th>
                    <th class="px-4 py-2 font-medium text-gray-900 bg-slate-200 whitespace-nowrap">Equipment Type / نوع
                        المعدات</th>
                    <th class="px-4 py-2 font-medium text-gray-900 bg-slate-200 whitespace-nowrap">Working Hours / ساعات
                        العمل</th>
                    <th class="px-4 py-2 font-medium text-gray-900 bg-slate-200 whitespace-nowrap">Equipment No. / رقم
                        المعدات</th>
                    <th class="px-4 py-2 font-medium text-gray-900 bg-slate-200 whitespace-nowrap"></th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($fleetData->logs as $log)
                    <tr>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $log->location }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $log->employee_no ?? 'Renting' }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $log->driver_name }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $log->equipment_type }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $log->working_hours }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $log->equipment_no }}</td>
                        <td class="space-x-3">
                            <button wire:click='show({{ $log->id }})' class="text-xs text-blue-600">view</button>
                            <button wire:confirm='Are you sure to delete this record?'
                                wire:click='delete({{ $log }})' class="text-xs text-rose-600">Delete</button>


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12">
                            <span class="ml-4 text-sm text-rose-500">No fleet logs</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-modal name="add-log-report" :show="false" maxWidth="3xl" focusable>
        <form enctype="multipart/form-data" wire:submit='save' class="p-6">
            <div class="mb-5">
                <h1 class="text-lg font-medium">Add Record / إضافة سجل</h1>
                <small>All fields are required / جميع الحقول مطلوبة</small>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-2 gap-y-3">
                <div class="col-span-full md:col-span-2">
                    <label for="location" class="block text-sm font-medium text-gray-700">Location / الموقع</label>
                    <input wire:model.lazy='location' id="location" required type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                    @error('location')
                        <small class="text-rose-500">{{ $message }}</small>
                    @enderror
                </div>


                <div class="col-span-full md:col-span-1">
                    <label for="driver_type" class="block text-sm font-medium text-gray-700">Driver Type / نوع
                        السائق</label>
                    <select wire:model.lazy='driver_type' id="driver_type"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                        <option selected value="Employee">Employee</option>
                        <option value="Renting">Renting</option>
                    </select>
                    @error('driver_type')
                        <small class="text-rose-500">{{ $message }}</small>
                    @enderror

                </div>

                <div class="col-span-full md:col-span-1">
                    <label for="driver_name" class="block text-sm font-medium text-gray-700">Driver Name / اسم
                        السائق</label>
                    <input wire:model.lazy='driver_name' id="driver_name" required type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                    @error('driver_name')
                        <small class="text-rose-500">{{ $message }}</small>
                    @enderror

                </div>

                @if ($driver_type == 'Employee')
                    <div class="col-span-full md:col-span-1">
                        <label for="employee_no" class="block text-sm font-medium text-gray-700">Employee No. / رقم
                            الموظف.</label>
                        <input wire:model.lazy='employee_no' id="employee_no" required type="text"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                        @error('employee_no')
                            <small class="text-rose-500">{{ $message }}</small>
                        @enderror

                    </div>
                @endif


                <div class="col-span-full md:col-span-1">
                    <label for="working_hours" class="block text-sm font-medium text-gray-700">Working Hours / ساعات
                        العمل</label>
                    <input wire:model.lazy='working_hours' min="0" id="working_hours" required type="number"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                    @error('working_hours')
                        <small class="text-rose-500">{{ $message }}</small>
                    @enderror

                </div>

                <div class="col-span-full md:col-span-1">
                    <label for="equipment_type" class="block text-sm font-medium text-gray-700">Equipment Type / نوع
                        المعدات</label>
                    <input wire:model.lazy='equipment_type' id="equipment_type" required type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                    @error('equipment_type')
                        <small class="text-rose-500">{{ $message }}</small>
                    @enderror

                </div>

                <div class="col-span-full md:col-span-1">
                    <label for="equipment_status" class="block text-sm font-medium text-gray-700">Equipment Status /
                        حالة المعدات</label>
                    <select wire:model.lazy='equipment_status' id="equipment_status"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                        @foreach (\App\Enums\EquipmentStatusEnum::cases() as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('equipment_status')
                        <small class="text-rose-500">{{ $message }}</small>
                    @enderror

                </div>

                <div class="col-span-full md:col-span-1">
                    <label for="equipment_no" class="block text-sm font-medium text-gray-700">Equipment No. / رقم
                        المعدات</label>
                    <input wire:model.lazy='equipment_no' id="equipment_no" required type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                    @error('equipment_no')
                        <small class="text-rose-500">{{ $message }}</small>
                    @enderror

                </div>

                <div class="col-span-full">
                    <label for="fileUpload" class="block mb-1 text-sm font-medium text-gray-700">Upload file / تحميل
                        ملف</label>
                    <label
                        class="flex items-center justify-center w-full p-6 transition-all border-2 border-gray-200 border-dashed rounded-md appearance-none cursor-pointer hover:border-primary-300">
                        <div class="space-y-1 text-center">
                            <div
                                class="inline-flex items-center justify-center w-10 h-10 mx-auto bg-gray-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                </svg>
                            </div>
                            <div class="text-gray-600">
                                <a class="font-medium text-primary-500 hover:text-primary-700">Click to upload
                                </a>
                            </div>
                            <p class="text-sm text-gray-500">PNG, JPG, PDF or DOCX (max. 1 MB)</p>
                        </div>
                        <input multiple id="fileUpload" wire:model='fileUpload' type="file" class="sr-only" />
                    </label>
                </div>
                @error('fileUpload')
                    <small class="text-rose-500">{{ $message }}</small>
                @enderror

                <small wire:target='fileUpload' wire:loading>Uploading file...</small>

                @if (!empty($fileUpload))
                    <div class="overflow-x-auto border border-gray-200 rounded-lg col-span-full">
                        <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                            <thead class="text-xs text-left">
                                <tr>
                                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Filename</th>
                                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Size</th>
                                </tr>
                            </thead>

                            <tbody class="text-xs divide-y divide-gray-200">
                                @foreach ($fileUpload as $file)
                                    <tr>
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $file->getClientOriginalName() }}</td>
                                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                                            {{ number_format($file->getSize() / 1024, 2) }} KB</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif



                <div class="col-span-full">
                    <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks / ملاحظات</label>
                    <textarea wire:model.lazy='remarks' rows="3" id="remarks" required type="text"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950"></textarea>
                    @error('remarks')
                        <small class="text-rose-500">{{ $message }}</small>
                    @enderror

                </div>

                <div class="flex justify-end col-span-full">
                    <button wire:loading.attr='disabled' wire:target='save' type="submit"
                        class="btn disabled:bg-slate-400 btn-solid-primary btn-sm">
                        <span wire:target='save' wire:loading.remove>Create Record</span>
                        <span wire:target='save' wire:loading>Saving...</span>
                    </button>
                </div>
            </div>

        </form>
    </x-modal>

    <x-modal name="log-details" :show="false">
        @isset($data)
            <div class="p-6">
                <div class="mb-3">
                    <h1 class="text-lg font-medium">View Details / عرض التفاصيل</h1>
                </div>
                <div class="flow-root py-3 border border-gray-100 rounded-lg shadow-sm">
                    <dl class="-my-3 text-sm divide-y divide-gray-100">
                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Location / الموقع</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $data->location }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Employee No. / رقم الموظف</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $data->employee_no }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Driver Name / اسم السائق</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $data->driver_name }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Driver Type / نوع السائق</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $data->driver_type }}</dd>
                        </div>


                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Equipment Type / نوع المعدات</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $data->equipment_type }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Equipment No. / رقم المعدات</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $data->equipment_no }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Equipment Status / حالة المعدات</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $data->equipment_status }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Working Hours / ساعات العمل</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $data->working_hours }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">
                                Remarks / ملاحظات</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $data->remarks }}</dd>
                        </div>
                    </dl>
                </div>
                <div class="my-4">
                    <h1 class="text-lg font-medium">File Uploads / تحميل الملفات</h1>
                </div>
                <div class="mt-3 overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                        <thead class="text-left">
                            <tr>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Filename / اسم الملف</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Type / النوع</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Size / الحجم</th>
                                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($data->files as $file)
                                <tr>
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap"><a target="_blank"
                                            class="text-blue-800"
                                            href="{{ route('show-file', ['file' => $file->filename]) }}">{{ $file->filename }}</a>
                                    </td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $file->extension }}</td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $file->size }}</td>
                                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap"></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12">
                                        No files uploaded
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endisset
    </x-modal>
</div>
