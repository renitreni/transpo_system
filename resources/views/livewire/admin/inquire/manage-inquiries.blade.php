<section class="w-full">
    <div class="flex items-center justify-between pr-5">
        <h1 class="text-2xl font-bold">{{ __('inquiries') }}</h1>
        @include('livewire.admin.inquire.includes.search-box')
    </div>
    {{-- Notification --}}
    @include('success.success')
    {{-- Notification --}}

    <div class="flex w-full mt-10 overflow-x-auto">
        <table class="table max-w-5xl table-compact ">
            <thead>
                <tr>
                    <th></th>
                    <th>{{ __('fullname') }}</th>
                    <th>{{ __('inquiry_date') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @include('livewire.admin.inquire.includes.table-rows')
            </tbody>
        </table>
    </div>
    <div class="w-full mt-6">
        {{ $inquiries->links('vendor.livewire.tailwind') }}
    </div>

    <div>
        @include('livewire.admin.inquire.includes.modal-inquire')
    </div>
</section>
