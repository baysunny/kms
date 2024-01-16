<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;



// ############## frontend ##############

// authentication
Route::get('/', function () {
    return '<a href="/login">Login</a>';
});
Route::get('/login', [AuthController::class, 'vlogin'])->name('login');

// users
Route::get('/register', [UserController::class, 'vregister'])->name('register');


// protected routes
Route::group(['middleware' => ['web', 'auth']], function()  {
	
	// FRONTEND
	// dashboard
	Route::get('/dashboard', [PatientController::class, 'index']);

	// patient
	Route::get('/dashboard/patients', [PatientController::class, 'index']);
	Route::get('/dashboard/patients/{patient}/edit', [PatientController::class, 'edit']);
	Route::get('/dashboard/patients/{patient}/appointments', [PatientController::class, 'appointments']);
	Route::get('/dashboard/patients/create', [PatientController::class, 'create']);
	Route::get('/dashboard/patients/{patient}/appointments/exportPDF', [PatientController::class, 'export_pdf']);

	// appointment
	Route::get('/dashboard/appointments', [AppointmentController::class, 'index']);
	Route::get('/dashboard/appointments/create', [AppointmentController::class, 'create']);
	Route::get('/dashboard/appointments/exportPDF/{start?}/{end?}', [AppointmentController::class, 'export_pdf']);



	// BACKEND
	// patient
	Route::post('/dashboard/patients/', [PatientController::class, 'store']);
	Route::put('/dashboard/patients/{patient}', [PatientController::class, 'update']);
	Route::delete('/dashboard/patients/{patient}', [PatientController::class, 'destroy']);

	// appointment
	Route::post('/dashboard/appointments/', [AppointmentController::class, 'store']);
	Route::put('/dashboard/appointments/{id}', [AppointmentController::class, 'cancelAppointment']);

	Route::post('/logout', [AuthController::class, 'logout']);
});




// ############## backend ##############

// authentication
Route::post('/login', [AuthController::class, 'login']);

// users
Route::post('/users', [UserController::class, 'store']);




// Route::any('{any}', function () {
//     abort(404);
// })->where('any', '.*');