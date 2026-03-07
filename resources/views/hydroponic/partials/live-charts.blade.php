<section>
    <h2 class="text-lg font-semibold text-foreground mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
        </svg>
        Live Sensor Monitoring (24 Jam)
    </h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="glass-card rounded-xl p-5">
            <h3 class="text-sm font-medium text-muted-foreground mb-4">pH Level - 24 Jam Terakhir</h3>
            <div class="h-64">
                <canvas id="phChart"></canvas>
            </div>
        </div>
        <div class="glass-card rounded-xl p-5">
            <h3 class="text-sm font-medium text-muted-foreground mb-4">PPM Level - 24 Jam Terakhir</h3>
            <div class="h-64">
                <canvas id="ppmChart"></canvas>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const hours = @json($chartHours ?? ['00:00', '04:00', '08:00', '12:00', '16:00', '20:00', '24:00']);
    const phData = @json($phData ?? [6.1, 6.3, 6.2, 6.0, 6.4, 6.2, 6.3]);
    const ppmData = @json($ppmData ?? [820, 850, 830, 870, 860, 840, 850]);

    const chartConfig = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: {
                grid: { color: 'rgba(0,0,0,0.05)' },
                ticks: { color: 'oklch(0.48 0.03 155)' }
            },
            y: {
                grid: { color: 'rgba(0,0,0,0.05)' },
                ticks: { color: 'oklch(0.48 0.03 155)' }
            }
        }
    };

    new Chart(document.getElementById('phChart'), {
        type: 'line',
        data: {
            labels: hours,
            datasets: [{
                label: 'pH',
                data: phData,
                borderColor: 'oklch(0.52 0.14 155)',
                backgroundColor: 'oklch(0.52 0.14 155 / 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
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

    new Chart(document.getElementById('ppmChart'), {
        type: 'line',
        data: {
            labels: hours,
            datasets: [{
                label: 'PPM',
                data: ppmData,
                borderColor: 'oklch(0.55 0.12 200)',
                backgroundColor: 'oklch(0.55 0.12 200 / 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
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
});
</script>
@endpush
