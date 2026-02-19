<?php

use App\Http\Controllers\Api\WastePriceController;
use Illuminate\Support\Facades\Route;

Route::get('waste-prices', [WastePriceController::class, 'index']);
