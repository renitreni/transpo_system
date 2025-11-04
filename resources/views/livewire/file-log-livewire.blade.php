<section class="mb-10">
    <div class="container px-6 py-12 mx-auto">
        <div class="flex flex-col">
            <span class="flex items-center">
                <span class="pr-6">Images Uploaded</span>
                <span class="h-px flex-1 bg-black"></span>
                <a class="group relative inline-block text-sm font-medium text-indigo-600 focus:outline-none focus:ring active:text-indigo-500 ml-2"
                    href="#" wire:click='reSyncImages'>
                    <span
                        class="absolute inset-0 translate-x-0 translate-y-0 bg-indigo-600 transition-transform group-hover:translate-x-0.5 group-hover:translate-y-0.5"></span>
                    <span class="relative block border border-current bg-white px-8 py-3"> Sync </span>
                </a>
            </span>
        </div>
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-8 mt-4">
            @foreach ($uploadImages as $item)
                {{-- START --}}
                <div class="h-18 rounded-lg bg-gray-200">

                    <a href="#" class="group relative block h-64 sm:h-80 lg:h-96" wire:click='uploadThis("{{ $item['path'] }}")'>

                        <span class="absolute inset-0 border-2 border-dashed border-black"></span>

                        <div
                            class="relative flex h-full transform items-end border-2 border-black bg-white transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2">
                            <img
                            alt=""
                            src="{{ url($item['path']) }}"
                            class="absolute inset-0 h-full w-full object-cover opacity-75 transition-opacity group-hover:opacity-50"
                          />
                            <div
                                class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8">
                                @if ($item['is_sync'])
                                    <span class="text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-10 sm:size-12" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                            </div>

                            <div
                                class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:opacity-100 sm:p-6 lg:p-8">
                                @if ($item['is_sync'])
                                    <h3 class="mt-4 text-xl font-medium sm:text-2xl">Already Sync</h3>
                                @else
                                    <h3 class="mt-4 text-xl font-medium sm:text-2xl">Not Yet Sync</h3>
                                @endif
                                <p class="mt-4 text-sm sm:text-base">
                                    {{ $item['path'] }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- END --}}
            @endforeach
        </div>
    </div>
</section>
