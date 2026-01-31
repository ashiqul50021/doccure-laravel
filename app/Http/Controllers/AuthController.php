<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    // Show Patient Login (Default)
    public function showLoginForm()
    {
        return view('frontend.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect based on role
            if ($user->role === 'doctor') {
                return redirect()->route('doctor.dashboard');
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Assuming route exists
            }

            return redirect()->route('patient.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Show Patient Register
    public function showPatientRegisterForm()
    {
        return view('frontend.register');
    }

    // Handle Patient Registration
    public function registerPatient(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:15'], // Add mobile to User model if needed or create separate field
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'patient',
        ]);

        // Create Patient Profile
        Patient::create([
            'user_id' => $user->id,
            'address' => '', // Placeholder
            // Add other default fields if necessary
        ]);

        Auth::login($user);

        return redirect()->route('patient.dashboard');
    }

    // Show Doctor Register
    public function showDoctorRegisterForm()
    {
        return view('frontend.doctor-register');
    }

    // Handle Doctor Registration
    public function registerDoctor(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms_accept' => ['accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'doctor',
        ]);

        // Create Doctor Profile (Pending Status)
        Doctor::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'phone' => $request->mobile, // Assuming phone field exists in doctor table from migration
            // Speciality and Qualification are now nullable
        ]);

        Auth::login($user);

        return redirect()->route('doctor.dashboard')->with('status', 'Your account is pending approval.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
