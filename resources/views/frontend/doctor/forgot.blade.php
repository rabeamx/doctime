@extends('frontend.layouts.app')

@section('main')

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-8 offset-md-2">
    
                <!-- Account Content -->
                <div class="account-content">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7 col-lg-6 login-left">
                            <img src="{{ url('frontend/assets/img/login-banner.png') }}" class="img-fluid" alt="Login Banner">	
                        </div>
                        <div class="col-md-12 col-lg-6 login-right">
                            <div class="login-header">
                                <h3>Forgot Password?</h3>
                                <p class="small text-muted">Enter your email to get a password reset link</p>
                            </div>
                            
                            <!-- Forgot Password Form -->
                            @include('validate')
                            <form action="{{ route('doctor.forgot.password') }}" method="POST">
                                @csrf
                                <div class="form-group form-focus">
                                    <input name="email" type="email" class="form-control floating">
                                    <label class="focus-label">Email</label>
                                </div>
                                <div class="text-right">
                                    <a class="forgot-link" href="{{ route('login.page') }}">Remember your password?</a>
                                </div>
                                <button class="btn btn-primary submit-btn" type="submit">Reset Password</button>
                            </form>
                            <!-- /Forgot Password Form -->
                            
                        </div>
                    </div>
                </div>
                <!-- /Account Content -->
                
            </div>
        </div>

    </div>
</div>		
<!-- /Page Content -->
    
@endsection