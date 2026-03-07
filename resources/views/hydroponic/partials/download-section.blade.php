<div class="glass-card rounded-xl p-5">
    <h3 class="text-lg font-semibold text-foreground mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        Download Weekly Report
    </h3>

    <p class="text-sm text-muted-foreground mb-4">
        Unduh laporan analisis mingguan dalam format PDF untuk dokumentasi dan arsip.
    </p>

    <div class="flex flex-col sm:flex-row gap-3">
        <a href="{{ route('hydroponic.report.download', ['format' => 'pdf']) }}"
           class="flex-1 py-2.5 px-4 bg-primary text-primary-foreground rounded-lg text-sm font-medium hover:bg-primary/90 transition-colors flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Download PDF
        </a>
        <a href="{{ route('hydroponic.report.download', ['format' => 'excel']) }}"
           class="flex-1 py-2.5 px-4 bg-secondary text-secondary-foreground rounded-lg text-sm font-medium hover:bg-secondary/80 transition-colors flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Download Excel
        </a>
    </div>

    <p class="text-xs text-muted-foreground mt-3">
        Laporan terakhir: {{ $lastReportDate ?? now()->subDays(7)->format('d M Y') }}
    </p>
</div>
