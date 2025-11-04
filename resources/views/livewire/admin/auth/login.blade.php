<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg">
        <img width="377" height="76" src="https://alesnaad.com/wp-content/uploads/2023/11/14-377x76.jpg" class="custom-logo" alt="شركة الاسناد الماسي" decoding="async" srcset="https://alesnaad.com/wp-content/uploads/2023/11/14-377x76.jpg 377w, https://alesnaad.com/wp-content/uploads/2023/11/14-300x61.jpg 300w, https://alesnaad.com/wp-content/uploads/2023/11/14-768x155.jpg 768w, https://alesnaad.com/wp-content/uploads/2023/11/14.jpg 976w" sizes="(max-width: 377px) 100vw, 377px">
        {{-- <h1 class="text-center text-2xl font-bold text-zinc-600 dark:text-slate-200 sm:text-3xl">Sultanalfouzanco</h1> --}}
        <p class="text-center text-lg font-medium">Sign in to your account</p>
        <form wire:submit.prevent='login' class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg border sm:p-6 lg:p-8">
            @if (session('error'))
            <div class="alert alert-error">
                <svg width="32" height="32" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M24 4C12.96 4 4 12.96 4 24C4 35.04 12.96 44 24 44C35.04 44 44 35.04 44 24C44 12.96 35.04 4 24 4ZM24 26C22.9 26 22 25.1 22 24V16C22 14.9 22.9 14 24 14C25.1 14 26 14.9 26 16V24C26 25.1 25.1 26 24 26ZM26 34H22V30H26V34Z" fill="#E92C2C" />
                </svg>
                <div class="flex flex-col">
                    <span class="text-content2">{{ session('error') }}</span>
                </div>
            </div>
            @endif
            <div>
                <label for="email" class="sr-only">Email</label>
                <div class="relative">
                    <input wire:model='email' type="email" class="w-full rounded-lg border-gray-200 border p-4 pe-12 text-sm shadow-sm"
                        placeholder="Enter email" />

                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </span>
                </div>
                @error('email') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password" class="sr-only">Password</label>

                <div class="relative">
                    <input wire:model='password' type="password" class="w-full rounded-lg border-gray-200 border p-4 pe-12 text-sm shadow-sm"
                        placeholder="Enter password" />

                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                </div>
                @error('password') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
            </div>

            <button wire:loading.attr='disabled' type="submit"
                class="block mb-4 w-full disabled:bg-slate-400 disabled:cursor-not-allowed rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">
                <span wire:loading.remove>Login</span>
                <span wire:loading>Loading ...</span>
            </button>
            <div>
                <a class="text-xs" wire:navigate href="/en">Go to website</a>
            </div>
        </form>
    </div>
</div>
