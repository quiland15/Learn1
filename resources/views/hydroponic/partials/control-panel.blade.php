<section>
    <h2 class="text-lg font-semibold text-foreground mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        System Control Panel
    </h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
        <div class="glass-card rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-medium text-foreground">Status Pompa</h3>
                <span class="px-2.5 py-1 rounded-full text-xs font-medium"
                      :class="pumpStatus === 'on' ? 'bg-green-100 text-green-700' : 'bg-muted text-muted-foreground'"
                      x-text="pumpStatus === 'on' ? 'ON' : 'OFF'"></span>
            </div>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                     :class="pumpStatus === 'on' ? 'bg-green-100' : 'bg-muted'">
                    <svg class="w-6 h-6" :class="pumpStatus === 'on' ? 'text-green-600' : 'text-muted-foreground'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-muted-foreground">Aktivasi Terakhir</p>
                    <p class="font-medium text-foreground" x-text="lastPumpActivation"></p>
                </div>
            </div>
            <div class="flex gap-2">
                <button @click="showStartPumpModal = true"
                        :disabled="pumpStatus === 'on' || isLoadingPump"
                        class="flex-1 py-2 px-4 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    Start Pump
                </button>
                <button @click="showStopPumpModal = true"
                        :disabled="pumpStatus === 'off' || isLoadingPump"
                        class="flex-1 py-2 px-4 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    Stop Pump
                </button>
            </div>
        </div>

        <div class="glass-card rounded-xl p-5">
            <h3 class="font-medium text-foreground mb-4">Kontrol Dosis Nutrisi</h3>
            <div class="mb-4 p-3 bg-primary/10 rounded-lg">
                <p class="text-xs text-muted-foreground">Dosis yang Direkomendasikan</p>
                <p class="text-xl font-bold text-primary">20 ml</p>
            </div>
            <p class="text-sm text-muted-foreground mb-3">Pilih jumlah dosis:</p>
            <div class="grid grid-cols-3 gap-2">
                <button @click="triggerNutrient(10)" :disabled="isDosingNutrient" class="py-2.5 px-3 bg-secondary text-secondary-foreground rounded-lg text-sm font-medium hover:bg-secondary/80 transition-colors disabled:opacity-50 flex items-center justify-center gap-1">
                    <template x-if="isDosingNutrient && currentDose === 10"><svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg></template>
                    <span>10 ml</span>
                </button>
                <button @click="triggerNutrient(20)" :disabled="isDosingNutrient" class="py-2.5 px-3 bg-primary text-primary-foreground rounded-lg text-sm font-medium hover:bg-primary/90 transition-colors disabled:opacity-50 flex items-center justify-center gap-1">
                    <template x-if="isDosingNutrient && currentDose === 20"><svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg></template>
                    <span>20 ml</span>
                </button>
                <button @click="triggerNutrient(30)" :disabled="isDosingNutrient" class="py-2.5 px-3 bg-secondary text-secondary-foreground rounded-lg text-sm font-medium hover:bg-secondary/80 transition-colors disabled:opacity-50 flex items-center justify-center gap-1">
                    <template x-if="isDosingNutrient && currentDose === 30"><svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg></template>
                    <span>30 ml</span>
                </button>
            </div>
        </div>

        <div class="glass-card rounded-xl p-5">
            <h3 class="font-medium text-foreground mb-4">Kontrol pH</h3>
            <div class="mb-4 p-3 bg-accent/10 rounded-lg">
                <p class="text-xs text-muted-foreground">pH Saat Ini</p>
                <p class="text-xl font-bold text-accent" x-text="ph.toFixed(1)"></p>
            </div>
            <p class="text-sm text-muted-foreground mb-3">pH Down:</p>
            <div class="flex gap-2 mb-4">
                <button @click="adjustPh(5)" :disabled="isAdjustingPh" class="flex-1 py-2.5 px-3 bg-secondary text-secondary-foreground rounded-lg text-sm font-medium hover:bg-secondary/80 transition-colors disabled:opacity-50 flex items-center justify-center gap-1">
                    <template x-if="isAdjustingPh"><svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg></template>
                    <span>5 ml</span>
                </button>
                <button @click="adjustPh(10)" :disabled="isAdjustingPh" class="flex-1 py-2.5 px-3 bg-secondary text-secondary-foreground rounded-lg text-sm font-medium hover:bg-secondary/80 transition-colors disabled:opacity-50 flex items-center justify-center gap-1">
                    <template x-if="isAdjustingPh"><svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg></template>
                    <span>10 ml</span>
                </button>
            </div>
            <div class="p-2 bg-amber-50 border border-amber-200 rounded-lg">
                <p class="text-xs text-amber-700 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    Gunakan dengan hati-hati
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <div class="glass-card rounded-xl p-5">
            <h3 class="font-medium text-foreground mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                Safety Status
            </h3>
            <div class="space-y-3">
                @php
                    $safetyAlerts = $safetyAlerts ?? [
                        ['type' => 'warning', 'message' => 'Level air di bawah 40%'],
                        ['type' => 'success', 'message' => 'Semua sensor berfungsi normal'],
                        ['type' => 'info', 'message' => 'Kalibrasi sensor terakhir: 3 hari lalu'],
                    ];
                @endphp
                @foreach($safetyAlerts as $alert)
                    <div class="flex items-center gap-3 p-3 rounded-lg
                        @if($alert['type'] === 'success') bg-green-50 border border-green-200
                        @elseif($alert['type'] === 'warning') bg-amber-50 border border-amber-200
                        @elseif($alert['type'] === 'error') bg-red-50 border border-red-200
                        @else bg-blue-50 border border-blue-200
                        @endif">
                        @if($alert['type'] === 'success')<svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        @elseif($alert['type'] === 'warning')<svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        @elseif($alert['type'] === 'error')<svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        @else<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        @endif
                        <span class="text-sm @if($alert['type'] === 'success') text-green-800 @elseif($alert['type'] === 'warning') text-amber-800 @elseif($alert['type'] === 'error') text-red-800 @else text-blue-800 @endif">{{ $alert['message'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="glass-card rounded-xl p-5">
            <h3 class="font-medium text-foreground mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Control History
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-muted-foreground border-b border-border">
                            <th class="pb-2 font-medium">Waktu</th>
                            <th class="pb-2 font-medium">Aksi</th>
                            <th class="pb-2 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @php
                            $controlHistory = $controlHistory ?? [
                                ['time' => '10:30', 'action' => 'Start Pump', 'status' => 'success'],
                                ['time' => '10:15', 'action' => 'Nutrisi +20ml', 'status' => 'success'],
                                ['time' => '09:45', 'action' => 'pH Down +5ml', 'status' => 'success'],
                                ['time' => '09:00', 'action' => 'Stop Pump', 'status' => 'success'],
                            ];
                        @endphp
                        @foreach($controlHistory as $history)
                            <tr>
                                <td class="py-2.5 text-muted-foreground">{{ $history['time'] }}</td>
                                <td class="py-2.5 text-foreground">{{ $history['action'] }}</td>
                                <td class="py-2.5">
                                    <span class="px-2 py-0.5 rounded text-xs font-medium
                                        @if($history['status'] === 'success') bg-green-100 text-green-700
                                        @elseif($history['status'] === 'pending') bg-amber-100 text-amber-700
                                        @else bg-red-100 text-red-700
                                        @endif">{{ ucfirst($history['status']) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div x-show="showStartPumpModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" @click.self="showStartPumpModal = false">
        <div class="bg-white rounded-xl p-6 max-w-sm w-full shadow-xl">
            <h3 class="text-lg font-semibold text-foreground mb-2">Konfirmasi Start Pump</h3>
            <p class="text-sm text-muted-foreground mb-4">Apakah Anda yakin ingin menyalakan pompa air?</p>
            <div class="flex gap-3">
                <button @click="showStartPumpModal = false" class="flex-1 py-2 px-4 bg-muted text-foreground rounded-lg text-sm font-medium hover:bg-muted/80 transition-colors">Batal</button>
                <button @click="startPump()" :disabled="isLoadingPump" class="flex-1 py-2 px-4 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors disabled:opacity-50 flex items-center justify-center gap-2">
                    <template x-if="isLoadingPump"><svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg></template>
                    <span>Ya, Nyalakan</span>
                </button>
            </div>
        </div>
    </div>

    <div x-show="showStopPumpModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" @click.self="showStopPumpModal = false">
        <div class="bg-white rounded-xl p-6 max-w-sm w-full shadow-xl">
            <h3 class="text-lg font-semibold text-foreground mb-2">Konfirmasi Stop Pump</h3>
            <p class="text-sm text-muted-foreground mb-4">Apakah Anda yakin ingin mematikan pompa air?</p>
            <div class="flex gap-3">
                <button @click="showStopPumpModal = false" class="flex-1 py-2 px-4 bg-muted text-foreground rounded-lg text-sm font-medium hover:bg-muted/80 transition-colors">Batal</button>
                <button @click="stopPump()" :disabled="isLoadingPump" class="flex-1 py-2 px-4 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-colors disabled:opacity-50 flex items-center justify-center gap-2">
                    <template x-if="isLoadingPump"><svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg></template>
                    <span>Ya, Matikan</span>
                </button>
            </div>
        </div>
    </div>
</section>
<style>[x-cloak]{display:none!important}</style>
