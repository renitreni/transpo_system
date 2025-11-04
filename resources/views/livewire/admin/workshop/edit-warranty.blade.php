@php
    $titleStyle = 'text-2xl font-bold text-black/80';
    $inputStyle = 'border w-full rounded-md shadow border-black/10';
    $inputContainerStyle = 'flex flex-col text-sm';
    $formStyle = 'grid w-full grid-cols-2 gap-x-3 mt-6 gap-y-4';
    $boxStyle = ' p-5 border rounded-xl border-black/10';
    $headerStyle = 'text-xl font-bold';
    $selectStyle = '';
@endphp

<div class="py-4">
    <div>
        <h1 class="{{ $titleStyle }}">Edit Report</h1>
        <small>Fill up all fields.</small>
    </div>
    @include('success.success')
    <form enctype="multipart/form-data" wire:submit.prevent='save_edit' class="{{ $formStyle }}">

        {{-- Customer Information --}}
        <div class="{{ $boxStyle }}">
            <h1 class="{{ $headerStyle }}">Customer</h1>
            <div class="flex flex-wrap gap-3 mt-5">
                <div class="flex items-center gap-2">
                    <div class="{{ $inputContainerStyle }}">
                        <label>Name</label>
                        <input wire:model='form.Name' required class="{{ $inputStyle }}" type="text">
                    </div>
                    <div class="{{ $inputContainerStyle }}">
                        <label>Phone Number</label>
                        <input wire:model='form.PhoneNumber' required class="{{ $inputStyle }}" type="number">
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
                            <option @if ($form->Brand == 'CAMAC') selected @endif value="CAMAC">CAMAC</option>
                            <option @if ($form->Brand == 'ENSIGN') selected @endif value="ENSIGN">ENSIGN</option>
                            <option @if ($form->Brand == 'SULTANALFOUZANCO') selected @endif value="SULTANALFOUZANCO">
                                SULTANALFOUZANCO</option>
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
            <h1 class="{{ $headerStyle }}">Warranty</h1>
            <div class="grid grid-cols-5 mt-5 gap-x-2">
                <div class="{{ $inputContainerStyle }}">
                    <label>Approve By</label>
                    <select wire:model='form.ApprovedBy' class="{{ $selectStyle }} {{ $inputStyle }}">
                        <option selected value="">Select</option>
                        <option @if ($form->ApprovedBy == 'ENSIGN') selected @endif value="ENSIGN">ENSIGN</option>
                        <option @if ($form->ApprovedBy == 'CAMAC') selected @endif value="CAMAC">CAMAC</option>
                        {{-- <option @if ($form->ApprovedBy == 'SULTANALFOUZANCO') selected @endif value="SULTANALFOUZANCO">SULTANALFOUZANCO</option> --}}
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
                        <input @if ($form->Status) checked @endif wire:model.live='form.Status'
                            type="checkbox" class="border-black/30 switch switch-ghost-primary" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Report --}}
        <div class="{{ $boxStyle }} col-span-full">
            <h1 class="{{ $headerStyle }} mb-3">Report</h1>
            <div class="grid grid-cols-7 gap-2">
                @forelse ($files as $file)
                    @if (file_exists(public_path('storage/uploads/images/' . $file->FileName)))
                        @php
                            $imgVid = explode('.', $file->FileName);
                        @endphp
                        @if ($imgVid[1] !== 'mp4')
                            <div wire:key='{{ $file->id }}' class="relative">
                                <button wire:confirm='Delete image?' wire:click="delete_file({{ $file->id }})"
                                    type="button"
                                    class="absolute right-0 z-10 -top-3 hover:badge-error badge badge-flat-error">Delete</button>
                                <a class="flex items-center gap-2 "
                                    href="{{ asset('storage/uploads/images/' . $file->FileName) }}" download>
                                    <img class="w-full h-full rounded"
                                        src="{{ asset('storage/uploads/images/' . $file->FileName) }}"
                                        alt="{{ $file->FileName }}">
                                </a>
                            </div>
                        @else
                            <div wire:key='{{ $file->id }}' class="relative">
                                <button wire:confirm='Delete video?' wire:click="delete_file({{ $file->id }})"
                                    type="button"
                                    class="absolute right-0 z-10 -top-3 hover:badge-error badge badge-flat-error">Delete</button>
                                <div class="flex items-center gap-2 h-36 ">
                                    <video controls class="w-full h-full rounded"
                                        src="{{ asset('storage/uploads/images/' . $file->FileName) }}"></video>
                                </div>
                            </div>
                        @endif
                    @endif
                @empty
                    <span>No Upload Files</span>
                @endforelse
            </div>
            <div class="divider"></div>
            <div class="flex flex-wrap gap-2">
                @forelse ($files as $file)
                    @if (file_exists(public_path('storage/uploads/files/' . $file->FileName)))
                        <div wire:key='{{ $file->id }}' class="relative">
                            <button wire:confirm='Delete file?' wire:click="delete_file({{ $file->id }})"
                                type="button"
                                class="absolute right-0 z-10 -top-5 hover:badge-error badge badge-flat-error">Delete</button>
                            <a class="flex items-center gap-2 text-sm"
                                href="{{ asset('storage/uploads/files/' . $file->FileName) }}" download>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-rose-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                <span>{{ $file->FileName }}</span>
                            </a>
                        </div>
                    @endif
                @empty
                    <span>No Upload Files</span>
                @endforelse
            </div>
            <div class="divider"></div>

            <div class="flex items-center gap-4 mt-6 text-sm">
                <div class="flex flex-col">
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
                </div>
                <div class="flex flex-col">
                    <label>Upload Files</label>
                    <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false"
                        x-on:livewire-upload-cancel="uploading = false" x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                        <input wire:model='form.File' accept=".pdf,.doc,.docx,.txt" type="file"
                            class="input-file" /> <!-- Progress Bar -->
                        <div x-show="uploading" class="mt-2">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                </div>
            </div>
            <textarea wire:model='form.Report' required placeholder="Type something..."
                class="w-full mt-2 rounded-lg shadow border-black/10" rows="5"></textarea>
        </div>


        <div class="flex justify-end col-span-full gap-x-2">
            <button type="button" onclick="window.location.href='/admin/en/warranty/@manage'"
                class="btn hover:bg-slate-300">Cancel
            </button>
            <button {{ $supplier ? '' : 'disabled' }} type="button"
                onclick="window.location.href='{{ route('admin_EditSupplier', ['lang' => 'en', 'id' => $warranty_id]) }}'"
                class="btn bg-slate-300 hover:bg-slate-500 hover:text-white">{{ $supplier ? 'Edit Other Details' : 'No other details' }}
            </button>
            <button wire:target='save_edit' wire:loading.attr="disabled" type="submit"
                class="text-white bg-blue-500 disabled:cursor-not-allowed disabled:pointer-events-none disabled:bg-slate-200 btn">
                <span wire:target='save_edit' wire:loading.remove>Save Changes</span>
                <span wire:target='save_edit' wire:loading>Loading...</span>
            </button>
        </div>
    </form>

</div>
