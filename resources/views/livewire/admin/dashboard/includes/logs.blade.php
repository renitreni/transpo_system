<aside class="ml-7 w-full">
    <h1 class="text-xl font-bold bg-blue-500 rounded p-2.5 text-white">Logs</h1>
    <div class="mt-4 h-[480px] overflow-y-auto">
        @foreach ($logs as $log )
        <div wire:key='{{ $log->id }}' class="flex flex-col mt-2 pl-3 relative before:absolute {{ $log->type == "Delete" ? "before:bg-rose-500": ($log->type == "Receipt Download" ? "before:bg-pink-400" : ($log->type == "Order Update" ? "before:bg-green-300" : "before:bg-blue-400")) }}  before:w-1 before:h-full before:left-0 before:top-0 before:content-['']">
            <span class="text-sm font-medium"><span class="">{{ $log->type }}</span>: {{ $log->log }}</span>
            <span class="text-xs">{{ date('D F d, Y @ g:i a',strtotime($log->created_at)) }}</span>
        </div>
        @endforeach
    </div>
</aside>

