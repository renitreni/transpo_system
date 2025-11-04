<div>
    <x-modal maxWidth="4xl" name="open-accountant-modal" :show="false">
        <div class="p-6">
            @include('success.success')
            <div class="leading-none">
                <h1 class="text-lg font-bold">Clients/العميل</h1>
                <small>List of clients that needs for approval / قائمة العملاء التي تحتاج إلى الموافقة</small>
            </div>
            <div class="mt-4">
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                        <thead class="text-left">
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Track # / رقم التتبع</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Sales / المبيعات</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Fleet / الأسطول</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Workshop / الورشة</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Accountant / المحاسب</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($approvals as $approval )
                            <tr wire:key='{{ $approval->track_number }}'>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    {{$approval->track_number }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $approval->isSalesApproved ?
                                    "Approved" : "Rejected" }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $approval->isFleetApproved ?
                                    "Approved" : "Rejected" }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $approval->isWorkshopApproved ?
                                    "Approved" : "Rejected" }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $approval->isAccountantApproved
                                    ? "Approved" : "Rejected" }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                    @if ($approval->personAccountant != null)
                                    <button disabled class="btn disabled:bg-slate-200 btn-xs btn-outline-primary"
                                        wire:click='openApproval({{ $approval->id }})'>Checked
                                    </button>
                                    @else
                                    <button class="btn btn-xs btn-outline-primary"
                                        wire:click='openApproval({{ $approval->id }})'>Check
                                    </button>

                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                    Empty list / قائمة فارغة </td>
                            </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-modal>

    <x-modal name="approval-form-modal" :show="false">
        <div class="p-6">
            <form wire:submit='save'>
                <div>
                    <h1 class="text-lg font-medium">Accuntant Approval Form</h1>
                    <small>All fields are required.</small>
                </div>
                <div class="flow-root py-3 mt-3 border border-gray-100 rounded-lg shadow-sm">
                    <dl class="-my-3 text-sm divide-y divide-gray-100">
                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Decision</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                <select required wire:model='decision'
                                    class="w-full p-1 border-0 rounded focus:px-2 focus:shadow focus:border-teal-950 focus:ring-teal-950">
                                    <option value="">--- Select ----</option>
                                    <option value="1">Approved</option>
                                    <option value="0">Reject</option>
                                </select>
                            </dd>
                        </div>


                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Checked By</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                <input wire:model='personAccountant' type="text" required
                                    class="w-full p-2 border rounded shadow border-black/10" placeholder="Full Name">
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Remarks</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                <textarea wire:model='remark' rows="3"
                                    class="w-full p-2 border rounded shadow border-black/10"></textarea>
                            </dd>
                        </div>
                    </dl>
                </div>
                <div class="flex justify-end mt-5">
                    <button type="submit" class="btn btn-sm btn-solid-primary">Approved Request</button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
