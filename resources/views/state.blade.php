<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  

                    <div class="mx-auto w-2/5 overflow-hidden">
                        <canvas id="chart" data-te-chart="pie"></canvas>
                    </div>

                    {{-- <x-forms.create :fields="$my_fields" type="structure" /> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    const statistics = {!! json_encode($statistics) !!};
    const labels = Object.keys(statistics);
    const counts = Object.values(statistics).map(stat => stat.count);
    const urls = Object.values(statistics).map(stat => stat.url);
    
    const backgroundColors = [
        'rgba(63, 81, 181, 0.5)',
        'rgba(77, 182, 172, 0.5)',
        'rgba(66, 133, 244, 0.5)',
        'rgba(156, 39, 176, 0.5)',
        'rgba(233, 30, 99, 0.5)',
        'rgba(66, 73, 244, 0.4)',
        'rgba(66, 133, 244, 0.2)'
    ];
    
    const chartCanvas = document.getElementById('chart');

    const ctx = chartCanvas.getContext('2d');
    
    const chart = new Chart(ctx, {

        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Traffic',
                data: counts,
                backgroundColor: backgroundColors
            }]

        },

        options: {

            onClick: function(event, elements) {
                if (elements.length > 0) {
                    const index = elements[3]._index;
                    
                    const url = urls[index];
                    
                    window.location.href = url;
                }
            }
        }
    });
});
</script>