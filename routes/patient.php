<?php

use App\Http\Controllers\Patient\FileUploadController;
use App\Http\Controllers\Frontend\FrontdeskDashboardController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Patient\PatientController;
use Illuminate\Support\Facades\Route;


Route::resource('patients', PatientController::class);

Route::get('/patient-files/create', [FileUploadController::class, 'create'])->name('patient_files.create');


Route::post('/patient-files/upload', [FileUploadController::class, 'uploadPatientFile'])->name('patient_files.upload');

Route::get('/patient-files/download/{recordId}', [FileUploadController::class, 'downloadPatientFile'])->name('patient_files.download');

/**
 * 
 * -------------------------------------------------------------------
 *                  Trashed Patients Route
 * -------------------------------------------------------------------
 * NOTE:-  Also when i use "patients/trashed" it gives 404 error.
 *          but it works fine when i use any other route 
 *          Eg:  p/trashed
 *               pati/temp
 *               /trashed
 */


Route::get('patient/trashed', [PatientController::class,'trashed'])->name('patients.trashed');

Route::put('/patients/{id}/restore', [PatientController::class, 'restore'])->name('patients.restore');

Route::delete('/patients/{id}/force-delete', [PatientController::class, 'forceDelete'])->name('patients.forceDelete');
