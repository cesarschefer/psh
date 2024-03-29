<?php

use App\Http\Controllers\StatisticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/statistics', [StatisticsController::class,'index']);
Route::get('/statistics/export', [StatisticsController::class,'export']);
Route::post('/statistics', [StatisticsController::class,'store']);
