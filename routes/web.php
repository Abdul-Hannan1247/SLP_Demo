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


/**
 * ------------------------------------------------------------------
 *                           Admin Dashboard Routes
 * ------------------------------------------------------------------
 */


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');



Route::resource('patients', PatientController::class);

Route::get('/patient-files/create', [FileUploadController::class, 'create'])->name('patient_files.create');


Route::post('/patient-files/upload', [FileUploadController::class, 'uploadPatientFile'])->name('patient_files.upload');

Route::get('/patient-files/download/{recordId}', [FileUploadController::class, 'downloadPatientFile'])->name('patient_files.download');





Route::get('patient/trashed', [PatientController::class,'trashed'])->name('patients.trashed');

Route::put('/patients/{id}/restore', [PatientController::class, 'restore'])->name('patients.restore');

Route::delete('/patients/{id}/force-delete', [PatientController::class, 'forceDelete'])->name('patients.forceDelete');



require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/patient.php';
// require __DIR__ . '/superadmin.php';
