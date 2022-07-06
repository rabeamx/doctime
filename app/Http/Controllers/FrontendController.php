<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class FrontendController extends Controller
{
    // Show Home Page
    public function showHomePage()
    {
        return view('frontend.home');
    }

    // Show Login Page
    public function showLoginPage()
    {
        return view('frontend.login');
    }

    // Show Patient Register Page
    public function showPatientRegisterPage()
    {
        return view('frontend.patient.register');
    }

    // Show Patient Dashboard Page
    public function showPatientDashPage()
    {
        return view('frontend.patient.dashboard');
    }

    // Show Doctor Register Page
    public function showDoctorRegisterPage()
    {
        return view('frontend.doctor.register');
    }

    // Show Doctor Dashboard Page
    public function showDoctorDashPage()
    {
        return view('frontend.doctor.dashboard');
    }
}
