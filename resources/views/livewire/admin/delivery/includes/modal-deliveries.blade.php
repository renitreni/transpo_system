<div class="w-screen modal" id="modal-delivery" wire:ignore.self>
	<div class="modal-content max-w-[900px] flex flex-col gap-5 w-full">
		<button type="button" wire:click='cancelView' for="modal-delivery" class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
        <div wire:loading class="w-24 h-4 skeleton"></div>
        <span wire:loading.remove class="p-0 m-0 text-sm font-bold ">Payment Method: <span class="text-green-500">{{ $data['customer']->MethodPayment ?? "" }}</span></span>
        <div class="flex items-center justify-between w-full mt-2">
            <h2 class="text-lg">View Purchased</h2>
            <div wire:loading class="w-24 h-4 skeleton"></div>
            <small wire:loading.remove class="text-slate-500">{{ $data['customer']->OrderTrackNumber ?? "" }}</small>
        </div>
        <div wire:loading.remove>
            <div class="grid grid-cols-2 text-sm gap-x-6">
                <div >
                    <div class="flex flex-col mb-4 border-b-2">
                        <span class="text-xs">Name : </span>
                        <span>{{ $data['customer']->FullName ?? "" }}</span>
                    </div>
                    <div class="flex flex-col mb-4 border-b-2">
                        <span class="text-xs">Email : </span>
                        <span>{{ $data['customer']->Email ?? "" }}</span>
                    </div>
                    <div class="flex flex-col mb-4 border-b-2">
                        <span class="text-xs">Phone Number : </span>
                        <span>{{ $data['customer']->PhoneNumber ?? "" }}</span>
                    </div>
                </div>

                <div >
                    <div class="flex flex-col mb-4 border-b-2">
                        <span class="text-xs">Fax Number : </span>
                        <span>{{ $data['customer']->FaxNumber ?? "" }}</span>
                    </div>

                    <div class="flex flex-col mb-4 border-b-2">
                        <span class="text-xs">Company Name/ اسم الشركة : </span>
                        <span>{{ $data['customer']->CompanyName ?? "" }}</span>
                    </div>

                    <div class="flex flex-col mb-4 border-b-2">
                        <span class="text-xs">Date Purchased : </span>
                        <span>{{ $data['customer']->OrderDate ?? "" }}</span>
                    </div>
                </div>
            </div>

            <div class="flex w-full overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Quantity</th>
                            <th>Product</th>
                            <th>Color</th>
                            <th>Chassis #</th>
                            <th>Warranty Period</th>
                            <th>Warranty Expiration</th>
                            <th>Warranty Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $data['orders'] ?? [] as $order )
                        <tr>
                            <td> {{ $order->Quantity }}</td>
                            <th>{{ $order->Product }}</th>
                            <th>{{ $order->Color }}</th>
                            <th>{{ $order->ChassisNumber }}</th>
                            <th>{{ $order->WarrantyPeriod }} Months</th>
                            <th>{{ $order->WarrantyExpiration }}</th>
                            <td>
                                @php
                                    $expiration = new DateTime($order->WarrantyExpiration);
                                    $now = new DateTime();
                                @endphp
                                @if($now > $expiration)
                                    <span class="font-semibold text-rose-700">Expired</span>
                                @else
                                    <span class="font-semibold text-blue-700">Valid</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <th colspan="12">No purchased</th>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col w-full mt-3 text-xs">
                <span>Client Address :</span>
                <span>
                    {{ $data['customer']->OfficeAddress ?? "" }},
                    {{ $data['customer']->OtherLocation ?? "" }},
                </span>
            </div>

        </div>

        <div wire:loading>
            <div class="h-24 skeleton"></div>
            <table class="table w-full max-w-4xl">
                <thead>
                    <tr>
                        <th><div class="h-5 rounded-md skeleton"></div></th>
                        <th><div class="h-5 rounded-md skeleton"></div></th>
                        <th><div class="h-5 rounded-md skeleton"></div></th>
                        <th><div class="h-5 rounded-md skeleton"></div></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><div class="h-5 rounded-md skeleton"></div></th>
                        <td><div class="h-5 rounded-md skeleton"></div></td>
                        <td><div class="h-5 rounded-md skeleton"></div></td>
                        <td><div class="h-5 rounded-md skeleton"></div></td>
                    </tr>
                    <tr>
                        <th><div class="h-5 rounded-md skeleton"></div></th>
                        <td><div class="h-5 rounded-md skeleton"></div></td>
                        <td><div class="h-5 rounded-md skeleton"></div></td>
                        <td><div class="h-5 rounded-md skeleton"></div></td>
                    </tr>
                    {{-- <tr>
                        <th><div class="h-5 rounded-md skeleton"></div></th>
                        <td><div class="h-5 rounded-md skeleton"></div></td>
                        <td><div class="h-5 rounded-md skeleton"></div></td>
                        <td><div class="h-5 rounded-md skeleton"></div></td>
                    </tr>
                    <tr>
                        <th><div class="h-5 rounded-md skeleton"></div></th>
                        <td><div class="h-5 rounded-md skeleton"></div></td>
                        <td><div class="h-5 rounded-md skeleton"></div></td>
                        <td><div class="h-5 rounded-md skeleton"></div></td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
	</div>
</div>
