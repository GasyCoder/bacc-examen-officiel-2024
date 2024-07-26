<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatController;


Route::post('/search', [CandidatController::class, 'search']);

//Route::match(['get', 'post'], '/search', [CandidatController::class, 'search']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
