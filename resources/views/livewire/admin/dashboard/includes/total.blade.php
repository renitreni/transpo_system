<div class="w-full p-3 border border-blue-400 rounded-md shadow-sm min-h-min max-w-64 bg-gradient-to-r from-blue-500 to-blue-300">
    <h1 class="text-2xl font-bold text-blue-100">Total Delivery</h1>
    <div class="flex flex-col gap-2 px-2 mt-3 text-white">
        <div class="flex justify-between p-2 text-xs text-blue-600 bg-blue-200 rounded ">
            <span>This Month: </span>
            <span>{{ $currentMonthDeliveries }}</span>
        </div>
        <div class="flex justify-between p-2 text-xs text-blue-600 bg-blue-200 rounded ">
            <span>Last Month: </span>
            <span>{{ $previousMonthDeliveries }}</span>
        </div>
    </div>
</div>

<div class="w-full p-3 border border-blue-400 rounded-md shadow-sm min-h-min max-w-64 bg-gradient-to-r from-blue-500 to-blue-300">
    <h1 class="text-2xl font-bold text-blue-100">Total Inquiry</h1>
    <div class="flex flex-col gap-2 px-2 mt-3 text-white">
        <div class="flex justify-between p-2 text-xs text-blue-600 bg-blue-200 rounded ">
            <span>This Month: </span>
            <span>{{ $currentInquiries }}</span>
        </div>
        <div class="flex justify-between p-2 text-xs text-blue-600 bg-blue-200 rounded ">
            <span>Last Month: </span>
            <span>{{ $previousInquiries }} </span>
        </div>
    </div>
</div>


