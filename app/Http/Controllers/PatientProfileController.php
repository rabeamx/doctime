<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PatientProfileController extends Controller
{
    /**
     *  Show patient Settings Page
     */
    public function showPatientSettingsPage()
    {
        return view('frontend.patient.settings');
    }

    /**
     *  Show patient Password Page
     */
    public function showPatientPasswordPage()
    {
        return view('frontend.patient.password');
    }

    /**
     *  Show patient Password Change Page
     */
    public function patientPasswordChange(Request $request)
    {
        // Old Password Check
        if( !password_verify( $request -> old_pass, Auth::guard('patient') -> user() -> password ) ){
            return back() -> with('danger', 'Old Pass doesnt match');
        }

        // Password Confirmation
        if( $request -> pass != $request -> pass_confirmation ){
            return back() -> with('warning', 'Password Confirmation Failed');
        }

        $data = Patient::findOrFail(Auth::guard('patient') -> user() -> id);
        $data -> update([
            'password' => Hash::make($request -> pass)
        ]);

        Auth::guard('patient') -> logout();
        return redirect() -> route('login.page') -> with('success', 'Hogaya success');
    }
}
