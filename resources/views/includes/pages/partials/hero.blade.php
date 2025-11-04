<section
    style="background-image: url(https://images.unsplash.com/photo-1535391879778-3bae11d29a24?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D)"
    class=" bg-cover bg-center -mt-[55px] text-white relative after:absolute after:content=[''] after:w-full after:h-6 after:-bottom-4 after:opacity-55 after:blur-md after:bg-gray-900">
    <div class="mx-auto max-w-screen-xl px-4 py-32 lg:flex lg:h-screen lg:items-center">
        <div class="mx-auto max-w-4xl text-center">
            <h1
                class="bg-gradient-to-r from-green-300 via-blue-500 to-teal-500 bg-clip-text text-3xl font-extrabold text-transparent sm:text-5xl">
                {{ trans('header') }}


                <span class="sm:block">{{ trans('sub_header') }}</span>
            </h1>

            <p class="mx-auto mt-4 max-w-xl sm:text-xl/relaxed">
                <span class="sm:block">{{ trans('sub_text') }}</span>
            </p>

            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a wire:navigate href="/inquire" class="block w-full rounded border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-white focus:outline-none focus:ring active:text-opacity-75 sm:w-auto">
                    {{ trans('inquire_now') }}
                </a>

                <a class="block w-full rounded border border-blue-600 px-12 py-3 text-sm font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring active:bg-blue-500 sm:w-auto"
                    href="#learn-more">
                    {{ trans('learn_more') }}
                </a>
            </div>
        </div>
    </div>
</section>
