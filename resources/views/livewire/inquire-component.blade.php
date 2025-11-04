<section class="bg-gray-2 max-w-screen-sm mx-auto rounded-xl">
	<div class="p-8 shadow-lg">
        <div class="mb-3">
            <h1 class="text-3xl font-bold">{{ trans('send_inquiry') }}</h1>
            <small class="italic font-light">{{ trans('all_fields_are_required') }}</small>
        </div>

        @include('success.success')
		<form class="space-y-4" wire:submit='send'>
			<div class="w-full">
				<label class="sr-only" for="name">Name</label>
				<input wire:model='FullName' autocomplete="off" class="input focus:outline-blue-400  rounded placeholder:text-xs input-solid max-w-full" placeholder="{{ trans('fullname') }}" type="text" id="name" />
                @error('FullName') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
			</div>

			<div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
				<div>
					<label class="sr-only" for="email">Email</label>
					<input wire:model='Email' autocomplete="off" class="input focus:outline-blue-400  rounded placeholder:text-xs input-solid" placeholder="{{ trans('email_address') }}" type="email" id="email" />
                    @error('Email') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
				</div>

				<div>
					<label class="sr-only" for="phone">Phone</label>
					<input wire:model='PhoneNumber' autocomplete="off" class="input focus:outline-blue-400  rounded placeholder:text-xs input-solid" placeholder="{{ trans('phone_number') }}" type="tel" id="phone" />
                    @error('PhoneNumber') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
				</div>
			</div>

			<div class="w-full">
				<label class="sr-only" for="message">Message</label>
				<textarea wire:model='Message' class="textarea focus:outline-blue-400 placeholder:text-xs textarea-solid max-w-full" placeholder="{{ trans('message') }}" rows="8" id="message"></textarea>
                @error('Message') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
			</div>

			<div class="mt-4">
				<button type="submit" class="rounded-lg btn btn-primary btn-block">
                    <span wire:loading.remove>{{ trans('send_inquiry') }}</span>
                    <span wire:loading>Sending...</span>
                </button>
			</div>
		</form>
	</div>
</section>
