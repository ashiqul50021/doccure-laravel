<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $doctor = $user->doctor;

        if (!$doctor) {
            return redirect()->route('home')->with('error', 'Doctor profile not found.');
        }

        // Statistics
        $totalPatients = \App\Models\Appointment::where('doctor_id', $doctor->id)
            ->distinct('patient_id')
            ->count('patient_id');

        $todayPatients = \App\Models\Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', today())
            ->distinct('patient_id')
            ->count('patient_id');

        $totalAppointments = \App\Models\Appointment::where('doctor_id', $doctor->id)->count();

        // Upcoming Appointments (From today onwards, preserving order)
        $upcomingAppointments = \App\Models\Appointment::with(['patient.user'])
            ->where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', '>=', today())
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->get();

        // Today Appointments
        $todayAppointments = \App\Models\Appointment::with(['patient.user'])
            ->where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_time', 'asc')
            ->get();

        return view('frontend.doctor-dashboard', compact(
            'doctor',
            'user',
            'totalPatients',
            'todayPatients',
            'totalAppointments',
            'upcomingAppointments',
            'todayAppointments'
        ));
    }

    public function acceptAppointment($id)
    {
        $appointment = \App\Models\Appointment::findOrFail($id);

        // Ensure this appointment belongs to the logged-in doctor
        if ($appointment->doctor_id !== auth()->user()->doctor->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $appointment->status = 'confirmed';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment confirmed successfully.');
    }

    public function cancelAppointment($id)
    {
        $appointment = \App\Models\Appointment::findOrFail($id);

        // Ensure this appointment belongs to the logged-in doctor
        if ($appointment->doctor_id !== auth()->user()->doctor->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $appointment->status = 'cancelled';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment cancelled successfully.');
    }
}
