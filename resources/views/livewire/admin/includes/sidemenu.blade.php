<div class="flex flex-row sm:gap-6 ">

    <div class="sm:w-full sm:max-w-[18rem]">
        <input type="checkbox" id="sidebar-mobile-fixed" class="sidebar-state" />
        <label for="sidebar-mobile-fixed" class="sidebar-overlay"></label>
        <aside
            class="justify-start h-full sidebar sidebar-fixed-left sidebar-mobile max-sm:fixed max-sm:-translate-x-full">
            <section class="items-center p-4 sidebar-title">
                <div class="flex flex-col">
                    <div class="flex items-center space-x-10">
                        <span>alesnaad</span>
                        <details class="relative">
                            <summary class="text-xs bg-transparent cursor-pointer">
                                Lang
                            </summary>
                            <div class="absolute w-24 px-4 py-2 mt-1 bg-white border border-gray-300 dropdown-content">
                                <ul>
                                    <li><a href="{{ route('admin_Dashboard', ['lang' => 'en']) }}"
                                            class="block">English</a></li>
                                    <li><a href="{{ route('admin_Dashboard', ['lang' => 'ar']) }}"
                                            class="block">Arabic</a></li>
                                </ul>
                            </div>
                        </details>
                    </div>
                    <span class="text-xs font-normal text-content2">{{ __('welcome') }} {{ Auth::user()->name }}</span>
                </div>
            </section>

            <section class="sidebar-content">
                <nav class="rounded-md menu">
                    <section class="px-4 menu-section">
                        <span class="menu-title">{{ __('main_menu') }}</span>
                        <ul class="menu-items">

                            <li
                                class="menu-item {{ request()->routeIs('admin_Dashboard') ? 'bg-blue-500 text-slate-100 hover:bg-blue-700' : '' }}">
                                <a wire:navigate href="{{ route('admin_Dashboard', ['lang' => 'en']) }}"
                                    class="flex w-full gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>

                                    <span>{{ __('dashboard') }}</span>
                                </a>
                            </li>

                            <li
                                class="menu-item {{ request()->routeIs('admin_ManageInquiries') ? 'bg-blue-500 text-slate-100 hover:bg-blue-700' : '' }}">
                                <a wire:navigate href="{{ route('admin_ManageInquiries', ['lang' => 'en']) }}"
                                    class="flex w-full gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>
                                    <span>{{ __('inquiry') }}</span>
                                </a>
                            </li>

                            <li
                                class="menu-item {{ request()->routeIs('admin_ManageInventories') ? 'bg-blue-500 text-slate-100 hover:bg-blue-700' : '' }}">
                                <a wire:navigate href="{{ route('admin_ManageInventories', ['lang' => 'en']) }}"
                                    class="flex w-full gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                    </svg>

                                    <span>{{ __('inventory') }}</span>
                                </a>
                            </li>

                            <li
                                class="menu-item {{ request()->routeIs('admin_ManageStocks') ? 'bg-blue-500 text-slate-100 hover:bg-blue-700' : '' }}">
                                <a wire:navigate
                                    href="{{ route('admin_ManageStocks', ['lang' => 'en', 'type' => 'trucks']) }}"
                                    class="flex w-full gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                                    </svg>


                                    <span>{{ __('stocks') }}</span>
                                </a>
                            </li>

                            <li
                                class="menu-item {{ request()->routeIs('admin_ManageDeliveries') || request()->routeIs('admin_CreateReceipt') ? 'bg-blue-500 text-slate-100 hover:bg-blue-700' : '' }}">
                                <a wire:navigate href="{{ route('admin_ManageDeliveries', ['lang' => 'en']) }}"
                                    class="flex w-full gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                    </svg>
                                    <span>{{ __('clients') }}</span>
                                </a>
                            </li>

                            <li
                                class="menu-item {{ request()->routeIs('admin_ManageWorkshop') ? 'bg-blue-500 text-slate-100 hover:bg-blue-700' : '' }}">
                                <a wire:navigate href="{{ route('admin_ManageWorkshop', ['lang' => 'en']) }}"
                                    class="flex w-full gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                    </svg>
                                    <span>{{ __('ws_payment') }}</span>
                                </a>
                            </li>

                            <li
                                class="menu-item {{ request()->routeIs('admin_ManageWarranty') || request()->routeIs('admin_CreateWarranty') || request()->routeIs('admin_EditWarranty') || request()->routeIs('admin_Approval') || request()->routeIs('admin_EditSupplier') ? 'bg-blue-500 text-slate-100 hover:bg-blue-700' : '' }}">
                                <a wire:navigate href="{{ route('admin_ManageWarranty', ['lang' => 'en']) }}"
                                    class="flex w-full gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                                    </svg>
                                    <span>{{ __('ws_warranty') }}</span>
                                </a>
                            </li>

                            <li
                                class="menu-item {{ request()->routeIs('admin_Users') ? 'bg-blue-500 text-slate-100 hover:bg-blue-700' : '' }}">
                                <a wire:navigate href="{{ route('admin_Users', ['lang' => 'en']) }}"
                                    class="flex w-full gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                    </svg>

                                    <span>{{ __('Users') }}</span>
                                </a>
                            </li>


                        </ul>
                    </section>
                </nav>
            </section>
            <section class="justify-end pt-2 sidebar-footer bg-gray-2">
                <div class="my-0 divider"></div>
                <div class="z-50 flex w-full cursor-pointer dropdown h-fit hover:bg-gray-4">
                    <label
                        class="whites mx-2 flex h-fit w-full cursor-pointer p-1.5 rounded-md hover:bg-blue-500 hover:text-slate-100"
                        tabindex="0">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                            </svg>

                            <a tabindex="-1" href="{{ route('admin_Logout') }}" class="text-sm ">Logout</a>
                        </div>
                    </label>
                </div>
            </section>
        </aside>
    </div>
    <div class="flex flex-col w-full p-4">
        <div class="w-fit">
            <label for="sidebar-mobile-fixed" class="btn-primary btn sm:hidden">Open Sidebar</label>
        </div>

        <div class="my-4 text-[#333] dark:text-slate-100 w-full">
            <div wire:offline class="p-2 mb-3 border rounded max-w-60 bg-rose-200 border-rose-500 text-rose-600">
                <span>Internet connection lost.</span>
            </div>
            {{ $slot }}
        </div>
    </div>
</div>
