<div class="glass-card rounded-xl p-5">
    <h3 class="text-lg font-semibold text-foreground mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
        </svg>
        Rekomendasi Kesehatan Tanaman
    </h3>

    <div class="space-y-3">
        @php
            $recommendations = $recommendations ?? [
                ['type' => 'success', 'message' => 'pH dalam rentang optimal untuk pertumbuhan selada.'],
                ['type' => 'warning', 'message' => 'PPM sedikit di atas normal, kurangi nutrisi 10%.'],
                ['type' => 'info', 'message' => 'Level air mencukupi untuk 2 hari ke depan.'],
            ];
        @endphp

        @foreach($recommendations as $rec)
            <div class="flex items-start gap-3 p-3 rounded-lg
                @if($rec['type'] === 'success') bg-green-50 border border-green-200
                @elseif($rec['type'] === 'warning') bg-amber-50 border border-amber-200
                @elseif($rec['type'] === 'error') bg-red-50 border border-red-200
                @else bg-blue-50 border border-blue-200
                @endif">

                @if($rec['type'] === 'success')
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                @elseif($rec['type'] === 'warning')
                    <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                @elseif($rec['type'] === 'error')
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                @else
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                @endif

                <p class="text-sm
                    @if($rec['type'] === 'success') text-green-800
                    @elseif($rec['type'] === 'warning') text-amber-800
                    @elseif($rec['type'] === 'error') text-red-800
                    @else text-blue-800
                    @endif">
                    {{ $rec['message'] }}
                </p>
            </div>
        @endforeach
    </div>
</div>
