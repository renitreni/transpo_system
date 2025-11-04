<div class="mt-3 tabs">
    <div>
        <input wire:click="toggleSelected('trucks')" type="radio" id="tab-4" name="tab-2" class="tab-toggle" {{ $selected === 'trucks' ? "checked" : "" }}/>
        <label for="tab-4" class="px-6 tab tab-bordered">Trucks</label>
    </div>

    <input wire:click="toggleSelected('wheel_loader')" type="radio" id="tab-5" name="tab-2" class="tab-toggle" {{ $selected === 'wheel_loader' ? "checked" : "" }}/>
    <label for="tab-5" class="px-6 tab tab-bordered">Wheel Loader</label>

    <input wire:click="toggleSelected('forklift')" type="radio" id="tab-6" name="tab-2" class="tab-toggle" {{ $selected === 'forklift' ? "checked" : "" }}/>
    <label for="tab-6" class="px-6 tab tab-bordered">Forklift</label>
</div>
