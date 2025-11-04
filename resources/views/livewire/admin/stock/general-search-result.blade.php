<div>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Search Result</h1>
        <a wire:navigate class="p-2 text-sm text-white bg-blue-500 rounded" href="{{ route('admin_ManageStocks',['lang'=>'en','type'=>'trucks']) }}">Back</a>
    </div>
    <br>
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5">
        @forelse ( $data as $arrayValues )
        @foreach ($arrayValues->getAttributes() as $key => $value )
        @if($key != "id" && $key != "created_at" && $key != "updated_at")
        <div class="p-2 border rounded shadow max-w-80">
            <small> {{ $key != "isActive" ? $key : "Status" }} : </small>
            <h4> {{ $value }} {{ $key == "Size" || $key == "Height" ? " meters" : "" }}</h4>
        </div>
        @endif
        @endforeach
        @empty
        <h4>No result found</h4>
        @endforelse
    </div>
</div>
