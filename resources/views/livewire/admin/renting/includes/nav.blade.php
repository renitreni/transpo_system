<nav class="mt-5">
    <div class="container mx-auto rounded-lg navbar">
        <div class="navbar-start">
            <a href="{{ route('admin_Renting',['lang'=>'en']) }}" class="font-semibold capitalize navbar-item">Hi, {{ auth()->user()->name }}</a>
        </div>
        <div class="navbar-end">
            <div>
                <a href="{{ route('admin_Renting',['lang'=>'en']) }}" class="text-sm btn btn-sm
                    {{ $page == "" || $page == "request" || $page=="request-edit" ? "btn-primary" :"" }}">Client
                </a>
                @if (auth()->user()->role === "Accountant")
                <a href="{{ route('admin_Renting',['lang'=>'en','page'=>'invoice']) }}" class="text-sm btn btn-sm
                    {{ $page == "invoice" || $page=="invoice-show" ? "btn-primary" :"" }}">Invoice</a>
                @endif

                @if (auth()->user()->role === "Fleet" || auth()->user()->role === "Accountant")
                <a href="{{ route('admin_Renting',['lang'=>'en','page'=>'fleet-report']) }}" class="text-sm btn btn-sm
                        {{ $page == "fleet-report" || $page=="fleet-logs" || $page=="fleet-approval" ? "btn-primary"
                    :"" }}">Fleet Report</a>

                @endif


                {{-- <a href="{{ route('admin_Renting',['lang'=>'en','page'=>'accident-report']) }}"
                    class="text-sm btn btn-sm {{ $page == " accident-report" ? "btn-primary" :"" }}">Accident
                    Report</a> --}}
            </div>

            <div class="flex items-center gap-2 mr-3">
                <button x-data x-on:click="$dispatch('open-modal','search-modal')"
                    class="btn btn-sm hover:bg-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    {{-- <span>Search</span> --}}
                </button>
                <livewire:admin.renting.notification />
                <a href="{{ route('admin_Logout') }}" tabindex="-1" class="text-sm text-rose-500 dropdown-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>

                </a>
            </div>
        </div>
    </div>
</nav>
