<?php

use App\Http\Controllers\GoldController;
use Illuminate\Support\Facades\Route;

Route::get('/gold/analyze', [GoldController::class, 'getAnalysis']);

