<x-modal name="send-email-modal" :show="false">
    <div class="p-6">
        <div class="mb-5">
            <h1 class="text-xl font-medium">Send Email / إرسال البريد الإلكتروني</h1>
        </div>
        @include('success.success')
        <form wire:submit='send' class="grid grid-cols-1 gap-2 sm:grid-cols-2">
            {{-- <div>
                <label for="sender" class="block text-xs font-medium text-gray-700"> Sender </label>

                <input wire:model='sender' type="email" id="sender" placeholder=""
                    class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
            </div> --}}
            <div>
                <label for="recipient" class="block text-xs font-medium text-gray-700"> Recipient / المستلم</label>

                <input wire:model='recipient' type="email" id="recipient" placeholder=""
                    class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
            </div>

            <div>
                <label for="subject" class="block text-xs font-medium text-gray-700"> Subject / الموضوع </label>
                <input wire:model='subject' type="text" id="subject" placeholder=""
                    class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" />
            </div>

            <div class="mt-2 col-span-full">
                <label for="body" class="block text-xs font-medium text-gray-700"> Body / النص </label>
                <textarea wire:model='body' id="body"  rows="5" class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm"></textarea>
            </div>

            <div class="flex justify-end mt-5 col-span-full">
                <button wire:target='send' wire:loading.attr='disabled' type="submit" class="btn btn-sm gap-x-1 btn-outline-primary">
                    <span wire:target='send' wire:loading.remove>Send</span>
                    <span wire:target='send' wire:loading>Sending...</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                      </svg>

                </button>
            </div>
        </form>
    </div>
</x-modal>
