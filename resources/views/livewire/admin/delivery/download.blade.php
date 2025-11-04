<div>
    <label class="text-blue-500 duration-200 bg-white border shadow hover:bg-slate-200 border-blue-400/10 btn" for="download">Download</label>
    <input class="modal-state" id="download" type="checkbox" />
    <div class="modal">
        {{-- <label class="modal-overlay" for="download"></label> --}}
        <div class="flex flex-col gap-5 modal-content">
            <label for="download" class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</label>
            <h2 class="text-xl">Filter Download</h2>
            <div class="flex items-center justify-between gap-3">
                <div>
                    <label class="text-sm">Purchased Date</label>
                    <select wire:model.live='selectedYear' class="cursor-pointer select select-solid">
                        <option value="">Choose year</option>
                        @forelse ($years as $year )
                            <option wire:key='{{ $year }}' value="{{ $year }}">{{ $year }}</option>
                        @empty
                            <option disabled> No Years</option>
                        @endforelse
                    </select>
                </div>

                <div>
                    <label class="text-sm">Products</label>
                    <select @if($selectedYear == "") disabled @endif wire:model='selectedProduct' class="cursor-pointer select select-solid">
                        <option value="">All Products</option>
                        @forelse ($products as $product )
                            <option wire:key='{{ $product }}' value="{{ $product }}">{{ $product }}</option>
                        @empty
                            <option disabled> No Product</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div>
                <button wire:click='download' class="float-right text-white bg-blue-500 btn">Download</button>
            </div>
        </div>
    </div>
</div>
