<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientProfileController extends Controller
{
    /**
     *  Show patient Settings Page
     */
    public function showPatientSettingsPage(Request $request)
    {
        return view('frontend.patient.settings');
    }

    /**
     *  Show patient Password Page
     */
    public function showPatientPasswordPage(Request $request)
    {
        return view('frontend.patient.password');
    }
}
