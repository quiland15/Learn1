<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PickupRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $nasabahCount = User::where('role', 'nasabah')->count();
        $pendingCount = PickupRequest::where('status', 'pending')->count();
        $revenue = PickupRequest::where('status', 'completed')->sum('final_price');

        $pickups = PickupRequest::with('user:id,name,email')
            ->orderByDesc('created_at')
            ->get();

        $users = User::where('role', 'nasabah')
            ->select('id', 'name', 'email', 'balance', 'created_at')
            ->orderBy('name')
            ->get();

        return view('dashboard.admin', [
            'user' => $request->user()->only(['id', 'name', 'email', 'role']),
            'stats' => [
                'total_users' => $nasabahCount,
                'pending_pickups' => $pendingCount,
                'total_revenue' => (float) $revenue,
            ],
            'pickups' => $pickups,
            'users' => $users,
        ]);
    }
}
