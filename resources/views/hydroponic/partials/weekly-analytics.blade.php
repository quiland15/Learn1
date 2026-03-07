<section>
    <h2 class="text-lg font-semibold text-foreground mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>
        Weekly Analytics Panel
    </h2>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="glass-card rounded-xl p-4">
            <p class="text-sm text-muted-foreground">Rata-rata pH</p>
            <p class="text-2xl font-bold text-foreground">{{ $avgPh ?? '6.2' }}</p>
            <p class="text-xs text-green-600 flex items-center gap-1 mt-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                +0.1 dari minggu lalu
            </p>
        </div>
        <div class="glass-card rounded-xl p-4">
            <p class="text-sm text-muted-foreground">Rata-rata PPM</p>
            <p class="text-2xl font-bold text-foreground">{{ $avgPpm ?? '842' }}</p>
            <p class="text-xs text-green-600 flex items-center gap-1 mt-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                +15 dari minggu lalu
            </p>
        </div>
        <div class="glass-card rounded-xl p-4">
            <p class="text-sm text-muted-foreground">Penggunaan Air</p>
            <p class="text-2xl font-bold text-foreground">{{ $waterUsage ?? '45' }}L</p>
            <p class="text-xs text-muted-foreground mt-1">Total minggu ini</p>
        </div>
        <div class="glass-card rounded-xl p-4">
            <p class="text-sm text-muted-foreground">Penggunaan Nutrisi</p>
            <p class="text-2xl font-bold text-foreground">{{ $nutrientUsage ?? '320' }}ml</p>
            <p class="text-xs text-muted-foreground mt-1">Total minggu ini</p>
        </div>
    </div>

    <div class="glass-card rounded-xl p-5">
        <h3 class="text-sm font-medium text-muted-foreground mb-4">Tren Mingguan pH & PPM</h3>
        <div class="h-72">
            <canvas id="weeklyChart"></canvas>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const days = @json($weekDays ?? ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']);
    const weeklyPh = @json($weeklyPh ?? [6.1, 6.2, 6.3, 6.1, 6.2, 6.4, 6.2]);
    const weeklyPpm = @json($weeklyPpm ?? [820, 840, 830, 860, 850, 870, 850]);

    new Chart(document.getElementById('weeklyChart'), {
        type: 'line',
        data: {
            labels: days,
            datasets: [
                { label: 'pH', data: weeklyPh, borderColor: 'oklch(0.52 0.14 155)', backgroundColor: 'oklch(0.52 0.14 155 / 0.1)', yAxisID: 'y', tension: 0.4, fill: true },
                { label: 'PPM', data: weeklyPpm, borderColor: 'oklch(0.55 0.12 200)', backgroundColor: 'oklch(0.55 0.12 200 / 0.1)', yAxisID: 'y1', tension: 0.4, fill: true }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: { legend: { position: 'top', labels: { color: 'oklch(0.48 0.03 155)' } } },
            scales: {
                x: { grid: { color: 'rgba(0,0,0,0.05)' }, ticks: { color: 'oklch(0.48 0.03 155)' } },
                y: { type: 'linear', display: true, position: 'left', min: 5, max: 8, grid: { color: 'rgba(0,0,0,0.05)' }, ticks: { color: 'oklch(0.52 0.14 155)' }, title: { display: true, text: 'pH', color: 'oklch(0.52 0.14 155)' } },
                y1: { type: 'linear', display: true, position: 'right', min: 500, max: 1200, grid: { drawOnChartArea: false }, ticks: { color: 'oklch(0.55 0.12 200)' }, title: { display: true, text: 'PPM', color: 'oklch(0.55 0.12 200)' } }
            }
        }
    });
});
</script>
@endpush
