<input class="modal-state" id="listVouchers" type="checkbox" />
<div class="modal">
	<label class="modal-overlay" for="listVouchers"></label>
	<div class="modal-content flex flex-col gap-5">
		<label for="listVouchers" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</label>
		<h2 class="text-lg">Available Vouchers</h2>
        <div wire:loading class="skeleton w-96 h-24"></div>

		{{-- loop here --}}
        @if (isset($vouchers))
        <div wire:loading.remove class="flex w-full overflow-x-auto">
            <table  class="table">
                <thead >
                    <tr style="font-size: 12px;">
                        <th>Code</th>
                        <th>Voucher</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="font-size: 12px;">
                    @forelse ($vouchers as $voucher )
                        <tr  wire:key='{{ $voucher->Voucher_Code }}'>
                            <th style="font-size: 12px;">{{ $voucher->Voucher_Code }}</th>
                            <td style="font-size: 12px;">{{ $voucher->Voucher_Name }}</td>
                            <td style="font-size: 12px;"><label for="listVouchers" wire:click='select_voucher("{{$voucher->Voucher_Code   }}")' class="px-2 py-1.5 cursor-pointer rounded-md bg-blue-500 text-slate-100 border hover:bg-blue-600 border-blue-700">Select</label></td>
                        </tr>
                    @empty
                        <p>No Avaliable Vouchers</p>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endif
	</div>
</div>
