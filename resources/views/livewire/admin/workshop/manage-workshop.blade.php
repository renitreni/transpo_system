<div>
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Workshop Transactions</h1>
        <div class="flex gap-2">
            <label for="invoice-modal" class="gap-1 bg-white shadow hover:bg-blue-500 hover:text-white btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                  </svg>


                <span class="text-sm">Create Invoice</span>
            </label>
            @include('livewire.admin.inquire.includes.search-box')
        </div>
    </div>
    @include('success.success')

    <div class="flex w-full overflow-x-auto">
        <table class="table max-w-5xl table-compact">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Balance_Amount (SAR)</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer )
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $customer->Customer_Name }}</td>
                    <td>{{ $customer->Balance_Amount }}</td>
                    <td>{{ date('Y-m-d',strtotime($customer->created_at)) }}</td>
                    <td>
                        <button wire:click='downloadInvoice({{ $customer->id }})' class="badge badge-flat-primary hover:badge-primary">Download</button>
                        <button wire:confirm='Confirm delete?' wire:click='deleteInvoice({{ $customer }})' class="badge badge-flat-error hover:badge-error">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12">No Transactions</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $customers->links('vendor.livewire.tailwind') }}
    </div>

    @include('livewire.admin.workshop.includes.create-invoice')
</div>
