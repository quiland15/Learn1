<section>
    <h2 class="text-lg font-semibold text-foreground mb-4">
        Weekly Hydroponic Analysis
    </h2>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div class="bg-card border border-border/50 rounded-lg p-4">
            <p class="text-xs text-muted-foreground">Average pH</p>
            <p class="text-2xl font-bold text-foreground mt-1">{{ $weeklyStats['avgPh'] ?? 6.2 }}</p>
            <div class="flex flex-col items-center gap-1 mt-2">
                @if(($weeklyStats['phTrend'] ?? 'stable') === 'up')
                    <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.935M13 16h-1v5m0 0h1v-5m-6-5v5m0 0H7v-5"></path>
                    </svg>
                @elseif(($weeklyStats['phTrend'] ?? 'stable') === 'down')
                    <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.935M13 16h-1v5m0 0h1v-5m-6 0v-5m0 0H7v5"></path>
                    </svg>
                @endif
            </div>
        </div>

        <div class="bg-card border border-border/50 rounded-lg p-4">
            <p class="text-xs text-muted-foreground">Average PPM</p>
            <p class="text-2xl font-bold text-foreground mt-1">{{ $weeklyStats['avgPpm'] ?? 847 }}</p>
            <div class="flex flex-col items-center gap-1 mt-2">
                @if(($weeklyStats['ppmTrend'] ?? 'stable') === 'up')
                    <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.935M13 16h-1v5m0 0h1v-5m-6-5v5m0 0H7v-5"></path>
                    </svg>
                @elseif(($weeklyStats['ppmTrend'] ?? 'stable') === 'down')
                    <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.935M13 16h-1v5m0 0h1v-5m-6 0v-5m0 0H7v5"></path>
                    </svg>
                @endif
            </div>
        </div>

        <div class="bg-card border border-border/50 rounded-lg p-4">
            <p class="text-xs text-muted-foreground">Water Usage</p>
            <p class="text-2xl font-bold text-foreground mt-1">{{ $weeklyStats['waterUsage'] ?? 42 }}L</p>
            <p class="text-xs text-muted-foreground mt-2">This week</p>
        </div>

        <div class="bg-card border border-border/50 rounded-lg p-4">
            <p class="text-xs text-muted-foreground">Nutrient Usage</p>
            <p class="text-2xl font-bold text-foreground mt-1">{{ $weeklyStats['nutrientUsage'] ?? 150 }}ml</p>
            <p class="text-xs text-muted-foreground mt-2">This week</p>
        </div>
    </div>

    <!-- Weekly Chart -->
    <div class="bg-card border border-border/50 rounded-lg p-6">
        <h3 class="text-sm font-medium text-muted-foreground mb-4">Weekly Trend pH & PPM</h3>
        <div class="h-72">
            <canvas id="weeklyChart"></canvas>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chartData = @json($weeklyChartData ?? []);
    const days = chartData.map(d => d.day);
    const phData = chartData.map(d => d.ph);
    const ppmData = chartData.map(d => d.ppm);

    if (document.getElementById('weeklyChart')) {
        new Chart(document.getElementById('weeklyChart'), {
            type: 'line',
            data: {
                labels: days,
                datasets: [
                    {
                        label: 'pH',
                        data: phData,
                        borderColor: 'hsl(var(--primary))',
                        backgroundColor: 'hsl(var(--primary) / 0.1)',
                        yAxisID: 'y',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointBackgroundColor: 'hsl(var(--primary))',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    },
                    {
                        label: 'PPM',
                        data: ppmData,
                        borderColor: 'hsl(var(--accent))',
                        backgroundColor: 'hsl(var(--accent) / 0.1)',
                        yAxisID: 'y1',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointBackgroundColor: 'hsl(var(--accent))',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { position: 'top', display: true }
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { font: { size: 11 } }
                    },
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        min: 5,
                        max: 8,
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        title: { display: true, text: 'pH' }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        min: 500,
                        max: 1200,
                        grid: { drawOnChartArea: false },
                        title: { display: true, text: 'PPM' }
                    }
                }
            }
        });
    }
});
</script>
@endpush
