@extends('hydroponic.layouts.app')

@section('content')
<div class="min-h-screen" x-data="dashboardData()">
    <!-- Header -->
    @include('hydroponic.partials.header')

    <main class="container mx-auto px-4 py-6 space-y-6">
        <!-- Real-Time Sensor Cards -->
        @include('hydroponic.partials.monitoring-cards')

        <!-- Live Sensor Charts (24 Hours) -->
        @include('hydroponic.partials.live-charts')

        <!-- Weekly Analytics -->
        @include('hydroponic.partials.weekly-analytics')

        <!-- Recommendations & Download -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @include('hydroponic.partials.recommendations')
            @include('hydroponic.partials.download-section')
        </div>

        <!-- System Control Panel -->
        @include('hydroponic.partials.control-panel')

        <!-- Activity Log -->
        @include('hydroponic.partials.activity-log')
    </main>

    <!-- Footer -->
    @include('hydroponic.partials.footer')
</div>

@push('scripts')
<script>
function dashboardData() {
    return {
        ppm: {{ $ppm ?? 850 }},
        ph: {{ $ph ?? 6.2 }},
        waterLevel: {{ $waterLevel ?? 65 }},
        nutrientRecommendation: '{{ $nutrientRecommendation ?? "Tambah 20ml Nutrisi A+B" }}',

        systemStatus: '{{ $systemStatus ?? "online" }}',
        sensorConnected: {{ $sensorConnected ?? 'true' }},
        lastUpdate: '{{ $lastUpdate ?? now()->format("d M Y, H:i") }}',

        pumpStatus: '{{ $pumpStatus ?? "off" }}',
        lastPumpActivation: '{{ $lastPumpActivation ?? "10:30" }}',
        isLoadingPump: false,

        isDosingNutrient: false,
        currentDose: 0,

        isAdjustingPh: false,

        showStartPumpModal: false,
        showStopPumpModal: false,

        getPpmStatus() {
            if (this.ppm < 600) return { label: 'Rendah', class: 'bg-amber-100 text-amber-700' };
            if (this.ppm > 1000) return { label: 'Tinggi', class: 'bg-red-100 text-red-700' };
            return { label: 'Normal', class: 'bg-green-100 text-green-700' };
        },

        getPhStatus() {
            if (this.ph < 5.5) return { label: 'Asam', class: 'bg-red-100 text-red-700' };
            if (this.ph > 6.5) return { label: 'Basa', class: 'bg-amber-100 text-amber-700' };
            return { label: 'Optimal', class: 'bg-green-100 text-green-700' };
        },

        getWaterLevelStatus() {
            if (this.waterLevel < 30) return { label: 'Kritis', class: 'text-red-600' };
            if (this.waterLevel < 50) return { label: 'Rendah', class: 'text-amber-600' };
            return { label: 'Aman', class: 'text-green-600' };
        },

        async startPump() {
            this.isLoadingPump = true;
            try {
                const response = await fetch('{{ route("hydroponic.pump.start") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                if (response.ok) {
                    this.pumpStatus = 'on';
                    this.lastPumpActivation = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                }
            } catch (error) {
                console.error('Error starting pump:', error);
            }
            this.isLoadingPump = false;
            this.showStartPumpModal = false;
        },

        async stopPump() {
            this.isLoadingPump = true;
            try {
                const response = await fetch('{{ route("hydroponic.pump.stop") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                if (response.ok) {
                    this.pumpStatus = 'off';
                }
            } catch (error) {
                console.error('Error stopping pump:', error);
            }
            this.isLoadingPump = false;
            this.showStopPumpModal = false;
        },

        async triggerNutrient(amount) {
            this.isDosingNutrient = true;
            this.currentDose = amount;
            try {
                const response = await fetch('{{ route("hydroponic.nutrient.trigger") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ amount: amount })
                });
            } catch (error) {
                console.error('Error triggering nutrient:', error);
            }
            setTimeout(() => {
                this.isDosingNutrient = false;
                this.currentDose = 0;
            }, 2000);
        },

        async adjustPh(amount) {
            this.isAdjustingPh = true;
            try {
                const response = await fetch('{{ route("hydroponic.ph.adjust") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ amount: amount })
                });
            } catch (error) {
                console.error('Error adjusting pH:', error);
            }
            setTimeout(() => {
                this.isAdjustingPh = false;
            }, 2000);
        }
    }
}
</script>
@endpush
@endsection
