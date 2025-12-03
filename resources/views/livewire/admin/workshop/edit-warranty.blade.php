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
    <form enctype="multipart/form-data" wire:submit.prevent='saveEdit' class="{{ $formStyle }}">

        {{-- Customer Information --}}
        <div class="{{ $boxStyle }}">
            <h1 class="{{ $headerStyle }}">Customer</h1>
            <div class="flex flex-wrap gap-3 mt-5">
                <div class="flex items-center gap-2">
                    <div class="{{ $inputContainerStyle }}">
                        <label>Name</label>
                        <input wire:model='name' required class="{{ $inputStyle }}" type="text">
                    </div>
                    <div class="{{ $inputContainerStyle }}">
                        <label>Phone Number</label>
                        <input wire:model='phoneNumber' required class="{{ $inputStyle }}" type="number">
                    </div>
                </div>
                <div class="{{ $inputContainerStyle }} grow">
                    <label>Company</label>
                    <input wire:model='company' required class="{{ $inputStyle }}" type="text">
                </div>

                <div class="{{ $inputContainerStyle }} grow">
                    <label>Location</label>
                    <input wire:model='location' required class="{{ $inputStyle }}" type="text">
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
                        <select wire:model='brand' class="{{ $selectStyle }} {{ $inputStyle }}">
                            <option selected value="">Select</option>
                            <option @if ($brand == 'CAMAC') selected @endif value="CAMAC">CAMAC</option>
                            <option @if ($brand == 'FAW') selected @endif value="FAW">FAW</option>
                            <option @if ($brand == 'alesnaad') selected @endif value="alesnaad">
                                alesnaad</option>
                        </select>
                    </div>
                    <div class="{{ $inputContainerStyle }} col-span-2">
                        <label>Model</label>
                        <input wire:model='model' required class="{{ $inputStyle }}" type="text">
                    </div>
                    <div class="{{ $inputContainerStyle }}">
                        <label>Body Type</label>
                        <select wire:model='bodyType' class="{{ $selectStyle }} {{ $inputStyle }}">
                            <option selected value="">Select</option>
                            @foreach (\App\Enums\TruckBodyTypeEnum::cases() as $case)
                                <option @if ($bodyType == $case->value) selected @endif value="{{ $case->value }}">
                                    {{ $case->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 grow">
                    <div class="{{ $inputContainerStyle }} col-span-2 ">
                        <label>VIN ( ID-NO.)</label>
                        <input wire:model='vinId' required class="{{ $inputStyle }}" type="text">
                    </div>

                    <div class="{{ $inputContainerStyle }} ">
                        <label>First Odometer</label>
                        <input wire:model='firstTimeMaintenance' required class="{{ $inputStyle }}" type="number"
                            step="0.01" placeholder="0.00">
                    </div>
                </div>

                <div class="flex gap-2 grow">
                    <div class="{{ $inputContainerStyle }} ">
                        <label>Plate Number</label>
                        <input wire:model='plateNumber' required class="{{ $inputStyle }}" type="text">
                    </div>

                    <div class="{{ $inputContainerStyle }} ">
                        <label>Color</label>
                        <input wire:model='color' required class="{{ $inputStyle }}" type="text">
                    </div>

                    <div class="{{ $inputContainerStyle }} ">
                        <label>Kilometers</label>
                        <input wire:model.live='odometer' required class="{{ $inputStyle }}" type="number">
                        @if ($this->nextKilometer)
                            <small class="text-xs text-gray-500 mt-1">
                                Next Kilometer for Change Oil: {{ number_format($this->nextKilometer) }}
                            </small>
                        @endif
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
                    <select wire:model='approvedBy' class="{{ $selectStyle }} {{ $inputStyle }}">
                        <option selected value="">Select</option>
                        <option @if ($approvedBy == 'FAW') selected @endif value="FAW">FAW</option>
                        <option @if ($approvedBy == 'CAMAC') selected @endif value="CAMAC">CAMAC</option>
                        {{-- <option @if ($approvedBy == 'alesnaad') selected @endif value="alesnaad">alesnaad</option> --}}
                    </select>
                </div>

                <div class="{{ $inputContainerStyle }}">
                    <label>Date Approved</label>
                    <input wire:model='dateApproved' required class="{{ $inputStyle }}" type="date">
                </div>

                <div class="{{ $inputContainerStyle }} col-span-2">
                    <label>Destination</label>
                    <input wire:model='destination' required class="{{ $inputStyle }}" type="text">
                </div>

                <div class="{{ $inputContainerStyle }}">
                    <label>Status</label>
                    <div
                        class="flex items-center justify-between p-2.5 border border-black/10 bg-white rounded-md shadow">
                        <span>{{ $status ? 'Working' : 'Need Repair' }}</span>
                        <input @if ($status) checked @endif wire:model.live='status' type="checkbox"
                            class="border-black/30 switch switch-ghost-primary" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Report --}}
        <div class="{{ $boxStyle }} col-span-full">
            <h1 class="{{ $headerStyle }} mb-3">Report</h1>
            <div class="grid grid-cols-7 gap-2">
                @php
                    $hasImages = false;
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'];
                    $videoExtensions = ['mp4', 'mov', 'avi', 'webm', 'mkv'];
                @endphp
                @forelse ($files as $file)
                    @php
                        $extension = strtolower(pathinfo($file['FileName'], PATHINFO_EXTENSION));
                        $isImage = in_array($extension, $imageExtensions);
                        $isVideo = in_array($extension, $videoExtensions);
                        $isMedia = $isImage || $isVideo;

                        // Check in images directory for media files
                        if ($isMedia) {
                            $filePath = storage_path('app/public/uploads/images/' . $file['FileName']);
                        } else {
                            $filePath = storage_path('app/public/uploads/files/' . $file['FileName']);
                        }
                        $fileExists = file_exists($filePath);
                    @endphp

                    @if ($isMedia && $fileExists)
                        @php $hasImages = true; @endphp
                        @if ($isImage)
                            <div wire:key='{{ $file['id'] }}' class="relative">
                                <button wire:confirm='Delete image?' wire:click="deleteFile({{ $file['id'] }})"
                                    type="button"
                                    class="absolute right-0 z-10 -top-3 hover:badge-error badge badge-flat-error">Delete</button>
                                <a class="flex items-center gap-2 "
                                    href="{{ asset('storage/uploads/images/' . $file['FileName']) }}" download>
                                    <img class="w-full h-full rounded"
                                        src="{{ asset('storage/uploads/images/' . $file['FileName']) }}"
                                        alt="{{ $file['FileName'] }}">
                                </a>
                            </div>
                        @elseif ($isVideo)
                            <div wire:key='{{ $file['id'] }}' class="relative">
                                <button wire:confirm='Delete video?' wire:click="deleteFile({{ $file['id'] }})"
                                    type="button"
                                    class="absolute right-0 z-10 -top-3 hover:badge-error badge badge-flat-error">Delete</button>
                                <div class="flex items-center gap-2 h-36 ">
                                    <video controls class="w-full h-full rounded"
                                        src="{{ asset('storage/uploads/images/' . $file['FileName']) }}"></video>
                                </div>
                            </div>
                        @endif
                    @endif
                @empty
                @endforelse
                @if (!$hasImages && count($files) == 0)
                    <span>No Upload Files</span>
                @endif
            </div>
            <div class="divider"></div>
            <div class="flex flex-wrap gap-2">
                @php
                    $hasDocuments = false;
                    $documentExtensions = ['pdf', 'doc', 'docx', 'txt', 'xls', 'xlsx', 'csv'];
                @endphp
                @forelse ($files as $file)
                    @php
                        $extension = strtolower(pathinfo($file['FileName'], PATHINFO_EXTENSION));
                        $isDocument = in_array($extension, $documentExtensions);

                        // Check in files directory for documents
                        if ($isDocument) {
                            $filePath = storage_path('app/public/uploads/files/' . $file['FileName']);
                            $fileExists = file_exists($filePath);
                        } else {
                            $fileExists = false;
                        }
                    @endphp

                    @if ($isDocument && $fileExists)
                        @php $hasDocuments = true; @endphp
                        <div wire:key='{{ $file['id'] }}' class="relative">
                            <button wire:confirm='Delete file?' wire:click="deleteFile({{ $file['id'] }})"
                                type="button"
                                class="absolute right-0 z-10 -top-5 hover:badge-error badge badge-flat-error">Delete</button>
                            <a class="flex items-center gap-2 text-sm"
                                href="{{ asset('storage/uploads/files/' . $file['FileName']) }}" download>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-rose-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                <span>{{ $file['FileName'] }}</span>
                            </a>
                        </div>
                    @endif
                @empty
                @endforelse
                @if (!$hasDocuments && count($files) == 0)
                    <span>No Upload Files</span>
                @endif
            </div>
            <div class="divider"></div>

            <div class="flex items-center gap-4 mt-6 text-sm">
                <div class="flex flex-col flex-1">
                    <label>Upload Images</label>
                    <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false"
                        x-on:livewire-upload-cancel="uploading = false" x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <input wire:model='images' accept=".jpg,.jpeg,.png,.gif" type="file" multiple
                            class="input-file" />
                        <!-- Progress Bar -->
                        <div x-show="uploading" class="mt-2">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    @if (!empty($images))
                        <div class="mt-2 text-xs text-green-600">
                            <span class="font-semibold">{{ count($images) }} file(s) selected:</span>
                            @foreach ($images as $image)
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

                        <input wire:model='file' accept=".pdf,.doc,.docx,.txt" type="file" class="input-file" />
                        <!-- Progress Bar -->
                        <div x-show="uploading" class="mt-2">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                </div>
            </div>
            <textarea wire:model='report' required placeholder="Type something..."
                class="w-full mt-2 rounded-lg shadow border-black/10" rows="5"></textarea>
        </div>


        <div class="flex justify-end col-span-full gap-x-2">
            <button type="button" onclick="window.location.href='/admin/en/warranty/@manage'"
                class="btn hover:bg-slate-300">Cancel
            </button>
            <button {{ $supplier ? '' : 'disabled' }} type="button"
                onclick="window.location.href='{{ route('admin_EditSupplier', ['lang' => 'en', 'id' => $warrantyId]) }}'"
                class="btn bg-slate-300 hover:bg-slate-500 hover:text-white">{{ $supplier ? 'Edit Other Details' : 'No other details' }}
            </button>
            <button wire:target='saveEdit' wire:loading.attr="disabled" type="submit"
                class="text-white bg-blue-500 disabled:cursor-not-allowed disabled:pointer-events-none disabled:bg-slate-200 btn">
                <span wire:target='saveEdit' wire:loading.remove>Save Changes</span>
                <span wire:target='saveEdit' wire:loading>Loading...</span>
            </button>
        </div>
    </form>

</div>
