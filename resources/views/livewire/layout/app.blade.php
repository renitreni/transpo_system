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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        @auth
            @if (Auth::user()->role === 'Mechanic')
                {{ $slot }}
            @elseif(Auth::user()->role === 'FAW' ||
                    Auth::user()->role === 'OTHER' ||
                    Auth::user()->role === 'Accountant' ||
                    Auth::user()->role === 'Sales' ||
                    Auth::user()->role === 'Fleet')
                {{ $slot }}
            @elseif(Auth::user()->role === 'Admin')
                @include('livewire.admin.includes.sidemenu')
            @endif
        @endauth
        @guest
            {{ $slot }}
        @endguest
    </main>
    @livewireScripts
    @stack('scripts')
    <!-- Modal -->
    <div id="popupModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-xl shadow-lg max-w-sm w-full text-center">
            <h2 class="text-xl font-bold mb-4">Notice</h2>
            <p class="text-gray-600 mb-6">Reminder: Your payment is overdue. Please settle immediately to avoid service
                interruption.</p>
            <button onclick="closePopup()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                Cancel
            </button>
        </div>
    </div>
    <script>
        (() => {
            if (window.showPopup && window.closePopup) {
                return;
            }

            const popup = document.getElementById('popupModal');

            window.showPopup = () => popup.classList.remove('hidden');
            window.closePopup = () => popup.classList.add('hidden');

            // // Show the popup every 1 minute
            // setInterval(() => {
            //     showPopup();
            // }, 3000); // 60,000 ms = 1 minute

            // // Show popup immediately on first load
            // showPopup();
        })();
    </script>
</body>

</html>
