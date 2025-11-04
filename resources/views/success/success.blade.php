@if(session('success'))
<div
    x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
    class="bg-green-200 text-green-800 flex items-center border border-green-600 gap-x-3 p-2.5 rounded-md my-3">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden w-6 h-6 sm:block">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
      </svg>
    <span class="text-sm sm:text-base">{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div
    x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
    class="bg-rose-200 text-rose-800 flex items-center border border-rose-600 gap-x-3 p-2.5 rounded-md my-3">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden w-6 h-6 sm:block">
        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
      </svg>
    <span class="text-sm sm:text-base">{{ session('error') }}</span>
</div>
@endif


