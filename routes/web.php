<?php

use App\Http\Controllers\Auth\DoctorAuthController;
use App\Http\Controllers\Auth\PatientAuthController;
use App\Http\Controllers\DoctorProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PatientProfileController;
use App\Http\Controllers\SocialLoginController;
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
Route::get('/login', [FrontendController::class, 'showLoginPage']) -> name('login.page') -> middleware('doctor.redirect');
Route::post('/login', [FrontendController::class, 'login']) -> name('login.page');

// Patient Pages
Route::get('/patient-register', [FrontendController::class, 'showPatientRegisterPage']) -> name('patient.reg.page') -> middleware('admin.redirect');
Route::get('/patient-dashboard', [FrontendController::class, 'showPatientDashPage']) -> name('patient.dash.page') -> middleware('admin');

Route::get('/patient-settings', [PatientProfileController::class, 'showPatientSettingsPage']) -> name('patient.settings.page') -> middleware('admin');
Route::get('/patient-password', [PatientProfileController::class, 'showPatientPasswordPage']) -> name('patient.password.page') -> middleware('admin');
Route::post('/patient-password', [PatientProfileController::class, 'patientPasswordChange']) -> name('patient.password.change') -> middleware('admin');

Route::post('/patient-register', [PatientAuthController::class, 'register']) -> name('patient.register');  
Route::get('/patient-logout', [PatientAuthController::class, 'logout']) -> name('patient.logout'); 
 
// Doctor Pages
Route::get('/doctor-register', [FrontendController::class, 'showDoctorRegisterPage']) -> name('doctor.reg.page') -> middleware('doctor.redirect');
Route::get('/doctor-dashboard', [FrontendController::class, 'showDoctorDashPage']) -> name('doctor.dash.page') -> middleware('doctor');

Route::get('/doctor-settings', [DoctorProfileController::class, 'showDoctorSettingsPage']) -> name('doctor.settings.page') -> middleware('doctor');
Route::get('/doctor-password', [DoctorProfileController::class, 'showDoctorPasswordPage']) -> name('doctor.password.page') -> middleware('doctor');
Route::post('/doctor-password', [DoctorProfileController::class, 'showDoctorPasswordChange']) -> name('doctor.password.change') -> middleware('doctor');

Route::post('/doctor-register', [DoctorAuthController::class, 'register']) -> name('doctor.register') -> middleware('doctor');
Route::get('/doctor-logout', [DoctorAuthController::class, 'logout']) -> name('doctor.logout') -> middleware('doctor');
Route::get('/doctor_account_activation/{token?}', [DoctorAuthController::class, 'DoctorAccountActivation']) -> name('doctor.account.activation') -> middleware('doctor');
Route::get('/doctor-forgot-password', [DoctorAuthController::class, 'showDoctorForgotPassword']) -> name('doctor.forgot.pass') -> middleware('doctor');
Route::post('/doctor-forgot-password', [DoctorAuthController::class, 'doctorForgotPassword']) -> name('doctor.forgot.password') -> middleware('doctor');
Route::get('/doctor_email_confirmation', [DoctorAuthController::class, 'doctorEmailConfirmation']) -> name('doctor.email.confirmation') -> middleware('doctor');

// Social Login Routes
Route::get('facebook-login-req', [SocialLoginController::class, 'sendFacebookLoginReq']) -> name('fb.req');
Route::get('facebook-login-system', [SocialLoginController::class, 'loginWithFacebook']);

Route::get('github-login-req', [SocialLoginController::class, 'sendGithubLoginReq']) -> name('gh.req');
Route::get('github-login-system', [SocialLoginController::class, 'loginWithGithub']);