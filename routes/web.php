<?php

use App\Http\Controllers\Api\PickupRequestController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WastePriceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\NasabahDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HydroponicController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Models\PickupRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Hydroponic Monitoring (Laravel format - dari project b_F35RkVZXL8U)
Route::prefix('hydroponic')->name('hydroponic.')->group(function () {
    Route::get('/', [HydroponicController::class, 'index'])->name('dashboard');
    Route::post('pump/start', [HydroponicController::class, 'startPump'])->name('pump.start');
    Route::post('pump/stop', [HydroponicController::class, 'stopPump'])->name('pump.stop');
    Route::post('nutrient/trigger', [HydroponicController::class, 'triggerNutrient'])->name('nutrient.trigger');
    Route::post('ph/adjust', [HydroponicController::class, 'adjustPh'])->name('ph.adjust');
    Route::get('report/download', [HydroponicController::class, 'downloadReport'])->name('report.download');
    Route::get('docs', [HydroponicController::class, 'docs'])->name('docs');
    Route::get('support', [HydroponicController::class, 'support'])->name('support');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
});

Route::post('logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('dashboard/nasabah', [NasabahDashboardController::class, '__invoke'])->name('dashboard.nasabah');
    Route::get('dashboard/admin', [AdminDashboardController::class, '__invoke'])->name('dashboard.admin');

    Route::prefix('api')->group(function () {
        Route::get('user', fn (\Illuminate\Http\Request $r) => response()->json($r->user()->only(['id', 'name', 'email', 'role', 'balance'])));
        Route::get('waste-prices', [WastePriceController::class, 'index']);
        Route::get('pickup-requests', [PickupRequestController::class, 'index']);
        Route::post('pickup-requests', [PickupRequestController::class, 'store']);
        Route::post('pickup-requests/{pickup}/verify', [PickupRequestController::class, 'verify'])->name('pickup-requests.verify');
        Route::patch('pickup-requests/{pickup}/status', [PickupRequestController::class, 'updateStatus'])->name('pickup-requests.status');
        Route::get('users', [UserController::class, 'index'])->middleware(EnsureUserIsAdmin::class);
    });
});
