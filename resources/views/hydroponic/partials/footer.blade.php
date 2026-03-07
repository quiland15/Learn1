<footer class="glass-card border-t border-white/50 mt-8">
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-muted-foreground">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
                <span class="text-sm">Smart Hydroponic Monitoring System for Lettuce</span>
            </div>

            <div class="flex items-center gap-4 text-sm text-muted-foreground">
                <a href="{{ route('hydroponic.docs') }}" class="hover:text-primary transition-colors">Dokumentasi</a>
                <a href="{{ route('hydroponic.support') }}" class="hover:text-primary transition-colors">Bantuan</a>
                <span>&copy; {{ date('Y') }} HydroMonitor</span>
            </div>
        </div>
    </div>
</footer>
