<header class="border-b border-border/50 bg-gradient-to-r from-primary/5 to-accent/5 shadow-sm">
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary">
                    <svg class="w-6 h-6 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-foreground">
                        Hydroponic Lettuce Smart Monitoring
                    </h1>
                    <p class="text-sm text-muted-foreground">
                        Real-time monitoring and nutrient management system
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <!-- Online Status Badge -->
                <div class="flex items-center gap-2 px-3 py-2 rounded-full bg-primary/10 border border-primary/20">
                    <div class="w-3 h-3 rounded-full bg-primary animate-pulse"></div>
                    <span class="text-xs font-medium text-primary">
                        {{ $systemStatus === 'online' ? 'Online' : 'Offline' }}
                    </span>
                </div>

                <!-- Sensor Status Badge -->
                <div class="flex items-center gap-2 px-3 py-2 rounded-full bg-accent/10 border border-accent/20">
                    <svg class="w-3.5 h-3.5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                    </svg>
                    <span class="text-xs font-medium text-accent">
                        {{ $sensorConnected ? 'Sensor Connected' : 'Sensor Disconnected' }}
                    </span>
                </div>

                <!-- Last Update Time -->
                <div class="flex items-center gap-2 px-3 py-2 rounded-full bg-muted">
                    <svg class="w-3.5 h-3.5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-xs text-muted-foreground">
                        Updated {{ $lastUpdate }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
