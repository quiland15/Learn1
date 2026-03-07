<header class="glass-card border-b border-white/50">
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-13.66l-.71.71M4.05 19.95l-.71.71M21 12h-1M4 12H3m16.95 7.95l-.71-.71M4.76 4.76l-.71-.71M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-foreground">Hydroponic Monitoring System</h1>
                    <p class="text-sm text-muted-foreground">Sistem Pemantauan Selada Hidroponik</p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-medium"
                     :class="systemStatus === 'online' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'">
                    <span class="w-2 h-2 rounded-full animate-pulse"
                          :class="systemStatus === 'online' ? 'bg-green-500' : 'bg-red-500'"></span>
                    <span x-text="systemStatus === 'online' ? 'Online' : 'Offline'"></span>
                </div>

                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-medium"
                     :class="sensorConnected ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span x-text="sensorConnected ? 'Sensor Terhubung' : 'Sensor Terputus'"></span>
                </div>

                <div class="flex items-center gap-2 px-3 py-1.5 bg-muted rounded-full text-sm text-muted-foreground">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Update: <span x-text="lastUpdate"></span></span>
                </div>
            </div>
        </div>
    </div>
</header>
