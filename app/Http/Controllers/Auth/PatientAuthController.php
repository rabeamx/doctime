<?php

namespace App\Http\Controllers\Auth;

use App\Models\Patient;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;

class PatientAuthController extends Controller
{
    /** 
     *  Patient Register
     */
    public function register(Request $request)
    {
        // data validate
        $this -> validate($request, [
            'name'     => 'required',
            'email'   => 'required|email|unique:patients',
            'mobile'    => 'required',
            'pass'=> 'required|confirmed',
        ]);

        // data store
        $patient = Patient::create([
            'name'       => $request -> name,
            'email'      => $request -> email,
            'mobile'     => $request -> mobile,
            'password'   => password_hash($request -> pass, PASSWORD_DEFAULT),

        ]);

        // return back
        return redirect() -> route('patient.reg.page') -> with('success', " Hi ". $patient -> name .", Your account is ready. Now, login");
    }
    
    // // Patient login 
    // public function login(Request $request)
    // {
    //     // data validate
    //     $this -> validate($request, [
    //         'email'     => 'required',
    //         'password'  => 'required',
    //     ]);

    //     // Auth Process
    //     if( Auth::guard('patient') -> attempt(['email' => $request -> email, 'password' => $request -> password]) || Auth::guard('patient') -> attempt(['mobile' => $request -> email, 'password' => $request -> password]) ){
    //         return redirect() -> route('patient.dash.page'); 
    //     }else {
    //         return redirect() -> route('login.page') -> with('danger', 'WRONG EMAIL OR PASS');
    //     }
    // }

    // Patient Logout 
    public function logout()
    {
        Auth::guard('patient') -> logout();
        return redirect() -> route('login.page');
    }
    
}
