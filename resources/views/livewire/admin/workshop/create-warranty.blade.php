@php
    $titleStyle = 'text-2xl font-bold text-black/80';
    $inputStyle = 'border w-full rounded-md shadow border-black/10';
    $inputContainerStyle = 'flex flex-col text-sm';
    $formStyle = 'grid w-full grid-cols-2 gap-x-3 mt-6 gap-y-4';
    $boxStyle = ' p-5 border rounded-xl  border-black/10';
    $headerStyle = 'text-xl font-bold';
    $selectStyle = '';
@endphp

<div class="py-4">
    <div>
        <h1 class="{{ $titleStyle }}">Create Report</h1>
        <small>Fill up all fields.</small>
    </div>
    @include('success.success')
    <form enctype="multipart/form-data" wire:submit.prevent='create_report' class="{{ $formStyle }}">

        {{-- Customer Information --}}
        <div class="{{ $boxStyle }}">
            <h1 class="{{ $headerStyle }}">Dealer</h1>
            <div class="flex flex-wrap gap-3 mt-5">
                <div class="flex items-center gap-2">
                    <div class="{{ $inputContainerStyle }}">
                        <label>Name</label>
                        <input wire:model='form.Name' required class="{{ $inputStyle }}" type="text">
                    </div>
                    <div class="{{ $inputContainerStyle }}">
                        <label>Phone Number</label>
                        <input type="number" wire:model='form.PhoneNumber' required class="{{ $inputStyle }}">
                    </div>
                </div>
                <div class="{{ $inputContainerStyle }} grow">
                    <label>Company</label>
                    <input wire:model='form.Company' required class="{{ $inputStyle }}" type="text">
                </div>

                <div class="{{ $inputContainerStyle }} grow">
                    <label>Location</label>
                    <input wire:model='form.Location' required class="{{ $inputStyle }}" type="text">
                </div>
            </div>
        </div>

        {{-- Truck Information --}}
        <div class="{{ $boxStyle }}">
            <h1 class="{{ $headerStyle }}">Truck</h1>
            <div class="flex flex-wrap gap-3 mt-5">

                <div class="flex items-center gap-2">
                    <div class="{{ $inputContainerStyle }}">
                        <label>Brand</label>
                        <select wire:model='form.Brand' class="{{ $selectStyle }} {{ $inputStyle }}">
                            <option selected value="">Select</option>
                            <option value="ENSIGN">ENSIGN</option>
                            <option value="CAMC">CAMC</option>
                            <option value="alesnaad">alesnaad</option>
                        </select>
                    </div>
                    <div class="{{ $inputContainerStyle }} col-span-2">
                        <label>Model</label>
                        <input wire:model='form.Model' required class="{{ $inputStyle }}" type="text">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 grow">
                    <div class="{{ $inputContainerStyle }} col-span-2 ">
                        <label>VIN ( ID-NO.)</label>
                        <input wire:model='form.VIN_ID' required class="{{ $inputStyle }}" type="text">
                    </div>

                    <div class="{{ $inputContainerStyle }} ">
                        <label>Hours</label>
                        <input wire:model='form.Hours' required class="{{ $inputStyle }}" type="number">
                    </div>


                </div>

                <div class="flex gap-2 grow">
                    <div class="{{ $inputContainerStyle }} ">
                        <label>Plate Number</label>
                        <input wire:model='form.PlateNumber' required class="{{ $inputStyle }}" type="text">
                    </div>

                    <div class="{{ $inputContainerStyle }} ">
                        <label>Color</label>
                        <input wire:model='form.Color' required class="{{ $inputStyle }}" type="text">
                    </div>

                    <div class="{{ $inputContainerStyle }} ">
                        <label>Kilometers</label>
                        <input wire:model='form.Odometer' required class="{{ $inputStyle }}" type="number">
                    </div>
                </div>
            </div>
        </div>

        {{-- Warranty Information --}}
        <div class="{{ $boxStyle }} col-span-full">
            <h1 class="{{ $headerStyle }}">Request</h1>
            <div class="grid grid-cols-5 mt-5 gap-x-2">
                <div class="{{ $inputContainerStyle }}">
                    <label>Approve By</label>
                    <select wire:model='form.ApprovedBy' class="{{ $selectStyle }} {{ $inputStyle }}">
                        <option selected value="">Select</option>
                        <option value="ENSIGN">ENSIGN</option>
                        <option value="CAMC">CAMC</option>
                        {{-- <option value="alesnaad">alesnaad</option> --}}
                    </select>
                </div>

                <div class="{{ $inputContainerStyle }}">
                    <label>Date Approved</label>
                    <input wire:model='form.DateApproved' required class="{{ $inputStyle }}" type="date">
                </div>

                <div class="{{ $inputContainerStyle }} col-span-2">
                    <label>Destination</label>
                    <input wire:model='form.Destination' required class="{{ $inputStyle }}" type="text">
                </div>

                <div class="{{ $inputContainerStyle }}">
                    <label>Status</label>
                    <div
                        class="flex items-center justify-between p-2.5 border border-black/10 bg-white rounded-md shadow">
                        <span>{{ $form->Status ? 'Working' : 'Need Repair' }}</span>
                        <input wire:model.live='form.Status' type="checkbox"
                            class="border-black/30 switch switch-ghost-primary" />
                    </div>
                </div>
            </div>
        </div>


        <div class="{{ $boxStyle }} col-span-full">
            <h1 class="{{ $headerStyle }}">Report</h1>
            <div class="flex items-center gap-4 mt-6 text-sm">
                <div class="flex flex-col flex-1">
                    <label>Upload Images</label>
                    <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false"
                        x-on:livewire-upload-cancel="uploading = false" x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <input wire:model='form.Images' accept="image/*,video/*" type="file" multiple
                            class="input-file" />
                        <!-- Progress Bar -->
                        <div x-show="uploading" class="mt-2">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    @if (!empty($form->Images))
                        <div class="mt-2 text-xs text-green-600">
                            <span class="font-semibold">{{ count($form->Images) }} file(s) selected:</span>
                            @foreach ($form->Images as $image)
                                <div class="ml-2">• {{ $image->getClientOriginalName() }}</div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="flex flex-col flex-1">
                    <label>Upload Files</label>
                    <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false"
                        x-on:livewire-upload-cancel="uploading = false" x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <input wire:model='form.File' accept=".pdf,.doc,.docx,.txt" type="file" class="input-file" />
                        <!-- Progress Bar -->
                        <div x-show="uploading" class="mt-2">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    @if ($form->File)
                        <div class="mt-2 text-xs text-green-600">
                            <span class="font-semibold">File selected:</span>
                            <div class="ml-2">• {{ $form->File->getClientOriginalName() }}</div>
                        </div>
                    @endif
                </div>
            </div>
            <textarea wire:model='form.Report' required placeholder="Type something..."
                class="w-full mt-2 rounded-lg shadow border-black/10" rows="5"></textarea>
        </div>


        <div class="flex justify-end col-span-full gap-x-2">
            <button type="button"
                onclick="window.location.href='{{ route('admin_ManageWarranty', ['lang' => 'en']) }}'"
                class="btn hover:bg-slate-300">Cancel</button>
            <button wire:target='create_report' wire:loading.attr="disabled" type="submit"
                class="gap-2 text-white bg-blue-500 disabled:cursor-not-allowed disabled:pointer-events-none disabled:bg-slate-200 btn">
                <span wire:target='create_report' wire:loading.remove>Save & Next</span>
                <span wire:target='create_report' wire:loading>Loading...</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                </svg>

            </button>
        </div>
    </form>

</div>
