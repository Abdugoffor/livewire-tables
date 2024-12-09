<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/prostoy', [ProjectController::class, 'index'])->name('prostoy');
    Route::get('/other-expense', [ProjectController::class, 'otherExpense'])->name('other-expense');
});
