<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DossierMedicalController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SecretaryController;
use Illuminate\Support\Facades\Route;

Route::name('web.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | FRONTEND PUBLIC
    |--------------------------------------------------------------------------
    */
    Route::controller(FrontendPageController::class)->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('/a-propos', 'about')->name('about');
        Route::get('/services', 'services')->name('services');
        Route::get('/equipe', 'equipe')->name('equipe');
        Route::get('/temoignages', 'temoignages')->name('temoignages');

        Route::get('/rendez-vous', 'contact')->name('contact');
        Route::post('/rendez-vous', 'submitContact')->name('contact.submit');

        Route::get('/connexion', 'auth')->name('login');
        Route::get('/inscription', 'auth')->name('register');

        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/admin/dashboard', 'adminDashboard')->name('admin.dashboard');
        Route::get('/profil', 'profile')->name('profile');
    });

    Route::redirect('/login', '/connexion');
    Route::redirect('/register', '/inscription');

    /*
    |--------------------------------------------------------------------------
    | DASHBOARDS
    |--------------------------------------------------------------------------
    */
    Route::prefix('doctor')->name('doctor.')->controller(FrontendPageController::class)->group(function () {
        Route::get('/dashboard', 'doctorDashboard')->name('dashboard');
        Route::get('/consultations', 'doctorDashboard')->name('consultations');
        Route::get('/patients', 'doctorDashboard')->name('patients');
        Route::get('/schedule', 'doctorDashboard')->name('schedule');
    });

    Route::prefix('patient')->name('patient.')->controller(FrontendPageController::class)->group(function () {
        Route::get('/dashboard', 'patientDashboard')->name('dashboard');
        Route::get('/rendez-vous', 'patientDashboard')->name('appointments');
        Route::get('/dossier-medical', 'patientDashboard')->name('records');
        Route::get('/consultations', 'patientDashboard')->name('consultations');
        Route::get('/ordonnances', 'patientDashboard')->name('ordonnances');
    });

    Route::prefix('secretary')->name('secretary.')->controller(FrontendPageController::class)->group(function () {
        Route::get('/dashboard', 'secretaryDashboard')->name('dashboard');
        Route::get('/patients', 'secretaryDashboard')->name('patients');
        Route::get('/appointments', 'secretaryDashboard')->name('appointments');
        Route::get('/queues', 'secretaryDashboard')->name('queues');
    });

    /*
    |--------------------------------------------------------------------------
    | AUTH
    |--------------------------------------------------------------------------
    */
    Route::middleware('guest')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('session.login');
        Route::post('/register', [AuthController::class, 'register'])->name('session.register');
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');

    /*
    |--------------------------------------------------------------------------
    | BACKOFFICE
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth'])->group(function () {

        Route::get('/backoffice/dashboard', [DashboardController::class, 'index'])
            ->name('backoffice.dashboard');

        /*
        | Notifications
        */
        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('index');
            Route::put('/{id}/read', [NotificationController::class, 'markAsRead'])->name('read');
            Route::put('/mark-all-read', [NotificationController::class, 'markAllRead'])->name('markAllRead');
            Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
            Route::delete('/clear-all', [NotificationController::class, 'clearAll'])->name('clearAll');
        });

        /*
        | ADMIN
        */
        Route::middleware(['role:ADMIN'])->group(function () {
            Route::resource('admins', AdminController::class)->names('admins');
            Route::resource('secretaries', SecretaryController::class)->names('secretaries');
            Route::resource('doctors', DoctorController::class)->names('doctors');
            Route::resource('cabinets', CabinetController::class)->names('cabinets');
        });

        /*
        | MEDECIN
        */
        Route::middleware(['role:MEDECIN'])->group(function () {
            Route::resource('consultations', ConsultationController::class)->names('consultations');
            Route::resource('ordonnances', OrdonnanceController::class)->names('ordonnances');
            Route::resource('patients', PatientController::class)->names('patients');

            Route::resource('dossiers', DossierMedicalController::class)
                ->only(['show', 'edit', 'update'])
                ->names('dossiers');
        });

        /*
        | SECRETAIRE
        */
        Route::middleware(['role:SECRETAIRE'])->group(function () {
            Route::resource('appointments', AppointmentController::class)->names('appointments');

            Route::get('/search-patients', [PatientController::class, 'index'])
                ->name('patients.search');
        });

        /*
        | PATIENT
        */
        Route::middleware(['role:PATIENT'])->group(function () {
            Route::get('/mon-dossier', [DossierMedicalController::class, 'myRecord'])
                ->name('dossiers.mine');

            Route::get('/mes-rendez-vous', [AppointmentController::class, 'index'])
                ->name('appointments.my_list');

            Route::get('/prendre-rdv', [AppointmentController::class, 'create'])
                ->name('appointments.prendre_rdv');

            // ✅ CORRECTION ICI
            Route::post('/save-rdv', [AppointmentController::class, 'store'])
                ->name('appointments.save_rdv');
        });
    });
});