<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PickupRequest;
use App\Models\WastePrice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PickupRequestController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $pickups = PickupRequest::with('user:id,name,email')
                ->orderByDesc('created_at')
                ->get();
        } else {
            $pickups = PickupRequest::where('user_id', $user->id)
                ->orderByDesc('created_at')
                ->get();
        }

        return response()->json($pickups);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category' => 'required|in:plastic,glass,cans',
            'category_label' => 'required|string|max:50',
            'estimated_weight_kg' => 'required|numeric|min:0.1',
            'estimated_price' => 'required|numeric|min:0',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'address' => 'nullable|string',
            'scheduled_at' => 'required|date',
        ]);

        $pr = PickupRequest::create([
            'user_id' => $request->user()->id,
            'category' => $validated['category'],
            'category_label' => $validated['category_label'],
            'estimated_weight_kg' => $validated['estimated_weight_kg'],
            'estimated_price' => $validated['estimated_price'],
            'lat' => $validated['lat'] ?? null,
            'lng' => $validated['lng'] ?? null,
            'address' => $validated['address'] ?? null,
            'scheduled_at' => $validated['scheduled_at'],
            'status' => 'pending',
        ]);

        return response()->json($pr->load('user:id,name,email'), 201);
    }

    public function verify(Request $request, PickupRequest $pickup): JsonResponse
    {
        $validated = $request->validate([
            'actual_weight_kg' => 'required|numeric|min:0',
            'final_price' => 'required|numeric|min:0',
        ]);

        $pickup->update([
            'actual_weight_kg' => $validated['actual_weight_kg'],
            'final_price' => $validated['final_price'],
            'status' => 'completed',
            'admin_verified_at' => now(),
            'verified_by' => $request->user()->id,
        ]);

        $pickup->user->increment('balance', $validated['final_price']);

        return response()->json($pickup->fresh(['user:id,name,email,balance']));
    }

    public function updateStatus(Request $request, PickupRequest $pickup): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,on_progress,completed',
        ]);

        $pickup->update(['status' => $validated['status']]);

        return response()->json($pickup);
    }
}
