<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;

class AdminController extends Controller
{
    public function dashboard()
    {
        $doctorCount = Doctor::count();
        $patientCount = Patient::count();
        $appointmentCount = Appointment::count();

        // Recent doctors or appointments could be added here
        $recentDoctors = Doctor::with('user', 'speciality')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('doctorCount', 'patientCount', 'appointmentCount', 'recentDoctors'));
    }

    public function doctors()
    {
        $doctors = Doctor::with('user', 'speciality')->latest()->get();
        return view('admin.doctor-list', compact('doctors'));
    }

    public function approveDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update([
            'status' => 'approved',
            'is_verified' => true,
        ]);

        return back()->with('success', 'Doctor approved successfully.');
    }

    public function rejectDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Doctor rejected successfully.');
    }
}
