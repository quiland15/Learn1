<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $users = User::where('role', 'nasabah')
            ->select('id', 'name', 'email', 'balance', 'created_at')
            ->orderBy('name')
            ->get();

        return response()->json($users);
    }
}
