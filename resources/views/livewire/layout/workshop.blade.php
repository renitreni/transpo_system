<!DOCTYPE html>
<html dir="{{ isset($dir) ? $dir : ' ltr' }}" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? '' }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="https://alesnaad.com/wp-content/uploads/2023/11/66.png">
    <link rel="icon" href="https://alesnaad.com/wp-content/uploads/2023/11/66.png" sizes="32x32">
    <link rel="icon" href="https://alesnaad.com/wp-content/uploads/2023/11/66.png" sizes="16x16">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <main>
        <div class="fixed w-full opacity-60 blur inset-0 bg-black -z-[2]"></div>
        <img class="fixed inset-0 w-full -z-10 " src="{{ asset('wsbg.jpg') }}" alt="">
        <nav class="mt-5">
            <div class="container mx-auto rounded-lg navbar">
                <div class="navbar-start">
                    <a href="{{ route('admin_Workshop', ['lang' => 'en']) }}"
                        class="font-semibold navbar-item">Workshop</a>
                </div>
                <div class="navbar-end">
                    <div class="avatar ">
                        <div class="dropdown-container">
                            <div class="dropdown">
                                <label class="flex px-0 cursor-pointer btn btn-ghost" tabindex="0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                    </svg>
                                </label>
                                <div class="dropdown-menu dropdown-menu-bottom-left">
                                    <a href="{{ route('admin_Workshop', ['lang' => 'en', 'page' => 'approval']) }}"
                                        tabindex="-1" class="text-sm dropdown-item">Approvals</a>
                                    <a href="{{ route('admin_Workshop', ['lang' => 'en', 'page' => 'report']) }}"
                                        tabindex="-1" class="text-sm dropdown-item">Report</a>
                                    <a href="{{ route('maintenance', ['lang' => 'en']) }}" tabindex="-1"
                                        class="text-sm dropdown-item">Maintenance</a>
                                    <a href="{{ route('admin_Logout') }}" tabindex="-1"
                                        class="text-sm text-rose-500 dropdown-item">Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="w-full mt-10">
            <div class="container mx-auto">
                {{ $slot }}
            </div>
        </div>
    </main>
    @livewireScripts
</body>

</html>
