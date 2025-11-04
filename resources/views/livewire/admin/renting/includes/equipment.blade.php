{{-- Service --}}
<div class="p-6 text-gray-950">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold">Equipment Details/تفاصيل المعدات</h2>
            <small>All fields are required/جميع الحقول مطلوبة.</small>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-x-3 gap-y-5 md:grid-cols-6">

        <div class="col-span-full md:col-span-1">
            <label for="truck_brand" class="block text-sm font-medium text-gray-700"> Truck/الشاحنة </label>
            <select wire:model.lazy='form.truck_brand' required id="truck_brand"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                <option selected value="">Select Brand</option>
                <option value="CAMC">Camc</option>
                <option value="ENSIGN">Ensign</option>
            </select>
        </div>

        <div class="col-span-full md:col-span-2">
            <label for="truck_model" class="block text-sm font-medium text-gray-700"> Model/النموذج </label>
            <input wire:model.lazy='form.truck_model' id="truck_model" required type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-1">
            <label for="truck_size" class="block text-sm font-medium text-gray-700"> Size/الحجم (Height)</label>
            <input wire:model.lazy='form.truck_size' min="0" id="truck_size" required type="number"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-1">
            <label for="truck_vin" class="block text-sm font-medium text-gray-700"> VIN/رقم الهيكل </label>
            <input wire:model.lazy='form.truck_vin' id="truck_vin" min="0" required type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-1">
            <label for="plate_number" class="block text-sm font-medium text-gray-700"> Plate Number/رقم اللوحة </label>
            <input wire:model.lazy='form.plate_number' id="plate_number" required type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>


        <div class="col-span-full md:col-span-2">
            <label for="insurance" class="block text-sm font-medium text-gray-700"> Insurance/التأمين </label>
            <input wire:model.lazy='form.insurance' id="insurance" required type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-2">
            <label for="operator_name" class="block text-sm font-medium text-gray-700"> Operator Name/اسم المشغل
            </label>
            <input wire:model.lazy='form.operator_name' id="operator_name" required type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-2">
            <label for="current_location" class="block text-sm font-medium text-gray-700"> Current Location/الموقع
                الحالي </label>
            <input wire:model.lazy='form.current_location' id="current_location" required type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

    </div>
</div>
