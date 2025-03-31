<?php

use App\Http\Controllers\Patient\FileUploadController;
use App\Http\Controllers\Frontend\FrontdeskDashboardController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Patient\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 * ------------------------------------------------------------------
 *                           Therapist Routes
 * ------------------------------------------------------------------
 */

Route::group(["middleware" => ['auth:web', 'verified', 'check_role:therapist'], 'prefix' => 'therapist', 'as' => 'therapist.'], function () {
    route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

/**
 * ------------------------------------------------------------------
 *                           Frontdesk Routes
 * ------------------------------------------------------------------
 */
Route::group(["middleware" => ['auth:web', 'verified', 'check_role:frontdesk'], 'prefix' => 'frontdesk', 'as' => 'frontdesk.'], function () {
    route::get('/dashboard', [FrontdeskDashboardController::class, 'index'])->name('dashboard');
});





Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');



Route::resource('patients', PatientController::class);

Route::get('/patient-files/create', [FileUploadController::class, 'create'])->name('patient_files.create');


Route::post('/patient-files/upload', [FileUploadController::class, 'uploadPatientFile'])->name('patient_files.upload');

Route::get('/patient-files/download/{recordId}', [FileUploadController::class, 'downloadMedicalFile'])->name('patient_files.download');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
// require __DIR__ . '/superadmin.php';
