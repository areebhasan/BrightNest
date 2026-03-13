<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChildController;
use App\Http\Controllers\Api\DashboardController;

Route::get('/children', [ChildController::class, 'index']);
Route::post('/children', [ChildController::class, 'store']);