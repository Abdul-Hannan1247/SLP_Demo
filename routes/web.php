<?php

use App\Http\Controllers\Calendar\CalendarController;
use App\Http\Controllers\Patient\FileUploadController;
use App\Http\Controllers\Frontend\FrontdeskDashboardController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SessionController;
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


// Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');

Route::get('/schedule/calendar', [ScheduleController::class, 'index'])->name('schedule.calendar');
Route::get('/schedule/events', [ScheduleController::class, 'getEvents']);


Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');

Route::get('/sessions/create', [SessionController::class, 'create'])->name('sessions.create');

Route::post('/sessions', [SessionController::class, 'store'])->name('sessions.store');
Route::get('/sessions/{session}/edit', [SessionController::class, 'edit'])->name('sessions.edit');
Route::delete('/sessions/{session}', [SessionController::class, 'destroy'])->name('sessions.destroy');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/patient.php';
// require __DIR__ . '/superadmin.php';
