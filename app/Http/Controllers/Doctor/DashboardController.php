<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Review;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Get the authenticated doctor or redirect.
     */
    private function getDoctor()
    {
        $doctor = Auth::user()->doctor;
        if (!$doctor) {
            abort(redirect()->route('home')->with('error', 'Doctor profile not found.'));
        }
        $doctor->load(['user', 'speciality']);
        return $doctor;
    }

    /**
     * Dashboard
     */
    public function index()
    {
        $doctor = $this->getDoctor();

        $totalPatients = Appointment::where('doctor_id', $doctor->id)
            ->distinct('patient_id')->count('patient_id');

        $todayPatients = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', today())
            ->distinct('patient_id')->count('patient_id');

        $totalAppointments = Appointment::where('doctor_id', $doctor->id)->count();

        $upcomingAppointments = Appointment::with(['patient.user'])
            ->where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', '>=', today())
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->get();

        $todayAppointments = Appointment::with(['patient.user'])
            ->where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_time', 'asc')
            ->get();

        return view('frontend.doctor-dashboard', compact(
            'doctor', 'totalPatients', 'todayPatients',
            'totalAppointments', 'upcomingAppointments', 'todayAppointments'
        ));
    }

    /**
     * Appointments page
     */
    public function appointments()
    {
        $doctor = $this->getDoctor();

        $appointments = Appointment::with(['patient.user'])
            ->where('doctor_id', $doctor->id)
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->paginate(10);

        return view('frontend.appointments', compact('doctor', 'appointments'));
    }

    /**
     * My Patients page
     */
    public function myPatients()
    {
        $doctor = $this->getDoctor();

        $patientIds = Appointment::where('doctor_id', $doctor->id)
            ->distinct()->pluck('patient_id');

        $patients = Patient::with('user')
            ->whereIn('id', $patientIds)
            ->paginate(10);

        return view('frontend.my-patients', compact('doctor', 'patients'));
    }

    /**
     * Reviews page
     */
    public function reviews()
    {
        $doctor = $this->getDoctor();

        $reviews = Review::with(['patient.user', 'appointment'])
            ->where('doctor_id', $doctor->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.reviews', compact('doctor', 'reviews'));
    }

    /**
     * Invoices page
     */
    public function invoices()
    {
        $doctor = $this->getDoctor();

        $invoices = Appointment::with(['patient.user'])
            ->where('doctor_id', $doctor->id)
            ->whereIn('status', ['completed', 'confirmed'])
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);

        return view('frontend.invoices', compact('doctor', 'invoices'));
    }

    /**
     * Social Media page
     */
    public function socialMedia()
    {
        $doctor = $this->getDoctor();
        return view('frontend.social-media', compact('doctor'));
    }

    /**
     * Update Social Media links
     */
    public function updateSocialMedia(Request $request)
    {
        $doctor = $this->getDoctor();

        $doctor->update([
            'website' => $request->website,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
        ]);

        return redirect()->back()->with('success', 'Social media links updated successfully!');
    }

    /**
     * Change Password page
     */
    public function changePassword()
    {
        $doctor = $this->getDoctor();
        return view('frontend.doctor-change-password', compact('doctor'));
    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    /**
     * Profile Settings page
     */
    public function profileSettings()
    {
        $doctor = $this->getDoctor();
        $specialities = \App\Models\Speciality::orderBy('name')->get();
        $districts = \App\Models\District::orderBy('name')->get();

        return view('frontend.doctor-profile-settings', compact('doctor', 'specialities', 'districts'));
    }

    /**
     * Accept Appointment
     */
    public function acceptAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->doctor_id !== Auth::user()->doctor->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $appointment->status = 'confirmed';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment confirmed successfully.');
    }

    /**
     * Cancel Appointment
     */
    public function cancelAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->doctor_id !== Auth::user()->doctor->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $appointment->status = 'cancelled';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment cancelled successfully.');
    }
}
