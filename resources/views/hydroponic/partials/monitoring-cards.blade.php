<section class="mb-8">
    <h2 class="text-lg font-semibold text-foreground mb-4">
        Real-Time Sensor Dashboard
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- PPM Card -->
        <div class="glass-card rounded-xl p-5 transition-all duration-200 hover:shadow-md">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2 text-sm font-medium text-muted-foreground">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    PPM Sensor
                </div>
            </div>
            <div class="flex items-end gap-2 mb-3">
                <span class="text-3xl font-bold text-foreground" x-text="ppm"></span>
                <span class="text-sm text-muted-foreground mb-1">ppm</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-xs px-2 py-1 rounded-full font-medium"
                      :class="getPpmStatus().class"
                      x-text="getPpmStatus().label"></span>
                <span class="text-xs text-muted-foreground">Ideal: 600-1000</span>
            </div>
            <div class="mt-4">
                <div class="h-2 bg-muted rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-red-400 via-green-400 to-red-400 rounded-full transition-all duration-500"
                         :style="'width: ' + Math.min((ppm / 1500) * 100, 100) + '%'"></div>
                </div>
                <div class="flex justify-between text-xs text-muted-foreground mt-1">
                    <span>0</span>
                    <span>750</span>
                    <span>1500</span>
                </div>
            </div>
        </div>

        <!-- pH Card -->
        <div class="glass-card rounded-xl p-5 transition-all duration-200 hover:shadow-md">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2 text-sm font-medium text-muted-foreground">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                    pH Sensor
                </div>
            </div>
            <div class="flex items-end gap-2 mb-3">
                <span class="text-3xl font-bold text-foreground" x-text="ph.toFixed(1)"></span>
                <span class="text-sm text-muted-foreground mb-1">pH</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-xs px-2 py-1 rounded-full font-medium"
                      :class="getPhStatus().class"
                      x-text="getPhStatus().label"></span>
                <span class="text-xs text-muted-foreground">Ideal: 5.5-6.5</span>
            </div>
            <div class="mt-4">
                <div class="h-2 bg-gradient-to-r from-red-400 via-yellow-400 via-green-400 via-blue-400 to-purple-400 rounded-full relative">
                    <div class="absolute w-3 h-3 bg-white border-2 border-foreground rounded-full -top-0.5 transition-all duration-500"
                         :style="'left: calc(' + ((ph / 14) * 100) + '% - 6px)'"></div>
                </div>
                <div class="flex justify-between text-xs text-muted-foreground mt-1">
                    <span>0</span>
                    <span>7</span>
                    <span>14</span>
                </div>
            </div>
        </div>

        <!-- Water Level Card -->
        <div class="glass-card rounded-xl p-5 transition-all duration-200 hover:shadow-md">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2 text-sm font-medium text-muted-foreground">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M17 21H7a4 4 0 01-4-4v-6a4 4 0 014-4h10a4 4 0 014 4v6a4 4 0 01-4 4z" />
                    </svg>
                    Water Level
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative w-20 h-20">
                    <svg class="w-20 h-20 transform -rotate-90">
                        <circle cx="40" cy="40" r="35" stroke="currentColor" stroke-width="6" fill="none" class="text-muted" />
                        <circle cx="40" cy="40" r="35" stroke="currentColor" stroke-width="6" fill="none"
                                class="text-blue-500 transition-all duration-500"
                                :stroke-dasharray="219.9"
                                :stroke-dashoffset="219.9 - (219.9 * waterLevel / 100)" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-bold text-foreground" x-text="waterLevel + '%'"></span>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium" :class="getWaterLevelStatus().class" x-text="getWaterLevelStatus().label"></p>
                    <p class="text-xs text-muted-foreground mt-1">Min: 30%</p>
                </div>
            </div>
        </div>

        <!-- Nutrient Recommendation Card -->
        <div class="glass-card rounded-xl p-5 transition-all duration-200 hover:shadow-md">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2 text-sm font-medium text-muted-foreground">
                    <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                    Rekomendasi Nutrisi
                </div>
            </div>
            <p class="text-sm text-foreground font-medium mb-4" x-text="nutrientRecommendation"></p>
            <button @click="triggerNutrient(20)"
                    :disabled="isDosingNutrient"
                    class="w-full py-2 px-4 bg-primary text-primary-foreground rounded-lg text-sm font-medium hover:bg-primary/90 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                <template x-if="isDosingNutrient">
                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </template>
                <span x-text="isDosingNutrient ? 'Memproses...' : 'Trigger Nutrient Pump'"></span>
            </button>
        </div>
    </div>
</section>
