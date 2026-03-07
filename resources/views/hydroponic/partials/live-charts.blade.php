<section>
    <h2 class="text-lg font-semibold text-foreground mb-4">
        Live Sensor Monitoring
    </h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- pH Trend Chart -->
        <div class="bg-card border border-border/50 rounded-lg p-6">
            <h3 class="text-sm font-medium text-muted-foreground mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                pH Trend (24 Hours)
            </h3>
            <div class="h-64">
                <canvas id="phChart"></canvas>
            </div>
        </div>

        <!-- PPM Trend Chart -->
        <div class="bg-card border border-border/50 rounded-lg p-6">
            <h3 class="text-sm font-medium text-muted-foreground mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                PPM Trend (24 Hours)
            </h3>
            <div class="h-64">
                <canvas id="ppmChart"></canvas>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chartData = @json($liveChartData ?? []);
    const hours = chartData.map(d => d.time);
    const phData = chartData.map(d => d.ph);
    const ppmData = chartData.map(d => d.ppm);

    const chartConfig = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: {
                grid: { color: 'rgba(0,0,0,0.05)' },
                ticks: { font: { size: 11 } }
            },
            y: {
                grid: { color: 'rgba(0,0,0,0.05)' },
                ticks: { font: { size: 11 } }
            }
        }
    };

    // pH Chart
    if (document.getElementById('phChart')) {
        new Chart(document.getElementById('phChart'), {
            type: 'line',
            data: {
                labels: hours,
                datasets: [{
                    label: 'pH',
                    data: phData,
                    borderColor: 'hsl(var(--primary))',
                    backgroundColor: 'hsl(var(--primary) / 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: 'hsl(var(--primary))',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6
                }]
            },
            options: {
                ...chartConfig,
                scales: {
                    ...chartConfig.scales,
                    y: { ...chartConfig.scales.y, min: 5, max: 8 }
                }
            }
        });
    }

    // PPM Chart
    if (document.getElementById('ppmChart')) {
        new Chart(document.getElementById('ppmChart'), {
            type: 'line',
            data: {
                labels: hours,
                datasets: [{
                    label: 'PPM',
                    data: ppmData,
                    borderColor: 'hsl(var(--accent))',
                    backgroundColor: 'hsl(var(--accent) / 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: 'hsl(var(--accent))',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6
                }]
            },
            options: {
                ...chartConfig,
                scales: {
                    ...chartConfig.scales,
                    y: { ...chartConfig.scales.y, min: 500, max: 1200 }
                }
            }
        });
    }
});
</script>
@endpush
