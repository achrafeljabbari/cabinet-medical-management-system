<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| API Routes — Medicare Cabinet Médical
|--------------------------------------------------------------------------
| These routes are prefixed with /api automatically by Laravel
*/

// Admin API Routes (POST/DELETE)
Route::middleware(['auth'])->group(function () {
    // Add Doctor/Secretary
    Route::post('/doctors', [AdminDashboardController::class, 'addDoctor'])->name('api.add-doctor');
    Route::post('/secretaries', [AdminDashboardController::class, 'addSecretary'])->name('api.add-secretary');
    
    // Delete Doctor/Secretary
    Route::delete('/doctors/{id}', [AdminDashboardController::class, 'deleteDoctor'])->name('api.delete-doctor');
    Route::delete('/secretaries/{id}', [AdminDashboardController::class, 'deleteSecretary'])->name('api.delete-secretary');
});
