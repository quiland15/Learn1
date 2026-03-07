<section>
    <h2 class="text-lg font-semibold text-foreground mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
        </svg>
        Activity Log
    </h2>

    <div class="glass-card rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-muted/50">
                    <tr class="text-left text-muted-foreground">
                        <th class="px-4 py-3 font-medium">Waktu</th>
                        <th class="px-4 py-3 font-medium">Event</th>
                        <th class="px-4 py-3 font-medium">pH</th>
                        <th class="px-4 py-3 font-medium">PPM</th>
                        <th class="px-4 py-3 font-medium">Water Level</th>
                        <th class="px-4 py-3 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @php
                        $activityLogs = $activityLogs ?? [
                            ['time' => '10:30:15', 'event' => 'Sensor Reading', 'ph' => 6.2, 'ppm' => 850, 'water' => 65, 'status' => 'normal'],
                            ['time' => '10:25:12', 'event' => 'Pump Started', 'ph' => 6.1, 'ppm' => 845, 'water' => 63, 'status' => 'normal'],
                            ['time' => '10:20:08', 'event' => 'Nutrient Added', 'ph' => 6.0, 'ppm' => 820, 'water' => 62, 'status' => 'action'],
                            ['time' => '10:15:03', 'event' => 'Low PPM Alert', 'ph' => 6.0, 'ppm' => 580, 'water' => 61, 'status' => 'warning'],
                            ['time' => '10:10:00', 'event' => 'Sensor Reading', 'ph' => 6.1, 'ppm' => 590, 'water' => 60, 'status' => 'warning'],
                            ['time' => '10:05:45', 'event' => 'Sensor Reading', 'ph' => 6.2, 'ppm' => 610, 'water' => 60, 'status' => 'normal'],
                            ['time' => '10:00:30', 'event' => 'System Started', 'ph' => 6.2, 'ppm' => 620, 'water' => 59, 'status' => 'info'],
                        ];
                    @endphp

                    @foreach($activityLogs as $log)
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="px-4 py-3 text-muted-foreground font-mono text-xs">{{ $log['time'] }}</td>
                            <td class="px-4 py-3 text-foreground font-medium">{{ $log['event'] }}</td>
                            <td class="px-4 py-3">
                                <span class="@if($log['ph'] < 5.5 || $log['ph'] > 6.5) text-amber-600 @else text-foreground @endif">{{ number_format($log['ph'], 1) }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="@if($log['ppm'] < 600 || $log['ppm'] > 1000) text-amber-600 @else text-foreground @endif">{{ $log['ppm'] }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="@if($log['water'] < 30) text-red-600 @elseif($log['water'] < 50) text-amber-600 @else text-foreground @endif">{{ $log['water'] }}%</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded text-xs font-medium
                                    @if($log['status'] === 'normal') bg-green-100 text-green-700
                                    @elseif($log['status'] === 'warning') bg-amber-100 text-amber-700
                                    @elseif($log['status'] === 'error') bg-red-100 text-red-700
                                    @elseif($log['status'] === 'action') bg-blue-100 text-blue-700
                                    @else bg-muted text-muted-foreground
                                    @endif">{{ ucfirst($log['status']) }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t border-border flex items-center justify-between">
            <p class="text-sm text-muted-foreground">Menampilkan 1-7 dari {{ $totalLogs ?? 150 }} log</p>
            <div class="flex gap-1">
                <button class="px-3 py-1.5 text-sm font-medium text-muted-foreground bg-muted rounded hover:bg-muted/80 transition-colors">Prev</button>
                <button class="px-3 py-1.5 text-sm font-medium text-primary-foreground bg-primary rounded">1</button>
                <button class="px-3 py-1.5 text-sm font-medium text-muted-foreground bg-muted rounded hover:bg-muted/80 transition-colors">2</button>
                <button class="px-3 py-1.5 text-sm font-medium text-muted-foreground bg-muted rounded hover:bg-muted/80 transition-colors">3</button>
                <button class="px-3 py-1.5 text-sm font-medium text-muted-foreground bg-muted rounded hover:bg-muted/80 transition-colors">Next</button>
            </div>
        </div>
    </div>
</section>
