<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WastePrice;
use Illuminate\Http\JsonResponse;

class WastePriceController extends Controller
{
    public function index(): JsonResponse
    {
        $prices = WastePrice::all()->groupBy('category');

        return response()->json($prices);
    }
}
