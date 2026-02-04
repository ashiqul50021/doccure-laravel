@extends('layouts.app')

@section('title', 'Login - ' . ($siteSettings['site_name'] ?? 'Doccure'))

@section('body_class', 'account-page')

@section('content')
    <style>
        /* Hide default layout elements for a standalone login page */
        .header,
        .footer,
        .mobile-bottom-nav {
            display: none !important;
        }

        .main-wrapper {
            padding: 0;
            margin: 0;
            height: 100vh;
            overflow: hidden;
        }

        .content {
            padding: 0;
            height: 100%;
        }

        /* Split Screen Layout */
        .login-wrapper {
            display: flex;
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        /* Left Side - Brand & Illustration */
        .login-left {
            width: 55%;
            background: linear-gradient(135deg, #09e5ab 0%, #2f80ed 100%);
            /* Doccure teal to blue */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 40px;
            color: #fff;
            text-align: center;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("{{ asset('assets/img/shape-01.png') }}") no-repeat;
            /* Fallback or texture if available, else ignored */
            opacity: 0.1;
            background-size: cover;
        }

        .login-brand-logo {
            margin-bottom: 40px;
            max-width: 180px;
            filter: brightness(0) invert(1);
            /* Make logo white */
        }

        .login-illustration {
            max-width: 80%;
            height: auto;
            margin-bottom: 30px;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.15));
        }

        .login-left h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #fff;
        }

        .login-left p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 500px;
        }

        /* Right Side - Form */
        .login-right {
            width: 45%;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            overflow-y: auto;
        }

        .login-right-wrap {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-header h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #272b41;
        }

        .login-header p {
            color: #757575;
            margin-bottom: 30px;
        }

        /* Specific Fixes */
        .form-focus .form-control {
            height: 46px; /* Reduced from 55px */
            padding: 21px 15px 3px !important; /* Adjusted padding for smaller height */
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: none;
            font-size: 15px;
            font-weight: 500;
        }

        .form-focus .focus-label {
            top: 16px;
            left: 15px;
            font-size: 14px;
            color: #888;
            font-weight: 400;
            transition: all 0.3s;
            pointer-events: none;
            position: absolute;
            line-height: 1;
            background-color: #fff;
            padding: 0 4px;
            z-index: 10;
        }

        .form-focus.focused .focus-label,
        .form-focus .form-control:not(:placeholder-shown)~.focus-label {
            top: -8px !important;
            /* Move ABOVE border */
            left: 10px;
            font-size: 12px;
            color: #09e5ab;
        }

        .form-focus.focused .form-control {
            border-color: #09e5ab;
        }

        .btn-primary.login-btn {
            background: #09e5ab;
            border: none;
            height: 46px; /* Reduced from 55px */
            border-radius: 10px;
            font-size: 16px; /* Slightly smaller font for smaller button */
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(9, 229, 171, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary.login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(9, 229, 171, 0.4);
            background: #06cf9a;
        }

        .login-or {
            color: #ababab;
            margin: 20px 0;
            padding: 10px 0;
            position: relative;
        }

        .or-line {
            background-color: #e5e5e5;
            height: 1px;
            display: block;
        }

        .span-or {
            background-color: #fff;
            display: block;
            margin: -10px auto 0;
            position: relative;
            text-align: center;
            width: 42px;
            font-weight: 500;
        }

        .text-center.mt-4.text-muted a {
            text-decoration: none;
        }

        @media (max-width: 991.98px) {
            .login-left {
                display: none;
            }

            .login-right {
                width: 100%;
                padding: 20px;
            }

            .header,
            .footer,
            .mobile-bottom-nav {
                display: none !important;
            }
        }
    </style>
    <div class="login-wrapper">
        <!-- Left Side: Brand & Illustration -->
        <div class="login-left">
            <img src="{{ !empty($siteSettings['logo']) ? asset($siteSettings['logo']) : asset('assets/img/logo.png') }}"
                class="login-brand-logo" alt="Logo">
            <img src="{{ asset('assets/img/login-banner.png') }}" class="login-illustration" alt="Illustration">
            <h1>Welcome to ABCSHEBA</h1>
            <p>Your health is our priority. Connect with top doctors and manage your appointments easily.</p>
        </div>

        <!-- Right Side: Login Form -->
        <div class="login-right">
            <div class="login-right-wrap">
                <div class="login-header">
                    <h3>Welcome Back</h3>
                    <p>Please enter your details to sign in.</p>
                </div>

                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="form-focus">
                            <input type="email" class="form-control floating" name="email" required
                                value="{{ old('email') }}" placeholder=" ">
                            <label class="focus-label">Email Address</label>
                        </div>
                        @error('email') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-focus">
                            <input type="password" class="form-control floating" name="password" required placeholder=" ">
                            <label class="focus-label">Password</label>
                        </div>
                        @error('password') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label text-muted" for="remember">Remember me</label>
                        </div>
                        <a class="forgot-link text-primary fw-medium" href="{{ route('forgot.password') }}">Forgot
                            Password?</a>
                    </div>

                    <button class="btn btn-primary login-btn w-100" type="submit">Sign In</button>

                    <div class="text-center mt-4 text-muted">
                        Don't have an account? <a href="{{ route('register') }}" class="fw-bold text-primary">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Manually handle floating label interactions to ensure they work reliably
        document.addEventListener('DOMContentLoaded', function () {
            const formInputs = document.querySelectorAll('.form-focus .form-control');

            formInputs.forEach(input => {
                // Initial check
                updateLabel(input);

                // Events
                input.addEventListener('focus', function () {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function () {
                    updateLabel(this);
                });

                input.addEventListener('input', function () {
                    updateLabel(this);
                });
            });

            function updateLabel(input) {
                if (input.value.length > 0 || document.activeElement === input) {
                    input.parentElement.classList.add('focused');
                } else {
                    input.parentElement.classList.remove('focused');
                }
            }
        });
    </script>
@endsection