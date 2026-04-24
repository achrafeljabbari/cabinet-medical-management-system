<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes — Medicare Cabinet Médical
|--------------------------------------------------------------------------
*/

// ===== Pages publiques =====
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/a-propos', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/equipe', [PageController::class, 'equipe'])->name('equipe');
Route::get('/temoignages', [PageController::class, 'temoignages'])->name('temoignages');
Route::get('/rendez-vous', [PageController::class, 'contact'])->name('contact');
Route::post('/rendez-vous', [PageController::class, 'submitContact'])->name('contact.submit');

// ===== Authentification =====
// Sans le middleware 'guest' pour éviter les redirections en boucle
Route::get('/connexion', function () {
    return view('auth.index');
})->name('login');

Route::get('/inscription', function () {
    return view('auth.index');
})->name('register');

Route::get('/auth', function () {
    return view('auth.index');
})->name('auth');

// API routes are handled separately via /api/login and /api/patients/register

Route::post('/deconnexion', function () {
    Auth::logout();
    session()->flush();
    return redirect('/connexion');
})
    ->middleware('auth')
    ->name('logout');

// ===== Espace connecté =====
// Accessible à tous - le JavaScript gère l'authentification
Route::get('/dashboard', function () {
    return view('dashboard-new');
})->name('dashboard');

Route::get('/profil', function () {
    return view('profile');
})->name('profile');

// ===== Dashboard Médecin =====
Route::middleware(['auth'])->prefix('doctor')->group(function () {
    Route::get('/dashboard', function () {
        return view('doctor.dashboard', ['initialView' => 'dashboard']);
    })->name('doctor.dashboard');
    
    Route::get('/consultations', function () {
        return view('doctor.dashboard', ['initialView' => 'consultations']);
    })->name('doctor.consultations');
    
    Route::get('/patients', function () {
        return view('doctor.dashboard', ['initialView' => 'patients']);
    })->name('doctor.patients');
    
    Route::get('/schedule', function () {
        return view('doctor.dashboard', ['initialView' => 'schedule']);
    })->name('doctor.schedule');
});
