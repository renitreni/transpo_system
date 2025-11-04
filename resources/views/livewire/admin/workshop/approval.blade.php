<section class="container mx-auto mt-10">

    <div class="p-4 bg-white rounded">
        @include('success.success')
        <div class="px-4 mb-4">
            <h1 class="text-xl font-medium">Approval Table</h1>
            <small>The list was already checked by sales and fleet.</small>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y-2 divide-gray-200">
                <thead class="text-left">
                    <tr>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Track #</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Purchased #</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Company</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Contact Person</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Reqt. Units</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Sales</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Fleet</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap"></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($rentData as $data )
                    <tr wire:key='{{ $data->track_number }}'>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">{{$data->track_number }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $data->purchase_number }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $data->company_name }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $data->contact_person }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $data->number_units }} units</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $data->isSalesApproved ? "Approved" :
                            "Rejected" }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $data->isFleetApproved ? "Approved" :
                            "Rejected" }}</td>
                        <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                            @if ($data->isWorkshopApproved)
                            <button wire:click='open({{ $data->id }})' class="btn btn-xs btn-outline-success gap-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span>Approved</span>
                            </button>

                            @else
                            <button wire:click='open({{ $data->id }})' class="btn btn-xs btn-outline-primary gap-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span>Check</span>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty

                    <tr>
                        <td colspan="" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Nothing to approved
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <x-modal maxWidth="5xl" name="approval-workshop-modal" :show="false">
        <form wire:submit='unitApprove' class="p-6">
            <div class="mb-5">
                <h1 class="text-lg font-medium">Requested Units </h1>
            </div>

            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                    <thead class="text-left">
                        <tr>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Brand</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Model</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Height</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">VIN #</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Plate #</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Insurance</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Operator Name</th>
                            <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Location</th>
                        </tr>
                    </thead>

                    <tbody class="text-xs divide-y divide-gray-200">
                        @isset($unitsDetails)
                        @forelse ($unitsDetails as $detail )
                        <tr>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $detail->truck_brand }}
                            </td>
                            <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $detail->truck_model }}</td>
                            <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $detail->truck_size }}</td>
                            <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $detail->truck_vin }}</td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">{{ $detail->plate_number }}</td>
                            <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $detail->insurance }}</td>
                            <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $detail->operator_name }}</td>
                            <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $detail->current_location }}</td>
                        </tr>

                        @empty
                        <tr>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">No requested units</td>

                        </tr>
                        @endforelse
                        @endisset
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                <h1 class="text-lg font-medium">Workshop Approval Form</h1>
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
                            <input wire:model='personWorkshop' type="text" required
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
    </x-modal>


</section>
