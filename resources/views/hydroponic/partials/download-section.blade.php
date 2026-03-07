<section>
    <div class="bg-card border border-border/50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-foreground flex items-center gap-2 mb-4">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Download Weekly Report
        </h3>
        <p class="text-sm text-muted-foreground mb-4">
            Generate and download a comprehensive PDF report of your hydroponic system's weekly performance, including pH levels, PPM readings, water consumption, and nutrient dosing history.
        </p>

        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <button class="flex items-center gap-2 px-4 py-2.5 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors text-sm font-medium"
                    onclick="window.location.href = '{{ route('hydroponic.report.download') }}'">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Download Weekly Report (PDF)
            </button>
            <p class="text-xs text-muted-foreground">
                Last generated: {{ $lastUpdate ?? now()->format('M d, Y') }}
            </p>
        </div>
    </div>
</section>
