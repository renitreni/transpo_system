<div class="relative dropdown ">
    <label class="my-2 btn btn-sm" tabindex="0">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>
        @if ($users->unreadNotifications->count() != 0)
        <span class="text-rose-600">{{ $users->unreadNotifications->count() }}</span>
        @endif
    </label>
    <div class="dropdown-menu md:w-[450px] dropdown-menu-bottom-left">
        <h2 class="p-2 font-bold pointer-events-none">Notifications</h2>
        <div class="space-y-1 ">
            @forelse ($users->unreadNotifications as $notification )
            <a tabindex="-1" wire:click="markAsRead('{{$notification->data['rent_id']}}','{{$notification->id}}')" class="border shadow dropdown-item border-black/10">
                <div class="flex justify-between">
                    <p class="text-sm font-medium">{{ $notification->data['msg']}}</p>
                    <p class="text-xs font-normal text-slate-500">{{ $notification->created_at->diffForHumans() }}</p>
                </div>
                <small>{{ date('F d,Y',strtotime($notification->data['date']))}}</small>
            </a>
            @empty
                <a tabindex="-1" class="text-sm dropdown-item">No notification</a>
            @endforelse
        </div>
    </div>
</div>
{{-- , --}}
