<section>
    <div class="bg-card border border-border/50 rounded-lg p-6">
        <h2 class="text-base font-semibold text-foreground mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            System Activity Log
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-border">
                        <th class="text-left py-3 px-4 text-xs font-medium text-muted-foreground uppercase tracking-wide">Time</th>
                        <th class="text-left py-3 px-4 text-xs font-medium text-muted-foreground uppercase tracking-wide">Event</th>
                        <th class="text-left py-3 px-4 text-xs font-medium text-muted-foreground uppercase tracking-wide">Sensor Value</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @foreach($activityLog as $entry)
                        <tr class="hover:bg-muted/50 transition-colors">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm text-foreground font-mono">{{ $entry['time'] }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $entry['type'] === 'success' ? 'bg-primary/10 text-primary' : ($entry['type'] === 'warning' ? 'bg-amber-100 text-amber-700' : 'bg-muted text-muted-foreground') }}">
                                    {{ $entry['event'] }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-sm text-muted-foreground">{{ $entry['sensorValue'] ?? '-' }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
