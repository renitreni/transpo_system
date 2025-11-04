<div class="w-full bg-white dark:bg-slate-800 border border-gray-600 rounded-md p-5">
    <div class="flex justify-between mb-3">
        <div>
            <span class="font-bold text-lg">Maintenance Records</span>
        </div>
        <div>
            <button x-on:click="$dispatch('open-modal','add-new-maintenance')" wire:click='resetFormFields()'
                class="btn btn-solid-primary btn-sm">
                Add New
            </button>
        </div>
    </div>
    <livewire:maintenance-table />

    <x-modal name="add-new-maintenance" :show="false" focusable>
        <div class="p-6">
            <div>
                <h1 class="text-lg font-medium">Maintenance Form</h1>
            </div>

            <form wire:submit='save' class="grid grid-cols-1 py-4 gap-x-2 gap-y-4 sm:grid-cols-12">
                <div class="col-span-6">
                    <label for="company_cr" class="block text-xs font-medium text-gray-700"> 
                        Company Name/ اسم الشركة </label>

                    <input list="company_list" wire:model.live='company_cr' type="text" id="company_cr"
                        placeholder="" class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('company_cr')
                        <small class="text-rose-600">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-span-6">
                    <label for="contact_person" class="block text-xs font-medium text-gray-700"> Contact Person / الشخص الذي يمكن الاتصال به </label>

                    <input list="contact_person" wire:model.live='contact_person' type="text" id="contact_person"
                        placeholder="" class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('contact_person')
                        <small class="text-rose-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-span-6">
                    <label for="phone_no" class="block text-xs font-medium text-gray-700"> Phone Number /  رقم التليفون </label>

                    <input list="contact_person" wire:model.live='phone_no' type="text" id="phone_no" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('phone_no')
                        <small class="text-rose-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-span-6">
                    <label for="email" class="block text-xs font-medium text-gray-700"> E-mail </label>

                    <input list="contact_person" wire:model.live='email' type="text" id="email" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('email')
                        <small class="text-rose-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-span-4">
                    <label for="brand_name" class="block text-xs font-medium text-gray-700"> Brand Name</label>

                    <select wire:model.live='brand_name' id="truck_brand"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                        <option selected value="">Select</option>
                        @foreach (\App\Enums\CarBrandsEnum::cases() as $item)
                            <option selected value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('brand_name')
                        <small class="text-rose-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-span-4">
                    <label for="vin_no" class="block text-xs font-medium text-gray-700"> VIN No. </label>

                    <input list="vin_no" wire:model.live='vin_no' type="text" id="vin_no" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('vin_no')
                        <small class="text-rose-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-span-4">
                </div>

                <div class="col-span-3">
                    <label for="kilometers" class="block text-xs font-medium text-gray-700"> Kilometers </label>

                    <input list="contact_person" wire:model.live='kilometers' type="text" id="kilometers"
                        placeholder="" class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('kilometers')
                        <small class="text-rose-600">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-span-3">
                    <label for="hour" class="block text-xs font-medium text-gray-700"> Hours </label>

                    <input list="contact_person" wire:model.live='hour' type="text" id="hour" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('hour')
                        <small class="text-rose-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-span-3">
                    <label for="warranty" class="block text-xs font-medium text-gray-700"> Warranty </label>

                    <input list="contact_person" wire:model.live='warranty' type="text" id="warranty" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('warranty')
                        <small class="text-rose-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-span-12">
                    <label for="address" class="block text-xs font-medium text-gray-700"> Address </label>

                    <input list="contact_person" wire:model.live='address' type="text" id="address"
                        placeholder="" class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('address')
                        <small class="text-rose-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-span-12">
                    <label for="others" class="block text-xs font-medium text-gray-700"> Others </label>

                    <input list="contact_person" wire:model.live='others' type="text" id="others"
                        placeholder="" class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('others')
                        <small class="text-rose-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-span-12">
                    <label for="remarks" class="block text-xs font-medium text-gray-700"> Remarks </label>

                    <input list="remarks" wire:model.live='remarks' type="text" id="remarks" placeholder=""
                        class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('vin_no')
                        <small class="text-rose-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-span-12">
                    <label for="note" class="block text-xs font-medium text-gray-700"> Note </label>

                    <input list="contact_person" wire:model.live='note' type="text" id="note"
                        placeholder="" class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
                    @error('note')
                        <small class="text-rose-600">{{ $message }}</small>
                    @enderror
                </div>
                @if (is_null($maintenance_id))
                    <div class="col-span-12 flex justify-end">
                        <button type="button" wire:click='store()' class="btn btn-solid-primary btn-sm">
                            Save
                        </button>
                    </div>
                @else
                    <div class="col-span-12 flex justify-between">
                        <button type="button" wire:click='delete()' class="btn btn-solid-danger btn-sm">
                            Delete
                        </button>

                        <button type="button" wire:click='update()' class="btn btn-solid-primary btn-sm">
                            Update
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </x-modal>
</div>
