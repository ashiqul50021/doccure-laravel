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
            background-color: #fff;
        }

        .content {
            padding: 0;
            height: 100%;
        }

        /* Split-Screen Layout Base */
        .split-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Left Side - Image & Overlay */
        .split-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-image: url("{{ asset('assets/img/doctor-01.jpg') }}");
            /* Reference image */
            background-size: cover;
            background-position: top center;
            position: relative;
            color: #fff;
        }

        .split-left-overlay {
            background-color: #345cce;
            /* The specific blue from the image */
            padding: 4rem;
            margin-top: auto;
            /* Push to bottom */
            width: 100%;
        }

        .overlay-content {
            border-left: 3px solid #fff;
            padding-left: 2rem;
            max-width: 500px;
        }

        .overlay-logo {
            filter: brightness(0) invert(1);
            max-width: 150px;
            margin-bottom: 2rem;
        }

        .overlay-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #fff;
            line-height: 1.2;
        }

        .overlay-text {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.5;
            margin: 0;
        }

        /* Right Side - Form */
        .split-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            padding: 2rem;
        }

        .split-form-container {
            width: 100%;
            max-width: 400px;
        }

        .form-header-logo {
            max-width: 130px;
            margin-bottom: 2rem;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: #6b7280;
            margin-bottom: 2.5rem;
            font-size: 0.95rem;
        }

        /* Custom Input Styling */
        .split-input {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            color: #1f2937;
            background-color: #fff;
            transition: border-color 0.2s;
        }

        .split-input:focus {
            border-color: #345cce;
            box-shadow: 0 0 0 3px rgba(52, 92, 206, 0.1);
            outline: none;
        }

        .split-input-group {
            position: relative;
        }

        .split-input-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            cursor: pointer;
        }

        .split-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
        }

        .split-btn {
            background-color: #345cce;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 0.875rem 1rem;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.2s;
        }

        .split-btn:hover {
            background-color: #2a4aaa;
            color: #fff;
        }

        .forgot-link {
            font-size: 0.875rem;
            color: #345cce;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 991.98px) {
            .split-left {
                display: none;
            }
        }
    </style>

    <div class="split-layout">
        <!-- Left Side: Brand & Illustration -->
        <div class="split-left">
            <div class="split-left-overlay">
                <img src="{{ !empty($siteSettings['logo']) ? asset($siteSettings['logo']) : asset('assets/img/logo.png') }}"
                    class="overlay-logo" alt="Logo">
                <div class="overlay-content">
                    <h1 class="overlay-title">Welcome to Invision Hospital Management System</h1>
                    <p class="overlay-text">Cloud Based Streamline Hospital Management system with centralized user friendly
                        platform.</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="split-right">
            <div class="split-form-container">
                <img src="{{ !empty($siteSettings['logo']) ? asset($siteSettings['logo']) : asset('assets/img/logo.png') }}"
                    class="form-header-logo" alt="Invision Logo">

                <h3 class="form-title">Login</h3>
                <p class="form-subtitle">Enter your credentials to login to your account</p>

                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="split-label">Email</label>
                        <input type="email" class="form-control split-input" name="email" required
                            value="{{ old('email') }}" placeholder="example@gmail.com">
                        @error('email') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-2">
                        <label class="split-label">Password</label>
                        <div class="split-input-group">
                            <input type="password" class="form-control split-input pe-5" name="password" required
                                placeholder="••••••••••••••">
                            <i class="far fa-eye split-input-icon"></i>
                        </div>
                        @error('password') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="text-end mb-4">
                        <a class="forgot-link" href="{{ route('forgot.password') }}">Forgot Password?</a>
                    </div>

                    <div class="d-grid mb-4">
                        <button class="btn split-btn" type="submit">Sign In</button>
                    </div>

                    <div class="text-center mt-4">
                        <span style="font-size: 0.875rem; color: #4b5563;">Don't have an account? <a
                                href="{{ route('register') }}"
                                style="color: #345cce; font-weight: 600; text-decoration: none;">Sign Up</a></span>
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