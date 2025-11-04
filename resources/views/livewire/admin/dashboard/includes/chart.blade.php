<div class="flex flex-wrap w-full h-full ">
    <div class="w-full h-[300px]">
        <canvas id="sales_chart"></canvas>
    </div>
    <div class="w-full h-[300px]">
        <canvas id="delivery_Chart"></canvas>
    </div>
    {{-- Data --}}
    {{--      Object.keys($wire.data_deliveries) the labels (keys),
     Object.values($wire.data_deliveries), the data (value) --}}
</div>

@assets
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
<script>

    const sale_Chart = document.getElementById('sales_chart');
    const delivery_Chart = document.getElementById('delivery_Chart');
    new Chart(sale_Chart, {
      type: 'line',
      data: {
        labels: Object.keys($wire.data_deliveries),
        datasets: [{
          label: `Sales Report Chart`,
          data: Object.values($wire.data_deliveries),
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    new Chart(delivery_Chart, {
      type: 'bar',
      data: {
        labels:  Object.keys($wire.data_deliveries),
        datasets: [{
          label: `Deliveries per month`,
          data: Object.values($wire.data_deliveries),
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
</script>
@endscript
