{{-- Service --}}
<div class="p-6 text-gray-950">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold">Sales Man/مندوب المبيعات</h2>
            <small>All fields are required/جميع الحقول مطلوبة.</small>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-x-3 gap-y-5 md:grid-cols-6">


        <div class="col-span-full md:col-span-2">
            <label for="emp_name" class="block text-sm font-medium text-gray-700"> Employee Name/اسم الموظف </label>
            <input wire:model.lazy='form.emp_name' id="emp_name" required type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-1">
            <label for="emp_number" class="block text-sm font-medium text-gray-700"> Employee Number/رقم الموظف </label>
            <input wire:model.lazy='form.emp_number' id="emp_number" min="0" required type="number"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-2">
            <label for="branch" class="block text-sm font-medium text-gray-700"> Branch/الفرع </label>
            <input wire:model.lazy='form.branch'  id="branch" required type="text"
            class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">

        </div>
    </div>
</div>
