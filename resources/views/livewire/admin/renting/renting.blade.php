<div class="relative">
    <div class="fixed w-full opacity-60 blur inset-0 bg-black -z-[2]"></div>
    <img class="fixed inset-0 w-full -z-10 " src="{{ asset('wsbg.jpg') }}" alt="">
    @include('livewire.admin.renting.includes.nav')

    @if($page == "")
    @include('livewire.admin.renting.includes.mainPage')
    <x-modal maxWidth="6xl" :show="false" name="view_rent">
        @empty($view)
        <div class="w-full p-6">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>
                            <div class="h-5 rounded-md skeleton"></div>
                        </th>
                        <th>
                            <div class="h-5 rounded-md skeleton"></div>
                        </th>
                        <th>
                            <div class="h-5 rounded-md skeleton"></div>
                        </th>
                        <th>
                            <div class="h-5 rounded-md skeleton"></div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <div class="h-5 rounded-md skeleton"></div>
                        </th>
                        <td>
                            <div class="h-5 rounded-md skeleton"></div>
                        </td>
                        <td>
                            <div class="h-5 rounded-md skeleton"></div>
                        </td>
                        <td>
                            <div class="h-5 rounded-md skeleton"></div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <div class="h-5 rounded-md skeleton"></div>
                        </th>
                        <td>
                            <div class="h-5 rounded-md skeleton"></div>
                        </td>
                        <td>
                            <div class="h-5 rounded-md skeleton"></div>
                        </td>
                        <td>
                            <div class="h-5 rounded-md skeleton"></div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <div class="h-5 rounded-md skeleton"></div>
                        </th>
                        <td>
                            <div class="h-5 rounded-md skeleton"></div>
                        </td>
                        <td>
                            <div class="h-5 rounded-md skeleton"></div>
                        </td>
                        <td>
                            <div class="h-5 rounded-md skeleton"></div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <div class="h-5 rounded-md skeleton"></div>
                        </th>
                        <td>
                            <div class="h-5 rounded-md skeleton"></div>
                        </td>
                        <td>
                            <div class="h-5 rounded-md skeleton"></div>
                        </td>
                        <td>
                            <div class="h-5 rounded-md skeleton"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endempty
        @isset($view)
        @include('livewire.admin.renting.includes.viewDetails')
        @endisset
    </x-modal>

    @if (auth()->user()->role === "Sales")
    <x-modal maxWidth="lg" name="approve-sales-modal" :show="false">
        <form wire:submit='saveApproval' class="p-6">
            @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error )
                <li><small class="text-rose-600">{{ $error }}</small></li>
                @endforeach
            </ul>
            @endif
            <div class="">
                <h1 class="text-lg font-medium">Sales Approval Form / نموذج الموافقة على المبيعات</h1>
                <small>All fields are required. / جميع الحقول مطلوبة.</small>
            </div>
            <div class="flow-root py-3 mt-3 border border-gray-100 rounded-lg shadow-sm">
                <dl class="-my-3 text-sm divide-y divide-gray-100">
                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Decision / القرار</dt>
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
                        <dt class="font-medium text-gray-900">Checked By / فحص بواسطة</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            <input wire:model='personSales' type="text" required
                                class="w-full p-2 border rounded shadow placeholder:text-sm border-black/10" placeholder="Full Name">
                        </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Remarks / ملاحظات</dt>
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
    @endif
    @elseif ($page == "request")
    <livewire:admin.renting.request-equipment :id="$view" />
    @elseif ($page == "request-edit")
    <livewire:admin.renting.request-equipment :id="$view" />
    @elseif ($page == "invoice")
    <div class="container p-6 mx-auto bg-white rounded-md mt-7">
        <livewire:admin.renting.invoice />
    </div>
    @elseif ($page == "invoice-show")
    <div class="container p-6 mx-auto bg-white rounded-md mt-7">
        <livewire:admin.renting.invoice-show :id="$view" />
    </div>
    @elseif ($page == "fleet-report")
    <div class="container p-6 mx-auto bg-white rounded-md mt-7">
        <livewire:admin.renting.fleet />
    </div>
    @elseif ($page == "fleet-logs")
    <div class="container p-6 mx-auto bg-white rounded-md mt-7">
        <livewire:admin.renting.fleet-log :id="$view" />
    </div>
    @elseif ($page == "fleet-approval")
    <div class="container p-6 mx-auto bg-white rounded-md mt-7">
        <livewire:admin.renting.approve-clients />
    </div>
    @elseif ($page == "accident-report")
    <div class="container p-6 mx-auto bg-white rounded-md mt-7">
        <span class="text-lg font-bold text-rose-700">Under Maintenance</span>
    </div>
    @endif

    <livewire:admin.renting.search />
    <livewire:admin.renting.send-email />

</div>
