<section>
    <div class="bg-card border border-border/50 rounded-lg p-6">
        <h3 class="text-base font-semibold text-foreground mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
            </svg>
            Plant Health Recommendation
        </h3>

        <div class="space-y-3">
            @foreach($recommendations as $rec)
                @php
                    $borderClass = $rec['type'] === 'success' ? 'border-primary/20 bg-primary/5' : 
                                   ($rec['type'] === 'warning' ? 'border-amber-200 bg-amber-50' : 
                                    'border-chart-2/20 bg-chart-2/5');
                    $iconClass = $rec['type'] === 'success' ? 'text-primary' :
                                ($rec['type'] === 'warning' ? 'text-amber-500' : 'text-chart-2');
                @endphp
                <div class="flex items-start gap-3 p-3 rounded-lg border transition-all duration-200 hover:shadow-sm {{ $borderClass }}">
                    @if($rec['type'] === 'success')
                        <svg class="w-5 h-5 {{ $iconClass }} flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @elseif($rec['type'] === 'warning')
                        <svg class="w-5 h-5 {{ $iconClass }} flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    @else
                        <svg class="w-5 h-5 {{ $iconClass }} flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @endif
                    <p class="text-sm text-foreground">{{ $rec['message'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
