<div>
    <div >
        <div>
            <h1 class="text-2xl font-bold">{{ trans('dashboard') }}</h1>
            <small>Sultanalfouzanco</small>
        </div>

        <div class="mt-[40px] w-full flex ">
            @include('livewire.admin.dashboard.includes.chart')
            @include('livewire.admin.dashboard.includes.logs')
        </div>

        <div class="mt-8 py-3 flex gap-5 w-full">
            @include('livewire.admin.dashboard.includes.total')
        </div>
    </div>
</div>
