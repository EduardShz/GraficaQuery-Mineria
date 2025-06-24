<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GraficasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);

Route::middleware(['auth:sanctum',config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/graficas', [GraficasController::class, 'index'])->name('graficas.index');
    Route::get('/graficas/first-query', [GraficasController::class, 'firstQuery'])->name('graficas.firstquery');
    Route::get('/graficas/second-query', [GraficasController::class, 'secondQuery'])->name('graficas.secondquery');
    Route::get('/graficas/third-query', [GraficasController::class, 'thirdQuery'])->name('graficas.thirdquery');
});
