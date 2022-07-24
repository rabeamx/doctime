<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;

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

    // doctor and patient login to dashboard
    public function login( Request $request )
    {
        // data validate
        $this -> validate($request, [ 
            'email'     => 'required',
            'password'  => 'required',
        ]);

        // auth process
        if ( Auth::guard('doctor') -> attempt(['email' => $request -> email, 'password' => $request -> password]) ){

            if( Auth::guard('doctor') -> user() -> access_token == null && Auth::guard('doctor') -> user() -> status == true ){
                return redirect() -> route('doctor.dash.page');
            }else {
                Auth::guard('doctor') -> logout();
                return redirect() -> route('login.page') -> with('danger', 'active your account please!');
            }

        }else if ( Auth::guard('patient') -> attempt(['email' => $request -> email, 'password' => $request -> password]) || Auth::guard('patient') -> attempt(['mobile' => $request -> email, 'password' => $request -> password]) ){
                
            if( Auth::guard('patient') -> user() -> access_token == null && Auth::guard('doctor') -> user() -> status == true ){
                return redirect() -> route('patient.dash.page');
            }else {
                Auth::guard('doctor') -> logout();
                return redirect() -> route('login.page') -> with('danger', 'active your account please!');
            }
            
        }else {
            return redirect() -> route('login.page') -> with('danger', 'wrong email or pass');
        }
        
    }
}
