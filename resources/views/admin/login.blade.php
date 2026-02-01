@extends('layouts.admin')

@section('title', 'Login - ' . ($siteSettings['site_name'] ?? 'Doccure Admin'))

@section('content')
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="{{ asset('assets/img/logo-white.png') }}" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle">Access to our dashboard</p>

                            <!-- Form -->
                            <form action="{{ route('admin.login.submit') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input class="form-control" type="text" name="email" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="password" name="password" placeholder="Password"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                                </div>
                            </form>
                            <!-- /Form -->

                            <div class="text-center forgotpass"><a href="{{ route('admin.forgot.password') }}">Forgot
                                    Password?</a></div>
                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>
                            <div class="social-login">
                                <span>Login with</span>
                                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a><a href="#"
                                    class="google"><i class="fab fa-google"></i></a>
                            </div>
                            <div class="text-center dont-have">Don’t have an account? <a
                                    href="{{ route('admin.register') }}">Register</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection