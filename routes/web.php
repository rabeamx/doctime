<?php

use App\Http\Controllers\Auth\PatientAuthController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Frontend Controller
Route::get('/', [FrontendController::class, 'showHomePage']) -> name('home.page');
Route::get('/login', [FrontendController::class, 'showLoginPage']) -> name('login.page');

// Patient Pages
Route::get('/patient-register', [FrontendController::class, 'showPatientRegisterPage']) -> name('patient.reg.page');
Route::get('/patient-dashboard', [FrontendController::class, 'showPatientDashPage']) -> name('patient.dash.page');
Route::post('/patient-register', [PatientAuthController::class, 'register']) -> name('patient.register'); 

// Doctor Pages
Route::get('/doctor-register', [FrontendController::class, 'showDoctorRegisterPage']) -> name('doctor.reg.page');
Route::get('/doctor-dashboard', [FrontendController::class, 'showDoctorDashPage']) -> name('doctor.dash.page');