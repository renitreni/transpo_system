<section class="w-full pb-7">
    <h1 class="text-2xl font-bold">Edit Client Purchase</h1>

    @include('success.success')
    <form wire:submit.prevent='UpdateRecord' class="grid grid-cols-4 mt-14 gap-7">
        <div class="col-span-3 rounded-md shadow-sm">
            <div class="p-4  rounded relative before:absolute before:left-0 before:w-full before:h-1 before:content=[''] before:top-0 before:rounded-full before:bg-blue-500">
                <h1 class="text-lg font-medium">Client Information / معلومات العميل</h1>
            </div>
            <div class="grid grid-cols-4 gap-3 p-4">
                <div class="flex flex-col justify-center">
                    <label class="text-sm">Plate No / رقم اللوحة</label>
                    <input wire:model='PlateNo' autocomplete="off" type="text" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('PlateNo') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div>

                <div class="flex flex-col justify-center">
                    <label class="text-sm">Contact Number / رقم الاتصال</label>
                    <input wire:model='PhoneNumber' autocomplete="off" type="text" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('PhoneNumber') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div>

                <div class="flex flex-col justify-center">
                    <label class="text-sm">Company Name / اسم الشركة</label>
                    <input wire:model='CompanyName' autocomplete="off" type="text" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('CompanyName') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div>


                <div class="flex flex-col justify-center">
                    <label class="text-sm">Office Address/عنوان المكتب</label>
                    <input wire:model='OfficeAddress' autocomplete="off" type="text" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('OfficeAddress') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div>


                <div class="flex flex-col justify-center col-span-4">
                    <label class="text-sm">Other location / موقع آخر ( Optional )</label>
                    <input wire:model='OtherLocation' autocomplete="off" type="text" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('OtherLocation') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div>

                <div class="flex flex-col justify-center">
                    <label class="text-sm">Driver Name / اسم السائق</label>
                    <input wire:model='driver_name' autocomplete="off" type="text" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('driver_name') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div>

                <div class="flex flex-col justify-center">
                    <label class="text-sm">Car Insurance Company / شركة تأمين السيارات</label>
                    <input wire:model='car_insurance_company' autocomplete="off" type="text" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('car_insurance_company') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div>


                <div class="flex flex-col justify-center">
                    <label class="text-sm">Date of Insurance Entry / تاريخ دخول التأمين</label>
                    <input wire:model='date_of_insurance_entry' autocomplete="off" type="date" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('date_of_insurance_entry') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div>
                <div class="flex flex-col justify-center">
                    <label class="text-sm">Insurance Expiry Date / تاريخ انتهاء التأمين</label>
                    <input wire:model='insurance_expiry_date' autocomplete="off" type="date" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('insurance_expiry_date') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div>

                <div class="flex flex-col justify-center">
                    <label class="text-sm">Driver License Number / رقم رخصة القيادة</label>
                    <input wire:model='driver_license_number' autocomplete="off" type="text" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('driver_license_number') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div>

                <div class="flex flex-col justify-center">
                    <label class="text-sm">License Expiry Date / تاريخ انتهاء الرخصة</label>
                    <input wire:model='driver_license_expiry_date' autocomplete="off" type="date" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('driver_license_expiry_date') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div>

                <div class="flex flex-col justify-center">
                    <label class="text-sm">Resident/Iqama Number / رقم المقيم أو رقم الإقامة</label>
                    <input wire:model='resident_iqama_number' autocomplete="off" type="text" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('resident_iqama_number') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div>

                <div class="flex flex-col justify-center">
                    <label class="text-sm">Date of Entry Iqama Number / تاريخ دخول رقم الإقامة</label>
                    <input wire:model='date_of_entry_iqama_number' autocomplete="off" type="date"
                        class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('date_of_entry_iqama_number')
                        <span class="text-xs text-rose-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col justify-center">
                    <label class="text-sm">Validity of Iqama / صلاحية الإقامة</label>
                    <input wire:model='validity_of_iqama' autocomplete="off" type="date"
                        class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('validity_of_iqama')
                        <span class="text-xs text-rose-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col justify-center">
                    <label class="text-sm">Driver Status / حالة السائق</label>
                    <select wire:model='driver_status' class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                        <option value="">-- Select Status / اختر الحالة --</option>
                        @foreach($driverStatusOptions as $status)
                            <option value="{{ $status->value }}">{{ $status->value }}</option>
                        @endforeach
                    </select>
                    @error('driver_status') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div>


                {{-- <div class="flex flex-col justify-center">
                    <label class="text-sm">Postcode</label>
                    <input wire:model='PostCode' autocomplete="off" type="text" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                    @error('PostCode') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                </div> --}}

            </div>
        </div>

        <div class="rounded-md shadow-sm">
            <div class="p-4  rounded relative before:absolute before:left-0 before:w-full before:h-1 before:content-[''] before:top-0 before:bg-blue-500 before:rounded-full">
                <h1 class="text-lg font-medium">Purchase / شراء</h1>
            </div>

            <div class="p-4">
                <div>
                    <label class="text-sm">Purchase Date/تاريخ الشراء</label>
                    <input wire:input.live.debounce.1000ms='updateWarrantyExpirations' wire:model='OrderDate' autocomplete="off" type="date" class="w-full p-1 bg-transparent border rounded-md border-black/30 focus:outline-blue-400">
                </div>
                @error('OrderDate') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror

                {{-- <div class="mt-2">
                    <label  class="text-sm">S</label>
                    <select wire:model.defer='OrderStatus' class="text-sm rounded-md select select-ghost-primary">
                        <option value="Bank" @if($OrderStatus == false) selected @endif>Bank</option>
                        <option value="Cash" @if($OrderStatus == true) selected @endif>Cash</option>
                    </select>
                </div>
                @error('OrderStatus') <span class="text-xs text-rose-600">{{ $message }}</span>@enderror --}}



            </div>
        </div>

        {{-- Product Information --}}
        <div class="flex w-full overflow-x-auto col-span-full">
            <table class="table relative before:absolute before:h-1 before:w-full before:conten=[''] before:top-0 before:bg-blue-600 before:rounded-full">
                <thead>
                    <tr >
                        <th style="background-color: #fcfcfc;" class="w-8">
                            <button wire:click='add_product' type="button" class="w-8 p-1 text-blue-600 duration-300 appearance-none ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                  </svg>

                            </button>
                        </th>
                        <th style="background-color: #fcfcfc;">Quantity</th>
                        <th style="background-color: #fcfcfc;">Product</th>
                        <th style="background-color: #fcfcfc;">Color</th>
                        <th style="background-color: #fcfcfc;">Chassis #</th>
                        <th style="background-color: #fcfcfc;">Year Model</th>
                        <th style="background-color: #fcfcfc;">Warranty Period <br>(months)</th>
                        <th style="background-color: #fcfcfc;">Warranty Expiration</th>
                        {{-- <th>Price</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index => $product )
                    <tr wire:key='{{ $product['Product'] }}'>
                        <th>
                            <button wire:click='remove_product({{ $index }})' type="button" class="w-8 p-1 duration-300 text-rose-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                            </button>
                        </th>
                        <td ><input required wire:model='products.{{ $index }}.Quantity' type="number" min="0" class="w-full p-1 bg-transparent rounded-md border-black/30 focus:outline-blue-400"></td>
                        <td x-data="{expanded: false }" class="relative">
                            <input
                                required
                                x-on:click="expanded = true"
                                x-on:blur="expanded = false"
                                x-bind:class="expanded ? 'w-[250px] z-10 absolute shadow-lg bg-white top-2' : 'w-24'"
                                wire:model='products.{{ $index }}.Product'
                                type="text" class="p-1 bg-transparent rounded-md border-black/30 focus:outline-none">
                            </td>
                        <td ><input required wire:model='products.{{ $index }}.Color' type="text" class="w-full p-1 bg-transparent rounded-md border-black/30 focus:outline-blue-400"></td>
                        <td x-data="{expanded: false }" class="relative">
                            <input
                                required
                                x-on:click="expanded = true"
                                x-on:blur="expanded = false"
                                x-bind:class="expanded ? 'w-[250px] z-10 absolute shadow-lg bg-white top-2' : 'w-24'"
                                wire:model='products.{{ $index }}.ChassisNumber'
                                type="text" class="p-1 bg-transparent rounded-md border-black/30 focus:outline-none">
                            </td>
                        <td ><input required wire:model='products.{{ $index }}.YearModel' type="number"  placeholder="years" min="0"  class="w-full p-1 bg-transparent rounded-md border-black/30 focus:outline-blue-400"></td>
                        <td ><input required wire:input.live.debounce.1000ms='getDateViaMonths({{ $index }})' wire:model='products.{{ $index }}.WarrantyPeriod' type="number"  placeholder="months" min="0"  class="w-full p-1 bg-transparent rounded-md border-black/30 focus:outline-blue-400"></td>
                        <td ><input required wire:model='products.{{ $index }}.WarrantyExpiration' type="text" onclick="this.type='date'" onblur="this.type='text'"  class="w-full p-1.5 text-sm bg-transparent rounded-md border-black/30 focus:outline-blue-400"></td>
                        {{-- <td>
                            <div class="relative">
                                <span class="absolute top-1.5 left-2">SAR</span>
                                <input wire:input.live.debounce.1000ms='updateSubTotal({{ $index }})' wire:model='products.{{ $index }}.Price' type="number" min="0" class="w-full py-1 pl-10 rounded-md focus:outline-blue-400">
                            </div>
                        </td> --}}
                    </tr>
                    @empty
                        <tr>
                            @if (session('error'))
                                <td><span class="text-sm text-rose-500">{{ session('error') }}</span></td>
                            @else
                                <td colspan="12">No list of purchased products</td>
                            @endif
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- <div class="col-start-3 col-span-full">
            <div class="flex justify-between">
                <label class="block pb-2 text-sm font-medium text-gray-700 border-b-2"> Computation </label>
            </div>
            <div class="grid grid-cols-1 gap-1 mt-4 text-sm">
                <div class="flex items-center justify-between">
                    <label >Subtotal</label>
                    <label>SAR {{ $OrderSubtotal }}</label>
                </div>

                <div class="flex items-center justify-between">
                    <label>Tax</label>
                    <div class="relative">
                        <span class="absolute top-1.5 left-2">SAR</span>
                        <input wire:input.live.debounce.1000ms='updateTotal()' wire:model='OrderTax' type="number" min="0" class="py-1 pl-10 rounded-sm w-36 focus:outline-sky-700">
                    </div>
                </div>


                <div class="flex items-center justify-between">
                    <label>Shipping Fee</label>
                    <div class="relative">
                        <span class="absolute top-1.5 left-2">SAR</span>
                        <input wire:input.live.debounce.1000ms='updateTotal()' wire:model='OrderShippingFee' type="number" min="0" class="py-1 pl-10 rounded-sm w-36 focus:outline-sky-700">
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1 mt-2 border-t-2">
                    <label>Total</label>
                    <label>SAR {{ $OrderTotal }}</label>
                </div>
            </div>
        </div> --}}

        <div class="flex justify-end gap-3 col-span-full">
            <button type="button" onclick="window.location.href='/admin/en/delivery/@manage'" class="px-4 py-3 text-white duration-200 rounded-md bg-slate-500 hover:bg-slate-700">Cancel</button>
            <button class="px-4 py-3 font-bold duration-300 bg-blue-600 rounded-md min-w-min hover:bg-blue-800 text-slate-200" type="submit">
                <span wire:target='UpdateRecord' wire:loading.remove>Save Changes</span>
                <span wire:target='UpdateRecord' wire:loading>Loading...</span>
            </button>
        </div>
        @include('livewire.admin.delivery.includes.modal-apply-vouchers')
    </form>
</section>
