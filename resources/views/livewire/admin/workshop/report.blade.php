<section class="container relative mx-auto mt-10">

    <div class="overflow-x-auto border border-gray-200 rounded-lg">

        <div class="flex justify-end p-2 bg-white gap-x-2">
            <button x-on:click="$dispatch('open-modal','add-new-report')" class="btn btn-solid-primary btn-sm"> Add
                Report </button>
            <button wire:click='populateSelect' x-on:click="$dispatch('open-modal','download-report')"
                class="btn btn-sm btn-solid-primary">
                Download</button>

        </div>
        <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
            <thead class="text-left">
                <tr>
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">#</th>
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Description</th>
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">VIN #</th>
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Date Services</th>
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Labor Cost</th>
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Total Price</th>
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Remarks</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($reports as $report )
                <tr>
                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 text-gray-700 uppercase whitespace-wrap">{{ $report->description }}
                    </td>
                    <td class="px-4 py-2 text-gray-700 uppercase whitespace-nowrap">{{ $report->vin }}</td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ date('F d, Y',
                        strtotime($report->date_services)) }}</td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $report->labor_cost}} USD</td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $report->total_price}} USD</td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $report->remarks ?? "----"}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="12" class="px-4 py-2 font-medium text-gray-900 col-span-full whitespace-nowrap">No
                        report has been added.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-3 bg-white">
            {{ $reports->links('vendor.livewire.tailwind') }}
        </div>
    </div>

    <x-modal name="add-new-report" :show="false" focusable>
        <div class="p-6">
            <div>
                <h1 class="text-lg font-medium">Create new report</h1>
            </div>

            <form wire:submit='save' class="grid grid-cols-1 py-4 gap-x-2 gap-y-4 sm:grid-cols-3">
                <div class="col-span-2">
                    <label for="company_name" class="block text-xs font-medium text-gray-700"> Company Name </label>

                    <input list="company_list" wire:model='company_name' type="text" id="company_name" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('company_name') <small class="text-rose-600">{{ $message }}</small> @enderror

                    <datalist id="company_list">
                        <option value="Sultan Al Fouzan"></option>
                    </datalist>
                </div>

                <div>
                    <label for="supplier_name" class="block text-xs font-medium text-gray-700"> Supplier Name </label>

                    <input list="supplier_list" wire:model='supplier_name' type="text" id="supplier_name" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('supplier_name') <small class="text-rose-600">{{ $message }}</small> @enderror

                    <datalist id="supplier_list">
                        <option value="CAMC"></option>
                    </datalist>
                </div>
                <div class="col-span-2">
                    <label for="description" class="block text-xs font-medium text-gray-700"> Description </label>

                    <input wire:model='description' type="text" id="description" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('description') <small class="text-rose-600">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label for="vin" class="block text-xs font-medium text-gray-700"> VIN Number</label>

                    <input wire:model='vin' type="text" id="vin" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('vin') <small class="text-rose-600">{{ $message }}</small> @enderror
                </div>

                <div>
                    <label for="date_services" class="block text-xs font-medium text-gray-700"> Date Services</label>

                    <input wire:model='date_services' type="date" id="date_services" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('date_services') <small class="text-rose-600">{{ $message }}</small> @enderror

                </div>

                <div>
                    <label for="labor_cost" class="block text-xs font-medium text-gray-700"> Labor Cost (USD) </label>

                    <input wire:model='labor_cost' step="0.01" type="number" min="0" id="labor_cost" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('labor_cost') <small class="text-rose-600">{{ $message }}</small> @enderror

                </div>


                <div>
                    <label for="total_price" class="block text-xs font-medium text-gray-700"> Total Price (USD) </label>

                    <input wire:model='total_price' step="0.01" type="number" min="0" id="total_price" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('total_price') <small class="text-rose-600">{{ $message }}</small> @enderror

                </div>

                <div class="col-span-full">
                    <label for="remarks" class="block text-xs font-medium text-gray-700"> Remarks </label>

                    <input wire:model='remarks' type="text" id="remarks" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('remarks') <small class="text-rose-600">{{ $message }}</small> @enderror

                </div>

                <div class="flex justify-end col-span-full">
                    <button type="submit" class="btn btn-sm btn-solid-primary"> Create Report </button>
                </div>
            </form>
        </div>
    </x-modal>

    <x-modal maxWidth="md" name="download-report" :show="false">
        <div class="p-6">
            <div>
                <h1 class="font-medium">Download Report</h1>
            </div>

            <form wire:submit='download' class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                <div class="flex flex-col mt-3">
                    <label class="text-sm">Select Company</label>
                    <select wire:model='selectedCompany' class="border rounded border-black/10">
                        <option value="null" selected>List of companies</option>
                        @isset($company_select)
                        @forelse ($company_select->unique('company_name') as $index => $company )
                        <option wire:key='{{ $index }}' value="{{ $company->company_name }}">{{ $company->company_name
                            }}</option>
                        @empty
                        <option value="null" disabled>Empty list</option>
                        @endforelse
                        @endisset
                    </select>
                    @error('selectedCompany') <small class="text-rose-600">{{ $message }}</small> @enderror
                </div>

                <div class="flex flex-col mt-3">
                    <label class="text-sm">Select Supplier</label>
                    <select wire:model='selectedSupplier' class="border rounded border-black/10">
                        <option value="null" selected>List of suppliers</option>
                        @isset($supplier_select)
                        @forelse ($supplier_select->unique('supplier_name') as $index => $supplier )
                        <option wire:key='{{ $index }}' value="{{ $supplier->supplier_name }}">{{ $supplier->supplier_name
                            }}</option>
                        @empty
                        <option value="null" disabled>Empty list</option>
                        @endforelse
                        @endisset
                    </select>
                    @error('selectedSupplier') <small class="text-rose-600">{{ $message }}</small> @enderror

                </div>

                <div class="flex flex-col mt-3 col-span-full">
                    <label class="text-sm">Select Year</label>
                    <select wire:model='selectedYear' class="border rounded border-black/10">
                        <option value="null" selected>List of years</option>
                        @isset($year_select)
                        @forelse ($year_select as $index => $year )
                        <option wire:key='{{ $index }}' value="{{ $year->year }}">{{ $year->year
                            }}</option>
                        @empty
                        <option value="null" disabled>Empty list</option>
                        @endforelse
                        @endisset
                    </select>
                    @error('selectedYear') <small class="text-rose-600">{{ $message }}</small> @enderror

                </div>

                <div class="flex justify-end mt-5 col-span-full">
                    <button type="submit" class="btn btn-sm btn-outline-primary">Download</button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
