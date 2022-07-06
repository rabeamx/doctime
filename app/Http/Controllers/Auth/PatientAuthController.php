<?php

namespace App\Http\Controllers\Auth;

use App\Models\Patient;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use function GuzzleHttp\Promise\all;

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
            'email'   => 'required',
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
        return redirect() -> route('patient.reg.page') -> with('success', " Hi ". $request -> name .", Your account is ready. Now, login");
    }

    public function login(Request $request)
    {
        // data validate
        $this -> validate($request, [
            'email'     => 'required',
            'password'  => 'required',
        ]);

        // return back
        return $request -> all();
    }
}
