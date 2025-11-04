{{-- Client --}}
<div class="p-6 text-gray-950">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold">Client/العميل</h2>
            <small>All fields are required / جميع الحقول مطلوبة.</small>
        </div>
        <div>
            <input wire:model.lazy='form.purchase_number' id="purchase_number" placeholder="Purchased No./رقم طلب الشراء" required type="text"
                class="w-full border-gray-300 rounded-md shadow-sm placeholder:text-sm focus:border-teal-950 focus:ring-teal-950">
        </div>
    </div>
    <div class="grid grid-cols-3 gap-3 md:grid-cols-6">
        <div class="col-span-full md:col-span-2">
            <label for="company_name" class="block text-sm font-medium text-gray-700"> Company Name/اسم الشركة </label>
            <input wire:model.lazy='form.company_name' id="company_name" required type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-1">
            <label for="company_cr" class="block text-sm font-medium text-gray-700"> C.R Number/رقم السجل التجاري </label>
            <input wire:model.lazy='form.company_cr' id="company_cr" min="0" required type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-2">
            <label for="contact_person" class="block text-sm font-medium text-gray-700"> Contact Person/الشخص المسؤول </label>
            <input wire:model.lazy='form.contact_person' id="contact_person" required type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-1">
            <label for="mobile_number" class="block text-sm font-medium text-gray-700"> Mobile Number/رقم الجوال </label>
            <input  wire:model.lazy='form.mobile_number' id="mobile_number" min="0" required type="number"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-2">
            <label for="contact_email" class="block text-sm font-medium text-gray-700"> Email Address/البريد الإلكتروني </label>
            <input wire:model.lazy='form.contact_email' id="contact_email" required type="email"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>


        <div class="col-span-full md:col-span-2">
            <label for="national_address" class="block text-sm font-medium text-gray-700"> National Address/العنوان الوطني </label>
            <input wire:model.lazy='form.national_address' id="national_address" required type="text"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-1">
            <label for="note" class="block text-sm font-medium text-gray-700"> Note/ملاحظة </label>
            <select wire:model.lazy='form.note'  required id="note"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
                <option value="" selected>Select a note</option>
                <option value="Quotation">Quotation</option>
                <option value="Purchase Order">Purchase Order</option>
                <option value="Delivery Note">Delivery Note</option>
                <option value="Request Order">Request Order</option>
                <option value="Advance Payment Note">Advance Payment Note</option>
            </select>
        </div>

        <div class="col-span-full md:col-span-1">
            <label for="entry_date" class="block text-sm font-medium text-gray-700"> Entry Date/تاريخ الدخول </label>
            <input wire:model.lazy='form.entry_date'  id="entry_date" required type="date"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>
    </div>
</div>
