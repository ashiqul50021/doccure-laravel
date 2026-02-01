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

    public function patients()
    {
        $patients = Patient::with('user')->latest()->get();
        return view('admin.patient-list', compact('patients'));
    }

    public function appointments()
    {
        $appointments = Appointment::with(['doctor.user', 'patient.user', 'speciality'])->latest()->get();
        return view('admin.appointment-list', compact('appointments'));
    }

    public function reviews()
    {
        $reviews = \App\Models\Review::with(['doctor.user', 'patient.user'])->latest()->get();
        return view('admin.reviews', compact('reviews'));
    }

    public function transactions()
    {
        // Assuming Order or Transaction model exists
        if (class_exists('App\Models\Transaction')) {
            $transactions = \App\Models\Transaction::with('patient.user')->latest()->get();
        } else {
            $transactions = []; // Fallback
        }
        return view('admin.transactions-list', compact('transactions'));
    }

    public function reports()
    {
        // Placeholder for reports
        return view('admin.invoice-report');
    }
}
