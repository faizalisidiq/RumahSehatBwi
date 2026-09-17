<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\TherapySessionController;
use App\Models\Patient;
use Illuminate\Support\Facades\Route;

// Tampilan Awal (Dashboard Landing)
Route::get('/', function () {

    // Menghitung total seluruh jumlah pasien
    $totalPatients = Patient::count();

    // Menghitung total pasien hari ini
    $totalPatientsToday = Patient::whereDate('created_at', now()->toDateString())->count();

    return view('dashboard', compact('totalPatients', 'totalPatientsToday'));
})->name('dashboard');

// Grup Route Admin (Tanpa Auth Middleware)
Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('patients', PatientController::class);
    Route::post('patients/{patient}/sessions', [TherapySessionController::class, 'store'])->name('sessions.store');
});
