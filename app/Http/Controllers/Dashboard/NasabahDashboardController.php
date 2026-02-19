<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PickupRequest;
use App\Models\WastePrice;
use Illuminate\Http\Request;

class NasabahDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $pickups = PickupRequest::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('dashboard.nasabah', [
            'user' => $user->only(['id', 'name', 'email', 'role', 'balance']),
            'prices' => WastePrice::all()->groupBy('category'),
            'pickups' => $pickups,
        ]);
    }
}
