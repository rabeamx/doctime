<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    // send req for login facebook
    public function sendFacebookLoginReq()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // facebook login info
    public function loginWithFacebook()
    {
        $user = Socialite::driver('facebook')->user();

        $login_user = Doctor::where('oauth_id', $user -> id) -> first();
        if($login_user){
            Auth::guard('doctor') -> login($login_user);
            return redirect('/doctor-dashboard');
        } else{
            $doctor = Doctor::create([
                'name'  => $user -> name,
                'email' => $user -> id,
                'password' => '',
                'status' => true,
                'oauth_id' => $user -> id,
            ]);

            Auth::guard('doctor') -> login($doctor);
            return redirect('/doctor-dashboard');
        }
        
    }

    // send req for login facebook
    public function sendGithubLoginReq()
    {
        return Socialite::driver('github')->redirect();
    }

    // facebook login info
    public function loginWithGithub()
    {
        $user = Socialite::driver('github')->user();

        $login_user = Doctor::where('oauth_id', $user -> id) -> first();
        if($login_user){
            Auth::guard('doctors') -> login($login_user);
            return redirect('/doctor-dashboard');
        } else{
            $doctor = Doctor::create([
                'name'  => $user -> name,
                'email' => $user -> id,
                'password' => '',
                'status' => true,
                'oauth_id' => $user -> id,
            ]);

            Auth::guard('doctor')->login($doctor);
            return redirect('/doctor-dashboard');
        }
        
    }
}
