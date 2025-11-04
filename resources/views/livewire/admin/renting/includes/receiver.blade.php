{{-- Receiver --}}
<div class="p-6 text-gray-950">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold">Receiver / المستلم</h2>
            <small>All fields are required / جميع الحقول مطلوبة.</small>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-3 md:grid-cols-6">
        <div class="col-span-full md:col-span-2">
            <label for="receiver_name" class="block text-sm font-medium text-gray-700"> Full Name / الاسم الكامل </label>
            <input wire:model.lazy='form.receiver_name' id="receiver_name"  type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-1">
            <label for="receiver_mobile_number" class="block text-sm font-medium text-gray-700"> Mobile Number/رقم الجوال </label>
            <input  wire:model.lazy='form.receiver_mobile_number' id="receiver_mobile_number" min="0" type="number"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-1">
            <label for="receiver_national_id" class="block text-sm font-medium text-gray-700"> National ID No. / الرقم الوطني</label>
            <input wire:model.lazy='form.receiver_national_id' id="receiver_national_id"  type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-2">
            <label for="receiver_location" class="block text-sm font-medium text-gray-700"> Location / الموقع </label>
            <input wire:model.lazy='form.receiver_location' id="receiver_location"  type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

    </div>
</div>
