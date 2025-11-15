<div class="w-screen modal" id="modal-warranty" wire:ignore.self>
    <div class="flex flex-col max-w-4xl gap-5 pt-0 modal-content">
        <div class="sticky top-0 pt-3 bg-white">
            <label for="modal-warranty" onclick="closeViewWarranty()" class="absolute top-0 btn btn-sm btn-circle btn-ghost right-2">✕</label>
            <h2 class="text-xl font-bold">Warranty Details</h2>
            <div style="background: {{ $bgColor }}" class="{{ $viewData ? " text-center text-white rounded p-4 ":"
                skeleton z-50 text-transparent p-4" }}">
                <span class="font-medium">{{ $viewData->supplierStatus->Decision ?? "Pending" }}</span>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-3">
            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold">Customer</h1>
                <div class="flex flex-wrap gap-6">
                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[150px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Name</span>
                        <span class="text-base font-medium ">{{ $viewData->Name ?? "" }}</span>
                    </div>

                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[100px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Phone Number</span>
                        <span class="text-base font-medium ">{{ $viewData->PhoneNumber ?? "" }}</span>
                    </div>

                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[200px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Company</span>
                        <span class="text-base font-medium ">{{ $viewData->Company ?? "" }}</span>
                    </div>


                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[200px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Location</span>
                        <span class="text-base font-medium ">{{ $viewData->Location ?? "" }}</span>
                    </div>
                </div>
            </section>

            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold">Truck</h1>
                <div class="flex flex-wrap gap-6">
                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[100px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Brand</span>
                        <span class="text-base font-medium ">{{ $viewData->Brand ?? "" }}</span>
                    </div>

                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[200px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Model</span>
                        <span class="text-base font-medium ">{{ $viewData->Model ?? "" }}</span>
                    </div>

                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[150px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">VIN</span>
                        <span class="text-base font-medium ">{{ $viewData->VIN_ID ?? "" }}</span>
                    </div>

                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[150px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Hours</span>
                        <span class="text-base font-medium ">{{ $viewData->Hours ?? "0" }}</span>
                    </div>

                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[150px]
                    text-transparent":"flex flex-col min-w-min " }}">
                    <span class="text-xs">Kilometers</span>
                    <span class="text-base font-medium ">{{ $viewData->Odometer ?? "0" }}</span>
                </div>


                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[150px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Plate Number</span>
                        <span class="text-base font-medium ">{{ $viewData->PlateNumber ?? "" }}</span>
                    </div>

                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[150px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Color</span>
                        <span class="text-base font-medium ">{{ $viewData->Color ?? "" }}</span>
                    </div>
                </div>
            </section>

            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold">Request</h1>
                <div class="flex flex-wrap gap-6">
                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[200px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Approved By</span>
                        <span class="text-base font-medium ">{{ $viewData->ApprovedBy ?? "" }}</span>
                    </div>

                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[200px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Date of Approved</span>
                        <span class="text-base font-medium ">{{ $viewData->DateApproved ?? "" }}</span>
                    </div>

                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[200px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Destination</span>
                        <span class="text-base font-medium ">{{ $viewData->Destination ?? "" }}</span>
                    </div>


                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[200px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Status</span>
                        <span class="text-base font-medium ">{{ ($viewData && $viewData->Status ? "Working" : "Need
                            Repair") ?? "" }}</span>
                    </div>
                </div>
            </section>

            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold">Report</h1>
                <div class="flex flex-wrap gap-6">
                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton h-24 w-full
                        text-transparent":"flex flex-col w-full " }}">
                        <span class="text-xs">Uploaded Images and Videos</span>
                        <div class="flex flex-wrap gap-2 text-sm ">
                            @if ($viewData)
                            @php
                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'];
                                $videoExtensions = ['mp4', 'mov', 'avi', 'webm', 'mkv'];
                            @endphp
                            @forelse ($viewData->files as $file)
                            @php
                                $extension = strtolower(pathinfo($file->FileName, PATHINFO_EXTENSION));
                                $isImage = in_array($extension, $imageExtensions);
                                $isVideo = in_array($extension, $videoExtensions);
                                $isMedia = $isImage || $isVideo;
                                
                                if ($isMedia) {
                                    $filePath = storage_path('app/public/uploads/images/' . $file->FileName);
                                    $fileExists = file_exists($filePath);
                                } else {
                                    $fileExists = false;
                                }
                            @endphp
                            @if ($isMedia && $fileExists)
                            <a wire:key='{{ $file['id'] }}' class="flex items-center gap-2"
                                href="{{ asset('storage/uploads/images/'.$file->FileName) }}" download>
                                @if($isImage)
                                <img class="rounded w-28 h-28"
                                    src="{{ asset('storage/uploads/images/'.$file->FileName) }}"
                                    alt="{{ $file->FileName }}">
                                @elseif($isVideo)
                                <video class="w-32 rounded h-28" controls
                                    src="{{ asset('storage/uploads/images/'.$file->FileName) }}"></video>
                                @endif
                            </a>
                            @endif
                            @empty
                            <span>No Upload Files</span>
                            @endforelse
                            @endif
                        </div>
                    </div>

                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton h-10 rounded-lg w-full
                        text-transparent":"flex flex-col w-full " }}">
                        <span class="text-xs">Uploaded Files</span>
                        <div class="flex flex-wrap gap-2 text-sm ">
                            @if ($viewData)
                            @php
                                $documentExtensions = ['pdf', 'doc', 'docx', 'txt', 'xls', 'xlsx', 'csv'];
                            @endphp
                            @forelse ($viewData->files as $file)
                            @php
                                $extension = strtolower(pathinfo($file->FileName, PATHINFO_EXTENSION));
                                $isDocument = in_array($extension, $documentExtensions);
                                
                                if ($isDocument) {
                                    $filePath = storage_path('app/public/uploads/files/' . $file->FileName);
                                    $fileExists = file_exists($filePath);
                                } else {
                                    $fileExists = false;
                                }
                            @endphp
                            @if ($isDocument && $fileExists)
                            <a wire:key='{{ $file['id'] }}' class="flex items-center gap-2"
                                href="{{ asset('storage/uploads/files/'.$file->FileName) }}" download>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                <span>{{ $file->FileName }}</span>
                            </a>
                            @endif
                            @empty
                            <span>No Upload Files</span>
                            @endforelse
                            @endif
                        </div>
                    </div>

                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[200px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Date of Approved</span>
                        <span class="text-base font-medium ">{{ $viewData->DateApproved ?? "" }}</span>
                    </div>

                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[200px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Destination</span>
                        <span class="text-base font-medium ">{{ $viewData->Destination ?? "" }}</span>
                    </div>


                    <div class="{{ !isset($viewData) || empty($viewData) ? " skeleton rounded-lg w-[200px]
                        text-transparent":"flex flex-col min-w-min " }}">
                        <span class="text-xs">Status</span>
                        <span class="text-base font-medium ">{{ ($viewData && $viewData->Status ? "Working" : "Need
                            Repair") ?? "" }}</span>
                    </div>

                    <div
                        class="{{ !isset($viewData) || empty($viewData) ? 'skeleton h-32 w-full text-transparent' : 'flex flex-col w-full' }}">
                        <span class="mb-2 text-xs">Report Statement</span>
                        <textarea disabled class="w-full border rounded-md border-black/10"
                            rows="5">{{ $viewData->Report ?? "No Statement" }}</textarea>
                    </div>
                </div>
            </section>

        </div>

        <hr>

        <h2 class="text-xl font-bold">Other Details</h2>
        <div class="grid grid-cols-4 gap-3">
            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold"></h1>
                <div class="flex flex-wrap gap-6">
                    <div class="{{ $viewData ? " flex flex-col min-w-min ":" skeleton rounded-lg w-[150px]
                        text-transparent" }}">
                        <span class="text-xs">Order Number</span>
                        <span class="text-base font-medium ">{{ $viewData->supplierStatus->OrderNumber ?? "---------"
                            }}</span>
                    </div>

                    <div class="{{ $viewData ? " flex flex-col min-w-min":" skeleton rounded-lg w-[100px]
                        text-transparent " }}">
                        <span class="text-xs">Feedback Time</span>
                        <span class="text-base font-medium ">{{ $viewData->supplierStatus->FeedbackTime ?? "---------"
                            }}</span>
                    </div>

                    <div class="{{ $viewData ? " flex flex-col min-w-min":" skeleton rounded-lg w-[100px]
                        text-transparent " }}">
                        <span class="text-xs">Date of Purchased</span>
                        <span class="text-base font-medium ">{{ $viewData->supplierStatus->DateOfPurchased ?? ""
                            }}</span>
                    </div>
                </div>
            </section>

            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold">Operating Condition</h1>
                <div class="flex flex-wrap gap-6">
                    @php
                    $categories =
                    ['LooseMaterial','Dust','CoalField','Stones','Gravel','MetalOre','Plateau','TGreat','ZeroCel','TLess']
                    @endphp
                    @forelse ($categories as $type )
                    @if (isset($viewData->supplierStatus) && $viewData->supplierStatus->$type)
                    <span class="badge badge-primary">{{ $type }}</span>
                    @else
                    @endif
                    @empty
                    <small>No set of operating condition</small>
                    @endforelse
                </div>
            </section>

            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold">Failure Description</h1>
                <div class="{{ $viewData ? 'flex flex-col w-full' : 'skeleton h-32 w-full text-transparent ' }}">
                    {{-- <span class="mb-2 text-xs">Report Statement</span> --}}
                    <textarea disabled class="w-full border rounded-md border-black/10"
                        rows="5">{{ $viewData->supplierStatus->FailureDescription ?? "No Statement" }}</textarea>
                </div>
            </section>

            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold">Causes Analysis</h1>
                <div class="{{ $viewData ? 'flex flex-col w-full' : 'skeleton h-32 w-full text-transparent ' }}">
                    {{-- <span class="mb-2 text-xs">Report Statement</span> --}}
                    <textarea disabled class="w-full border rounded-md border-black/10"
                        rows="5">{{ $viewData->supplierStatus->CausesAnalysis ?? "No Statement" }}</textarea>
                </div>
            </section>

            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold">Technician</h1>
                <div class="flex flex-wrap gap-6">
                    <div class="{{ $viewData ? " flex flex-col min-w-min ":" skeleton rounded-lg w-[150px]
                        text-transparent" }}">
                        <span class="text-xs">Uploaded Signature</span>
                        @isset( $viewData->supplierStatus->SignatureTech)
                        <a download class="text-sm text-blue-500""
                            href=" {{ asset('storage/uploads/supplier/'.$viewData->supplierStatus->SignatureTech)
                            }}">{{$viewData->supplierStatus->SignatureTech}}</a>
                        @endisset
                        @empty($viewData->supplierStatus->SignatureTech)
                        <small>No upload</small>
                        @endempty
                    </div>

                    <div class="{{ $viewData ? " flex flex-col min-w-min ":" skeleton rounded-lg w-[150px]
                        text-transparent" }}">
                        <span class="text-xs">Date</span>
                        @isset( $viewData->supplierStatus->DateSignatureTech)
                        <span class="text-base font-medium ">{{ $viewData->supplierStatus->DateSignatureTech }}</span>
                        @endisset
                        @empty($viewData->supplierStatus->DateSignatureTech)
                        <small>No set date.</small>
                        @endempty
                    </div>
                </div>
            </section>

            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold">Customer</h1>
                <div class="flex flex-wrap gap-6">
                    <div class="{{ $viewData ? " flex flex-col min-w-min ":" skeleton rounded-lg w-[150px]
                        text-transparent" }}">
                        <span class="text-xs">Uploaded Signature</span>
                        @isset( $viewData->supplierStatus->SignatureCustomer)
                        <a download class="text-sm text-blue-500""
                            href=" {{ asset('storage/uploads/supplier/'.$viewData->supplierStatus->SignatureCustomer)
                            }}">{{$viewData->supplierStatus->SignatureCustomer}}</a>
                        @endisset
                        @empty($viewData->supplierStatus->SignatureCustomer)
                        <small>No upload</small>
                        @endempty
                    </div>

                    <div class="{{ $viewData ? " flex flex-col min-w-min ":" skeleton rounded-lg w-[150px]
                        text-transparent" }}">
                        <span class="text-xs">Date</span>
                        @isset( $viewData->supplierStatus->DateSignatureCustomer)
                        <span class="text-base font-medium ">{{ $viewData->supplierStatus->DateSignatureCustomer
                            }}</span>
                        @endisset
                        @empty($viewData->supplierStatus->DateSignatureCustomer)
                        <small>No set date.</small>
                        @endempty
                    </div>
                </div>
            </section>

            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold">Uploaded Files</h1>
                <div class="flex flex-wrap gap-6">
                    <div class="{{ $viewData ? " flex flex-col min-w-min ":" skeleton rounded-lg w-[150px] text-transparent" }}">
                        @isset($viewData->files)
                        @forelse ($viewData->files as $file)
                        @php
                            $extension = strtolower(pathinfo($file->FileName, PATHINFO_EXTENSION));
                            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'];
                            $subDirectory = in_array($extension, $imageExtensions, true) ? 'images' : 'files';
                            $filePath = storage_path("app/public/uploads/{$subDirectory}/{$file->FileName}");
                        @endphp
                        @if (file_exists($filePath))
                        <div>
                            <a class="text-sm text-blue-500" download
                                href="{{ asset('storage/uploads/' . $subDirectory . '/' . $file->FileName) }}">{{ $file->FileName }}
                            </a>
                        </div>
                        @endif
                        @empty
                        <span class="text-rose-500">No Files Uploaded</span>
                        @endforelse
                        @endisset
                    </div>
                </div>
            </section>

            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold">Approved by</h1>
                <div class="flex flex-wrap gap-6">
                    <div class="{{ $viewData ? " flex flex-col min-w-min ":" skeleton rounded-lg w-[150px]
                        text-transparent" }}">
                        <span class="text-xs">Who</span>
                        @isset( $viewData->supplierStatus->ApprovedBy)
                        <span class="text-base font-medium">{{ $viewData->supplierStatus->ApprovedBy }}</span>
                        @endisset
                        @empty($viewData->supplierStatus->ApprovedBy)
                        <small>-------------</small>
                        @endempty
                    </div>

                    <div class="{{ $viewData ? " flex flex-col min-w-min ":" skeleton rounded-lg w-[150px]
                        text-transparent" }}">
                        <span class="text-xs">Date</span>
                        @isset( $viewData->supplierStatus->DateApproved)
                        <span class="text-base font-medium ">{{ $viewData->supplierStatus->DateApproved
                            }}</span>
                        @endisset
                        @empty($viewData->supplierStatus->DateApproved)
                        <small>No set date.</small>
                        @endempty
                    </div>
                </div>
            </section>

            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold">Replacements</h1>
                <div class="flex flex-wrap gap-6">
                    <table class="table max-w-3xl table-compact">
                        <thead>
                            <tr>
                                <th>{{ __('Failure Part Code and Number') }}</th>
                                <th>{{ __('Replcement Part Code and Number') }}</th>
                                <th>{{ __('Name and Model') }}</th>
                                <th>{{ __('Quantity') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($viewData->supplierStatus->replacement )
                            @forelse ($viewData->supplierStatus->replacement as $index => $row )
                            <tr>
                                <th>
                                    <input value="{{ $row->FPCN }}" disabled
                                        class="p-1 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
                                </th>
                                <td>
                                    <input value="{{ $row->RPCN }}" disabled
                                        class="p-1 border rounded-md shadow disabled:bg-slate-200 border-black/20" type="text">
                                </td>
                                <td>
                                    <input value="{{ $row->NameModel }}" disabled
                                    class="p-1 border rounded-md shadow max-w-[130px] disabled:bg-slate-200 border-black/20" type="text">
                                </td>
                                <td>
                                    <input value="{{ $row->Quantity }}" disabled
                                        class="p-1 border rounded-md shadow max-w-[50px] disabled:bg-slate-200 border-black/20" type="text">
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>No rows</td>
                            </tr>
                            @endforelse
                            @endisset
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold"></h1>
                <div class="flex flex-wrap gap-6">
                    <div class="{{ $viewData ? " flex flex-col min-w-min ":" skeleton rounded-lg w-[150px]
                        text-transparent" }}">
                        <span class="text-xs">Supplier Warranty Approval</span>
                        @isset( $viewData->supplierStatus->SupplierWarrantyApproval)
                        <span class="text-base font-medium">{{ $viewData->supplierStatus->SupplierWarrantyApproval
                            }}</span>
                        @endisset
                        @empty($viewData->supplierStatus->SupplierWarrantyApproval)
                        <small>------------</small>
                        @endempty
                    </div>

                    <div class="{{ $viewData ? " flex flex-col min-w-min ":" skeleton rounded-lg w-[150px]
                        text-transparent" }}">
                        <span class="text-xs">Dealer Request Approval</span>
                        @isset( $viewData->supplierStatus->DealerRequestApproval)
                        <span class="text-base font-medium ">{{ $viewData->supplierStatus->DealerRequestApproval
                            }}</span>
                        @endisset
                        @empty($viewData->supplierStatus->DealerRequestApproval)
                        <small>------------</small>
                        @endempty
                    </div>

                    <div class="{{ $viewData ? " flex flex-col min-w-min ":" skeleton rounded-lg w-[150px]
                        text-transparent" }}">
                        <span class="text-xs">Uploaded Signature</span>
                        @isset( $viewData->supplierStatus->ApprovalSignature)
                        <a download class="text-sm text-blue-500"
                            href="{{ asset('storage/uploads/supplier/'.$viewData->supplierStatus->ApprovalSignature) }}">{{$viewData->supplierStatus->ApprovalSignature}}</a>
                        @endisset
                        @empty($viewData->supplierStatus->ApprovalSignature)
                        <small>No upload</small>
                        @endempty
                    </div>


                    <div class="{{ $viewData ? " flex flex-col min-w-min ":" skeleton rounded-lg w-[150px]
                        text-transparent" }}">
                        <span class="text-xs">Date</span>
                        @isset( $viewData->supplierStatus->SignatureDate)
                        <span class="text-base font-medium ">{{ $viewData->supplierStatus->SignatureDate
                            }}</span>
                        @endisset
                        @empty($viewData->supplierStatus->SignatureDate)
                        <small>No set date.</small>
                        @endempty
                    </div>
                </div>
            </section>

            <section class="px-4 pt-2 pb-4 border rounded-lg col-span-full border-black/20">
                <h1 class="mb-3 text-lg font-bold">Decision</h1>
                <div class="{{ $viewData ? " flex flex-col min-w-min mb-3":" skeleton rounded-lg w-[150px]
                    text-transparent" }}">
                    <span class="text-xs">Approval</span>
                    @isset( $viewData->supplierStatus->Decision)
                    <span class="text-base font-medium ">{{ $viewData->supplierStatus->Decision
                        }}</span>
                    @endisset
                    @empty($viewData->supplierStatus->Decision)
                    <small>Pending</small>
                    @endempty
                </div>
                <div class="{{ $viewData ? 'flex flex-col w-full' : 'skeleton h-32 w-full text-transparent ' }}">
                    {{-- <span class="mb-2 text-xs">Report Statement</span> --}}
                    <textarea disabled class="w-full border rounded-md border-black/10"
                        rows="5">{{ $viewData->supplierStatus->Reason ?? "No Statement" }}</textarea>
                </div>

                <div class="{{ $viewData ? " flex flex-col min-w-min mt-3":" skeleton rounded-lg w-[150px]
                    text-transparent" }}">
                    <span class="text-xs">Signed by</span>
                    @isset( $viewData->supplierStatus->SignedBy)
                    <span class="text-base font-medium ">{{ $viewData->supplierStatus->SignedBy
                        }}</span>
                    @endisset
                    @empty($viewData->supplierStatus->SignedBy)
                    <small>--------</small>
                    @endempty
                </div>

                <div class="{{ $viewData ? " flex flex-col min-w-min mt-3 ":" skeleton rounded-lg w-[150px]
                    text-transparent" }}">
                    <span class="text-xs">Uploaded Signature</span>
                    @isset( $viewData->supplierStatus->SignedSignature)
                    <a download class="text-sm text-blue-500""
                        href=" {{ asset('storage/uploads/supplier/'.$viewData->supplierStatus->SignedSignature)
                        }}">{{$viewData->supplierStatus->SignedSignature}}</a>
                    @endisset
                    @empty($viewData->supplierStatus->SignedSignature)
                    <small>No upload</small>
                    @endempty
                </div>
            </section>
        </div>
    </div>

</div>

@push('scripts')
<script>
    function openViewWarranty() {
        $('body').find('#modal-warranty').css('opacity', '1').css('visibility', 'visible')
    }
    function closeViewWarranty()
    {
        $('body').find('#modal-warranty').css('opacity', '0').css('visibility', 'hidden')
    }

    // Listen for Livewire event
    document.addEventListener('livewire:init', () => {
        Livewire.on('open-warranty-modal', () => {
            openViewWarranty();
        });
    });
</script>
@endpush
