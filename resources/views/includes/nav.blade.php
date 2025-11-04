<nav class="navbar-sticky navbar-glass">
    <div class="navbar bg-transparent mx-auto container shadow-none ">
        <div class="navbar-start">
            <a wire:navigate href="/{{ $lang }}" class="navbar-item font-extrabold text-blue-500"><img width="377" height="76" src="https://alesnaad.com/wp-content/uploads/2023/11/14-377x76.jpg" class="custom-logo" alt="شركة الاسناد الماسي" decoding="async" srcset="https://alesnaad.com/wp-content/uploads/2023/11/14-377x76.jpg 377w, https://alesnaad.com/wp-content/uploads/2023/11/14-300x61.jpg 300w, https://alesnaad.com/wp-content/uploads/2023/11/14-768x155.jpg 768w, https://alesnaad.com/wp-content/uploads/2023/11/14.jpg 976w" sizes="(max-width: 377px) 100vw, 377px">
            </a>
        </div>
        <div class=" hidden md:navbar-end text-sm">
            <a wire:navigate href="/{{ $lang }}" class="navbar-item {{ request()->routeIs('home_page') ? "decoration-2 decoration-blue-600 underline underline-offset-8 text-blue-500" : "" }}">{{ trans('navigate_home') }}</a>
            <a wire:navigate href="/{{ $lang }}/inquire" class="navbar-item {{ request()->routeIs('inquire_page') ? "decoration-2  decoration-blue-600 underline underline-offset-8 text-blue-500" : "" }}">{{ trans('navigate_inquire') }}</a>
            <a wire:navigate href="/{{ $lang }}/contact" class="navbar-item {{ request()->routeIs('contact_page') ? "decoration-2 decoration-blue-600 underline underline-offset-8 text-blue-500" : "" }}">{{ trans('navigate_contact') }}</a>
            <details class="relative">
                <summary class="bg-transparent cursor-pointer">Language</summary>
                <div class="dropdown-content absolute  bg-white border border-gray-300 py-2 px-4 mt-1 w-24">
                  <ul>
                    <li><a href="/en" class="block">English</a></li>
                    <li><a href="/ar" class="block">Arabic</a></li>
                  </ul>
                </div>
            </details>
        </div>

        <div class="dropdown navbar-end md:hidden">
            <label class="my-2" tabindex="0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>

            </label>
            <div class="dropdown-menu absolute text-sm top-[50px]">
                <a wire:navigate href="/{{ $lang }}" class="navbar-item {{ request()->routeIs('home_page') ? "bg-blue-200 text-blue-600 " : "" }}">{{ trans('navigate_home') }}</a>
                <a wire:navigate href="/{{ $lang }}/inquire" class="navbar-item {{ request()->routeIs('inquire_page') ? "bg-blue-200 text-blue-600" : "" }}">{{ trans('navigate_inquire') }}</a>
                <a wire:navigate href="/{{ $lang }}/contact" class="navbar-item {{ request()->routeIs('contact_page') ? "bg-blue-200 text-blue-600" : "" }}">{{ trans('navigate_contact') }}</a>
                <details class="relative">
                    <summary class="bg-transparent cursor-pointer">Language</summary>
                    <div class="dropdown-content absolute  bg-white border border-gray-300 py-2 px-4 mt-1 w-24">
                      <ul>
                        <li><a href="/en" class="block">English</a></li>
                        <li><a href="/ar" class="block">Arabic</a></li>
                      </ul>
                    </div>
                </details>
            </div>
        </div>
        {{-- <div class="navbar-end text-sm">
        </div> --}}
    </div>
</nav>
