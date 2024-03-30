<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $url = 'http://127.0.0.1:8000/api/statistics/';
    $response = Http::post($url);
    Log::debug("[CRON JOB] " . print_r($response->json(), true));
})->everyFiveMinutes();
