
{{-- App\Livewire\Admin\Renting\RequestEquipment --}}
{{-- Service --}}
<div class="p-6 text-gray-950">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold">Services Renting/ الخدمات المستأجرة</h2>
            <small>All fields are required/ جميع الحقول مطلوبة.</small>
        </div>

        <div class="flex items-center gap-2">
            <label class="text-sm font-medium text-gray-700 "> Choose method of payment: </label>

            <div class="gap-1 tabs tabs-boxed">
                <input type="radio" id="yearly" value="1" name="paymentMethod"
                    wire:model.live.debounce.500ms='form.paymentMethod' class="tab-toggle" />
                <label for="yearly" class="tab">Yearly/سنوي</label>

                <input type="radio" id="monthly" value="12" name="paymentMethod"
                    wire:model.live.debounce.500ms='form.paymentMethod' class="tab-toggle" />
                <label for="monthly" class="tab">Monthly/شهريا</label>

                <input type="radio" id="daily" wire:model.live.debounce.500ms='form.paymentMethod' value="365"
                    name="paymentMethod" class="tab-toggle" />
                <label for="daily" class="tab">Daily/يوميا</label>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-x-3 gap-y-5 md:grid-cols-6">


        <div class="col-span-full md:col-span-2">
            <label for="service_amount" class="block text-sm font-medium text-gray-700"> Amount (SAR)/ المبلغ (ريال
                سعودي) </label>
            <input {{ isset($form->paymentMethod) ? '' : 'disabled' }} min="0" step="0.01"
                wire:model.live.blur='form.service_amount' id="service_amount" required type="number"
                class="w-full border-gray-300 rounded-md shadow-sm disabled:bg-slate-300 focus:border-teal-950 focus:ring-teal-950">
            <small class="italic {{ isset($form->paymentMethod) ? ' hidden' : 'block' }} text-rose-500">Choose payment
                method
                first</small>
        </div>

        <div class="col-span-full md:col-span-2">
            @if ($form->paymentMethod == '1')
                <label for="total_service_amount" class="block text-sm font-medium text-gray-700"> Total amount per year
                    (SAR)/ إجمالي المبلغ السنوي (ريال سعودي)</label>
            @elseif($form->paymentMethod == '12')
                <label for="total_service_amount" class="block text-sm font-medium text-gray-700"> Total amount per month
                    (SAR)/ إجمالي المبلغ الشهري (ريال سعودي)</label>
            @elseif($form->paymentMethod == '365')
                <label for="total_service_amount" class="block text-sm font-medium text-gray-700"> Total amount daily
                    (SAR)/ إجمالي المبلغ اليومي (ريال سعودي)</label>
            @endif

            <input readonly {{ isset($form->paymentMethod) ? '' : 'disabled' }} min="0" step="0.01"
                id="total_service_amount" wire:model='form.total_service_amount' required type="number"
                class="w-full border-gray-300 rounded-md shadow-sm disabled:bg-slate-300 focus:border-teal-950 focus:ring-teal-950">
            <small class="italic {{ isset($form->paymentMethod) ? ' hidden' : 'block' }} text-rose-500">Choose payment
                method
                first</small>
        </div>

        <div class="col-span-full md:col-span-2">
            <label for="advance_payment" class="block text-sm font-medium text-gray-700"> Advance Payment (SAR)/ الدفعة
                المقدمة (ريال سعودي) </label>
            <input wire:model.lazy='form.advance_payment' id="advance_payment" min="0" required type="number"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-2">
            <label for="advance_payment" class="block text-sm font-medium text-gray-700"> Terms Of Payment / شروط الدفع  </label>
            <input wire:model.lazy='form.payment_term' id="payment_term" min="0" required type="number"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        <div class="col-span-full md:col-span-1">
            <label class="block text-sm font-medium text-gray-700"> Transportation/تفاصيل النقل </label>
            <div class="gap-1 tabs tabs-boxed">
                <input wire:model.lazy='form.transportation_details' type="radio" id="Tenant" value="Tenant"
                    name="transportation_details" class="tab-toggle" checked />
                <label for="Tenant" class="tab">Tenant</label>

                <input wire:model.lazy='form.transportation_details' type="radio" id="Lessor" value="Lessor"
                    name="transportation_details" class="tab-toggle" />
                <label for="Lessor" class="tab">The Lessor</label>
            </div>
        </div>

        <div class="col-span-full md:col-span-1">
            <label class="block text-sm font-medium text-gray-700"> TUV Certificate/شهادة TUV </label>
            <div class="gap-1 tabs tabs-boxed">
                <input wire:model.lazy='form.tuv_certificate' type="radio" id="tuv_tenant" value="Tenant"
                    name="tuv_certificate" class="tab-toggle" checked />
                <label for="tuv_tenant" class="tab">Tenant</label>

                <input wire:model.lazy='form.tuv_certificate' type="radio" id="tuv_lessor" value="Lessor"
                    name="tuv_certificate" class="tab-toggle" />
                <label for="tuv_lessor" class="tab">The Lessor</label>
            </div>
        </div>

        <div class="col-span-full md:col-span-1">
            <label class="block text-sm font-medium text-gray-700"> SASO Certificate/شهادة SASO </label>
            <div class="gap-1 tabs tabs-boxed">
                <input wire:model.lazy='form.saso_certificate' type="radio" id="saso_certificate_yes"
                    value="1" name="saso_certificate" class="tab-toggle" checked />
                <label for="saso_certificate_yes" class="tab">Yes</label>

                <input wire:model.lazy='form.saso_certificate' type="radio" id="saso_certificate_no"
                    value="0" name="saso_certificate" class="tab-toggle" />
                <label for="saso_certificate_no" class="tab">No</label>
            </div>
        </div>

        <div class="col-span-full md:col-span-1">
            <label class="block text-sm font-medium text-gray-700"> Other Certificates/شهادات أخرى </label>
            <div class="gap-1 tabs tabs-boxed">
                <input wire:model.lazy='form.other_certificate' type="radio" id="other_certificate_yes"
                    value="1" name="other_certificate" class="tab-toggle" checked />
                <label for="other_certificate_yes" class="tab">Yes</label>

                <input wire:model.lazy='form.other_certificate' type="radio" id="other_certificate_no"
                    value="0" name="other_certificate" class="tab-toggle" />
                <label for="other_certificate_no" class="tab">No</label>
            </div>
        </div>


        <div class="col-span-full md:col-span-1">
            <label class="block text-sm font-medium text-gray-700"> With Driver/مع سائق </label>
            <div class="gap-1 tabs tabs-boxed">
                <input wire:model.lazy='form.driver' type="radio" id="without_driver" value="0"
                    name="driver" class=" tab-toggle" checked />
                <label for="without_driver" class="tab">No</label>

                <input wire:model.lazy='form.driver' type="radio" id="with_driver" value="1" name="driver"
                    class="tab-toggle" />
                <label for="with_driver" class="tab">Yes</label>
            </div>
        </div>

        <div class="col-span-full md:col-span-1">
            <label for="number_units" class="block text-sm font-medium text-gray-700"> Number of units </label>
            <input wire:model.lazy='form.number_units' id="number_units" min="0" required type="number"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-teal-950 focus:ring-teal-950">
        </div>

        @if (!$isEdit)
            <div class="col-span-full md:col-span-2">
                <label for="upload_image" class="block text-sm font-medium text-gray-700"> Upload an image/تحميل صورة
                </label>
                <input multiple wire:model.lazy='form.imgInputs' accept='image/*' id="upload_image" type="file"
                    class="shadow-sm input-file input-file-primary" />
            </div>

            <div class="col-span-full md:col-span-2">
                <label for="upload_file" class="block text-sm font-medium text-gray-700"> Upload a file/تحميل ملف
                </label>
                <input multiple accept=".txt, .docx, .pdf" wire:model.lazy='form.fileInputs' id="upload_file"
                    type="file" class="shadow-sm input-file input-file-primary" />
            </div>
        @endif
    </div>
</div>
