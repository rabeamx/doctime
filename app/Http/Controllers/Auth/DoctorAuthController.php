<?php

namespace App\Http\Controllers\Auth;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\DoctorAccountActivationNotification;
use App\Notifications\DoctorForgotPasswordActivation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorAuthController extends Controller
{
    // doctor register
    public function register(Request $request)
    {
        // data validation
        $this ->validate($request, [
            'name'    => 'required',
            'email'   => 'required|email|unique:doctors',
            'mobile'  => 'required',
            'pass'    => 'required|confirmed'
        ]);

        // create a token
        $token = md5(time(). rand()); 

        // data store
        $doctor = Doctor::create([
            'name'    => $request -> name,
            'email'   => $request -> email,
            'mobile'  => $request -> mobile,
            'access_token'  => $token,
            'password'=> Hash::make($request -> pass), 
        ]);

        // sent activation link to patient email
           $doctor -> notify(new DoctorAccountActivationNotification($doctor));

        return redirect() -> route('doctor.register') -> with('success', 'Doctor Added Successfully');
    }

    // // doctor login
    // public function login(Request $request)
    // {
    //     // data validate
    //     $this -> validate($request, [
    //         'email'  => 'required',
    //         'password'   => 'required',
    //     ]);

    //     // auth process
    //     if( Auth::guard('doctor') -> attempt(['email' => $request -> email, 'password' => $request -> password]) ){
    //         return redirect() -> route('doctor.dash.page');
    //     } else{
    //         return redirect() -> route('login.page') -> with('danger', 'wrong email or pass');
    //     } 
    // }

    // doctor logout
    public function logout()
    {
        Auth::guard('doctor') -> logout();
        return redirect() -> route('login.page');
    }

    // doctor account activation
    public function DoctorAccountActivation($token = null)
    {
        if(! $token){
            return redirect() -> route('login.page') -> with('danger', 'token not found');
        }

        if($token){
            $doctor_data = Doctor::Where('access_token', $token) -> first();
            $doctor_data -> update([
                'access_token'  => NULL,
                'status'  => true
            ]);
              
            if( $doctor_data ){
                return redirect() -> route('login.page') -> with('success', 'varified');
            } else{
                return redirect() -> route('login.page') -> with('danger', 'not match');
            }
        }
    }

    // Show doctor forgot password
    public function showDoctorForgotPassword()
    {
        return view('frontend.doctor.forgot');
    }

    // Doctor forgot password
    public function doctorForgotPassword(Request $request)
    {
        // data validate
        $this -> validate($request, [
            'email' => 'required|email'
        ]);

        // create token
        $token = md5(time(). rand());
       
        // doctor email check
        $doctor_data = Doctor::where('email', $request -> email) -> first();

        if($doctor_data){
            $doctor_data -> update([
                'access_token'  => $token
            ]);
            // password changing link
            $doctor_data -> notify(new DoctorForgotPasswordActivation($doctor_data));

            return redirect() -> route('doctor.forgot.password') -> with('success', 'doctor email sent');
        } else{
            return redirect() -> route('doctor.forgot.pass') -> with('danger', 'wrong doctor email sent');
        }

    }

    public function doctorEmailConfirmation()
    {
        # code...
    }
}
