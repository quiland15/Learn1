<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\SensorReading;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HydroponicController extends Controller
{
    /**
     * Display the hydroponic monitoring dashboard.
     */
    public function index()
    {
        $latestReading = SensorReading::latest()->first();

        $hourlyData = SensorReading::where('created_at', '>=', Carbon::now()->subHours(24))
            ->selectRaw('DATE_FORMAT(created_at, "%H:00") as hour, AVG(ph) as ph, AVG(ppm) as ppm')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $weeklyData = SensorReading::where('created_at', '>=', Carbon::now()->subDays(7))
            ->selectRaw('DATE(created_at) as date, AVG(ph) as ph, AVG(ppm) as ppm')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $weeklyStats = [
            'avgPh' => $weeklyData->isNotEmpty() ? number_format($weeklyData->avg('ph'), 1) : '6.2',
            'avgPpm' => $weeklyData->isNotEmpty() ? number_format($weeklyData->avg('ppm'), 0) : '842',
            'waterUsage' => 45,
            'nutrientUsage' => 320,
        ];

        $activityLogs = ActivityLog::latest()
            ->take(10)
            ->get()
            ->map(fn ($log) => [
                'time' => $log->created_at->format('H:i:s'),
                'event' => $log->event,
                'ph' => $log->ph,
                'ppm' => $log->ppm,
                'water' => $log->water_level,
                'status' => $log->status,
            ]);

        return view('hydroponic.dashboard', [
            'ppm' => $latestReading?->ppm ?? 850,
            'ph' => $latestReading?->ph ?? 6.2,
            'waterLevel' => $latestReading?->water_level ?? 65,
            'nutrientRecommendation' => $this->getNutrientRecommendation($latestReading),

            'systemStatus' => 'online',
            'sensorConnected' => true,
            'lastUpdate' => Carbon::now()->format('d M Y, H:i'),
            'pumpStatus' => $latestReading?->pump_status ?? 'off',
            'lastPumpActivation' => $latestReading?->last_pump_activation?->format('H:i') ?? '10:30',

            'chartHours' => $hourlyData->pluck('hour')->isEmpty() ? ['00:00', '04:00', '08:00', '12:00', '16:00', '20:00', '24:00'] : $hourlyData->pluck('hour'),
            'phData' => $hourlyData->pluck('ph')->isEmpty() ? [6.1, 6.3, 6.2, 6.0, 6.4, 6.2, 6.3] : $hourlyData->pluck('ph'),
            'ppmData' => $hourlyData->pluck('ppm')->isEmpty() ? [820, 850, 830, 870, 860, 840, 850] : $hourlyData->pluck('ppm'),

            'weekDays' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            'weeklyPh' => $weeklyData->pluck('ph')->isEmpty() ? [6.1, 6.2, 6.3, 6.1, 6.2, 6.4, 6.2] : $weeklyData->pluck('ph'),
            'weeklyPpm' => $weeklyData->pluck('ppm')->isEmpty() ? [820, 840, 830, 860, 850, 870, 850] : $weeklyData->pluck('ppm'),

            'avgPh' => $weeklyStats['avgPh'],
            'avgPpm' => $weeklyStats['avgPpm'],
            'waterUsage' => $weeklyStats['waterUsage'],
            'nutrientUsage' => $weeklyStats['nutrientUsage'],

            'recommendations' => $this->generateRecommendations($latestReading),
            'safetyAlerts' => $this->generateSafetyAlerts($latestReading),

            'activityLogs' => $activityLogs->isEmpty() ? [
                ['time' => '10:30:15', 'event' => 'Sensor Reading', 'ph' => 6.2, 'ppm' => 850, 'water' => 65, 'status' => 'normal'],
                ['time' => '10:25:12', 'event' => 'Pump Started', 'ph' => 6.1, 'ppm' => 845, 'water' => 63, 'status' => 'normal'],
            ] : $activityLogs->toArray(),
            'totalLogs' => ActivityLog::count(),

            'controlHistory' => $this->getControlHistory(),
        ]);
    }

    public function startPump(Request $request)
    {
        $latest = SensorReading::latest()->first();
        ActivityLog::create([
            'event' => 'Pump Started',
            'ph' => $latest?->ph ?? 0,
            'ppm' => $latest?->ppm ?? 0,
            'water_level' => $latest?->water_level ?? 0,
            'status' => 'action',
        ]);

        return response()->json(['success' => true, 'message' => 'Pump started successfully']);
    }

    public function stopPump(Request $request)
    {
        $latest = SensorReading::latest()->first();
        ActivityLog::create([
            'event' => 'Pump Stopped',
            'ph' => $latest?->ph ?? 0,
            'ppm' => $latest?->ppm ?? 0,
            'water_level' => $latest?->water_level ?? 0,
            'status' => 'action',
        ]);

        return response()->json(['success' => true, 'message' => 'Pump stopped successfully']);
    }

    public function triggerNutrient(Request $request)
    {
        $amount = $request->input('amount', 20);
        $latest = SensorReading::latest()->first();
        ActivityLog::create([
            'event' => "Nutrient Added (+{$amount}ml)",
            'ph' => $latest?->ph ?? 0,
            'ppm' => $latest?->ppm ?? 0,
            'water_level' => $latest?->water_level ?? 0,
            'status' => 'action',
        ]);

        return response()->json(['success' => true, 'message' => "Added {$amount}ml nutrient"]);
    }

    public function adjustPh(Request $request)
    {
        $amount = $request->input('amount', 5);
        $latest = SensorReading::latest()->first();
        ActivityLog::create([
            'event' => "pH Down (+{$amount}ml)",
            'ph' => $latest?->ph ?? 0,
            'ppm' => $latest?->ppm ?? 0,
            'water_level' => $latest?->water_level ?? 0,
            'status' => 'action',
        ]);

        return response()->json(['success' => true, 'message' => "Added {$amount}ml pH Down"]);
    }

    public function downloadReport(Request $request)
    {
        $format = $request->input('format', 'pdf');
        return back()->with('message', 'Report downloaded successfully');
    }

    public function docs()
    {
        return view('hydroponic.docs');
    }

    public function support()
    {
        return view('hydroponic.support');
    }

    private function getNutrientRecommendation(?SensorReading $reading): string
    {
        if (! $reading) {
            return 'Tambah 20ml Nutrisi A+B';
        }
        if ($reading->ppm < 600) {
            return 'Tambah 30ml Nutrisi A+B (PPM Rendah)';
        }
        if ($reading->ppm < 800) {
            return 'Tambah 20ml Nutrisi A+B';
        }
        if ($reading->ppm > 1000) {
            return 'Jangan tambah nutrisi (PPM Tinggi)';
        }
        return 'Level nutrisi optimal';
    }

    private function generateRecommendations(?SensorReading $reading): array
    {
        if (! $reading) {
            return [['type' => 'info', 'message' => 'Menunggu data sensor...']];
        }
        $recommendations = [];
        if ($reading->ph >= 5.5 && $reading->ph <= 6.5) {
            $recommendations[] = ['type' => 'success', 'message' => 'pH dalam rentang optimal untuk pertumbuhan selada.'];
        } elseif ($reading->ph < 5.5) {
            $recommendations[] = ['type' => 'warning', 'message' => 'pH terlalu asam. Pertimbangkan untuk menambah pH Up.'];
        } else {
            $recommendations[] = ['type' => 'warning', 'message' => 'pH terlalu basa. Pertimbangkan untuk menambah pH Down.'];
        }
        if ($reading->ppm >= 600 && $reading->ppm <= 1000) {
            $recommendations[] = ['type' => 'success', 'message' => 'PPM dalam rentang optimal.'];
        } elseif ($reading->ppm < 600) {
            $recommendations[] = ['type' => 'warning', 'message' => 'PPM terlalu rendah. Tambahkan nutrisi.'];
        } else {
            $recommendations[] = ['type' => 'warning', 'message' => 'PPM terlalu tinggi. Kurangi nutrisi atau tambah air.'];
        }
        if ($reading->water_level >= 50) {
            $recommendations[] = ['type' => 'info', 'message' => 'Level air mencukupi untuk '.ceil($reading->water_level / 10).' hari ke depan.'];
        } elseif ($reading->water_level >= 30) {
            $recommendations[] = ['type' => 'warning', 'message' => 'Level air mulai rendah. Persiapkan pengisian ulang.'];
        } else {
            $recommendations[] = ['type' => 'error', 'message' => 'Level air kritis! Segera isi ulang.'];
        }
        return $recommendations;
    }

    private function generateSafetyAlerts(?SensorReading $reading): array
    {
        if (! $reading) {
            return [['type' => 'warning', 'message' => 'Tidak dapat membaca data sensor']];
        }
        $alerts = [];
        if ($reading->water_level < 40) {
            $alerts[] = ['type' => 'warning', 'message' => 'Level air di bawah 40%'];
        }
        $alerts[] = ['type' => 'success', 'message' => 'Semua sensor berfungsi normal'];
        $alerts[] = ['type' => 'info', 'message' => 'Kalibrasi sensor terakhir: 3 hari lalu'];
        return $alerts;
    }

    private function getControlHistory(): array
    {
        return ActivityLog::whereIn('status', ['action'])
            ->latest()
            ->take(5)
            ->get()
            ->map(fn ($log) => [
                'time' => $log->created_at->format('H:i'),
                'action' => $log->event,
                'status' => 'success',
            ])
            ->toArray();
    }
}
