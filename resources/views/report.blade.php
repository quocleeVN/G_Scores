<x-layouts.app>
    <h2 class="text-2xl font-bold mb-6">Thống kê điểm thi theo môn</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($statistics as $subject => $data)
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 capitalize">{{ str_replace('_', ' ', $subject) }}</h3>
                <canvas id="chart_{{ $subject }}"></canvas>
            </div>
        @endforeach
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @foreach($statistics as $subject => $data)
                new Chart(document.getElementById('chart_{{ $subject }}').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: ['< 4', '4-<6', '6-<8', '>=8'],
                        datasets: [{
                            label: 'Số thí sinh',
                            data: [{{ $data['<4'] }}, {{ $data['4-6'] }}, {{ $data['6-8'] }}, {{ $data['>=8'] }}],
                            backgroundColor: ['#EF4444', '#F59E0B', '#3B82F6', '#10B981'],
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true } }
                    }
                });
            @endforeach
        });
    </script>
</x-layouts.app>