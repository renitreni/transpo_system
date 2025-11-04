<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
    @livewireStyles
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <section class="bg-white dark:bg-gray-900 ">
        <div class="container flex items-center justify-center min-h-screen px-6 py-12 mx-auto">
            <div class="w-full ">
                <div class="flex flex-col items-center max-w-lg mx-auto text-center">
                    <p class="text-sm font-medium text-blue-500 dark:text-blue-400">404 error</p>
                    <h1 class="mt-3 text-2xl font-semibold text-gray-800 dark:text-white md:text-3xl">We lost this page</h1>
                    <p class="mt-4 text-gray-500 dark:text-gray-400">We searched high and low, but couldn’t find what you’re looking for.Let’s find a better place for you to go.</p>

                    <div class="flex items-center w-full mt-6 gap-x-3 shrink-0 sm:w-auto">
                        <button onclick="window.location.href='/'" class="w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                            Take me home
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @livewireScripts
</body>
</html>
