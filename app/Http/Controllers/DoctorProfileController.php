<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorProfileController extends Controller
{
    // doctor profile setting show
    public function showDoctorSettingsPage()
    {
        return view('frontend.doctor.settings');
    }

    // doctor password page show
    public function showDoctorPasswordPage()
    {
        return view('frontend.doctor.password');
    }

    // doctor password page show
    public function showDoctorPasswordChange( Request $request)
    {
         // data validate
         $this -> validate($request, [
            'old_pass'  => 'required',
            'pass'  => 'required',
        ]);

        // old pass check
        if( !password_verify( $request -> old_pass, Auth::guard('doctor') -> user() -> password ) ){
            return back() -> with('danger', 'old password not match');
        }

        // pass confirmation
        if( $request -> pass != $request -> pass_confirmation ){
            return back() -> with('danger', 'password confirmation failed');
        }

        $data = Doctor::findOrFail(Auth::guard('doctor') -> user() -> id);
        $data -> update([
            'password'  => Hash::make($request -> pass),
        ]);

        Auth::guard('doctor') -> logout();
        return redirect() -> route('login.page') -> with('success', 'hogaya change');
    }

    // doctor profile photo upload
    
}
