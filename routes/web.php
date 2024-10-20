<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlinqPayController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [BlinqPayController::class, 'payment']);
