<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SecretaryController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\DossierMedicalController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\SecretaryDashboardController;

// ==================== PUBLIC ROUTES ====================

/**
 * Authentication Routes (Non protégées)
 * POST /api/register - Inscription
 * POST /api/login - Connexion
 * GET /api/test-token - Token de test (TEMPORAIRE)
 */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/test-token', [AuthController::class, 'testToken']); // TEMPORAIRE
Route::post('/patients/register', [PatientController::class, 'register'])->name('patients.register');
Route::post('/doctors/register', [DoctorController::class, 'register'])->name('doctors.register');
Route::post('/admins/register', [AdminController::class, 'register'])->name('admins.register');
Route::post('/secretaries/register', [SecretaryController::class, 'register'])->name('secretaries.register');

// ==================== PROTECTED ROUTES ====================
// Toutes les routes ci-dessous nécessitent une authentification via JWT/Sanctum

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/dashboard-data', [DashboardController::class, 'adminData'])->name('api.admin.dashboard.data');
    Route::get('/doctor/dashboard-data', [DoctorDashboardController::class, 'data'])->name('api.doctor.dashboard.data');
    Route::get('/doctor/patients/find-by-email', [DoctorDashboardController::class, 'findPatientByEmail'])->name('api.doctor.dashboard.patients.find-by-email');
    Route::post('/doctor/appointments', [DoctorDashboardController::class, 'storeAppointment'])->name('api.doctor.dashboard.appointments.store');
    Route::put('/doctor/appointments/{appointment}/notes', [DoctorDashboardController::class, 'saveNotes'])->name('api.doctor.dashboard.appointments.notes');
    Route::patch('/doctor/appointments/{appointment}/reschedule', [DoctorDashboardController::class, 'reschedule'])->name('api.doctor.dashboard.appointments.reschedule');
    Route::post('/doctor/appointments/{appointment}/complete', [DoctorDashboardController::class, 'complete'])->name('api.doctor.dashboard.appointments.complete');
    Route::get('/patient/dashboard-data', [PatientDashboardController::class, 'data'])->name('api.patient.dashboard.data');
    Route::get('/patient/doctors/{doctor}/availability-calendar', [PatientDashboardController::class, 'availabilityCalendar'])->name('api.patient.dashboard.availability-calendar');
    Route::get('/patient/doctors/{doctor}/available-slots', [PatientDashboardController::class, 'availableSlots'])->name('api.patient.dashboard.available-slots');
    Route::post('/patient/appointments', [PatientDashboardController::class, 'storeAppointment'])->name('api.patient.dashboard.appointments.store');
    Route::patch('/patient/appointments/{appointment}', [PatientDashboardController::class, 'updateAppointment'])->name('api.patient.dashboard.appointments.update');
    Route::post('/admin/patients/{id}/reset-password', [PatientController::class, 'resetPassword'])->name('api.admin.patients.reset-password');
    Route::post('/admin/doctors/{id}/reset-password', [DoctorController::class, 'resetPassword'])->name('api.admin.doctors.reset-password');
    Route::post('/admin/secretaries/{id}/reset-password', [SecretaryController::class, 'resetPassword'])->name('api.admin.secretaries.reset-password');
    Route::get('/secretary/dashboard-data', [SecretaryDashboardController::class, 'data'])->name('api.secretary.dashboard.data');
    Route::get('/secretary/doctors/{doctor}/available-slots', [SecretaryDashboardController::class, 'availableSlots'])->name('api.secretary.dashboard.available-slots');
    Route::post('/secretary/patients', [SecretaryDashboardController::class, 'storePatient'])->name('api.secretary.dashboard.patients.store');
    Route::post('/secretary/appointments', [SecretaryDashboardController::class, 'storeAppointment'])->name('api.secretary.dashboard.appointments.store');
    
    // ==================== AUTH ====================
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // ==================== PATIENTS ====================
    /**
     * Patient Management
     */
    Route::apiResource('patients', PatientController::class)->names('api.patients');
    Route::get('/patients/search/patients', [PatientController::class, 'search'])->name('api.patients.search');
    Route::get('/patients/{id}/appointments', [PatientController::class, 'getAppointments'])->name('api.patients.appointments');
    Route::get('/patients/{id}/consultations', [PatientController::class, 'getConsultations'])->name('api.patients.consultations');
    Route::get('/patients/{id}/medical-info', [PatientController::class, 'getMedicalInfo'])->name('api.patients.medical-info');

    // ==================== DOCTORS ====================
    /**
     * Doctor Management
     */
    Route::apiResource('doctors', DoctorController::class)->names('api.doctors');

    // ==================== ADMINS ====================
    /**
     * Admin Management
     */
    Route::apiResource('admins', AdminController::class)->names('api.admins');

    // ==================== SECRETARIES ====================
    /**
     * Secretary Management
     */
    Route::apiResource('secretaries', SecretaryController::class)->names('api.secretaries');

    // ==================== APPOINTMENTS ====================
    /**
     * Appointment Management
     */
    Route::apiResource('appointments', AppointmentController::class)->names('api.appointments');
    Route::get('/appointments/doctor/{doctor_id}', [AppointmentController::class, 'getByDoctor'])->name('api.appointments.doctor');
    Route::get('/appointments/patient/{patient_id}', [AppointmentController::class, 'getByPatient'])->name('api.appointments.patient');

    // ==================== CONSULTATIONS ====================
    /**
     * Consultation Management
     */
    Route::apiResource('consultations', ConsultationController::class)->names('api.consultations');
    Route::get('/consultations/patient/{patient_id}', [ConsultationController::class, 'getByPatient'])->name('api.consultations.patient');

    // ==================== ORDONNANCES ====================
    /**
     * Ordonnance (Prescription) Management
     */
    Route::apiResource('ordonnances', OrdonnanceController::class)->names('api.ordonnances');
    Route::get('/consultations/{consultation_id}/ordonnances', [OrdonnanceController::class, 'getByConsultation'])->name('api.ordonnances.consultation');

    // ==================== DOSSIER MEDICAL ====================
    /**
     * Medical Record Management
     */
    Route::apiResource('dossiers-medicaux', DossierMedicalController::class)->names('api.dossiers-medicaux');
    Route::get('/dossiers-medicaux/patient/{patient_id}', [DossierMedicalController::class, 'getByPatient'])->name('api.dossiers.patient');
    Route::get('/dossiers-medicaux/patient/{patient_id}/summary', [DossierMedicalController::class, 'getSummary'])->name('api.dossiers.summary');

    // ==================== CABINETS ====================
    /**
     * Cabinet Management
     */
    Route::apiResource('cabinets', CabinetController::class)->names('api.cabinets');
    Route::get('/cabinets/{id}/doctors', [CabinetController::class, 'getDoctors'])->name('api.cabinets.doctors');
    Route::get('/cabinets/search/name', [CabinetController::class, 'searchByName'])->name('api.cabinets.search');

    // ==================== NOTIFICATIONS ====================
    /**
     * Notification Management
     */
    Route::apiResource('notifications', NotificationController::class)->names('api.notifications');
    Route::get('/notifications/user/{user_id}', [NotificationController::class, 'getUserNotifications']);
    Route::get('/notifications/user/{user_id}/unread', [NotificationController::class, 'getUnread']);
    Route::get('/notifications/user/{user_id}/stats', [NotificationController::class, 'getStats']);
    Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::put('/notifications/user/{user_id}/read-all', [NotificationController::class, 'markAllAsRead']);
    Route::delete('/notifications/user/{user_id}/clear', [NotificationController::class, 'clearUserNotifications']);
});
