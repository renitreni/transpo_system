<section class="w-full ">
    <div class="flex items-center justify-between pr-5">
        <h1 class="text-2xl font-bold">Clients</h1>
        <div class="flex gap-2">
            @include('livewire.admin.inquire.includes.search-box')
            <button wire:click='add' class="gap-1 bg-white shadow hover:bg-blue-500 hover:text-white btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                  </svg>

                <span class="text-sm">Add Client</span>
            </button>
            <livewire:admin.delivery.download>
        </div>
    </div>

    @include('success.success')

    @if ($search == "")
    <div class="flex w-full py-8 overflow-x-auto">
        <table class="table h-full max-w-5xl mt-10 table-compact">
            <thead>
                <tr>
                    <th></th>
                    <th>Plate No / رقم اللوحة</th>
                    <th>Phone Number</th>
                    <th>Company Name/ اسم الشركة</th>
                    <th>Office Address</th>
                    <th>Other Location</th>
                    <th>Date Purchased</th>
                    <th>Driver Name</th>
                    <th>Car Insurance Company</th>
                    <th>Resident Iqama Number</th>
                    <th>Driver License Number</th>
                    <th>Driver License Expiry Date</th>
                    <th>Insurance Expiry Date</th>
                    <th>Driver Status</th>
                    <th>Driver Card / بطاقة السائق</th>
                    <th>Operating Card / بطاقة التشغيل</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @include('livewire.admin.delivery.includes.table-rows-deliveries')
            </tbody>
        </table>
    </div>

    @else
    <div class="flex py-8 overflow-x-auto">
        <table class="table max-w-5xl mt-10 table-compact">
            <thead>
                <tr>
                    <th>Plate No / رقم اللوحة</th>
                    <th>Company</th>
                    {{-- <th>Payment</th>
                    <th>Product</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Purchased Date</th> --}}
                    <th>Chassis Number</th>
                    <th>Warranty Expiration</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @include('livewire.admin.delivery.includes.table-search')
            </tbody>
        </table>
    </div>

    @endif


    @if ($search === "")
    <div class="w-full mt-6">
        {{-- {{ $customers->withPath(session('clientURL'))->links('vendor.livewire.tailwind') }} --}}
        {{ $customers->links('vendor.livewire.tailwind') }}
    </div>
    @endif

    <div>
        @include('livewire.admin.delivery.includes.modal-deliveries')
    </div>
</section>

@push('scripts')
<script>
    function openViewPurchase() {
        $('body').find('#modal-delivery').css('opacity', '1').css('visibility', 'visible');
        console.log($('body').find('#modal-delivery'));
    }
    
    function closeViewPurchase()
    {
        $('body').find('#modal-delivery').css('opacity', '0').css('visibility', 'hidden');
    }

    // Listen for Livewire events
    document.addEventListener('livewire:init', () => {
        Livewire.on('open-view-purchase', () => {
            openViewPurchase();
        });

        Livewire.on('close-view-purchase', () => {
            closeViewPurchase();
        });
    });
</script>
@endpush
