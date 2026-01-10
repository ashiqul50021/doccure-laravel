<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Schedule;

class BookingController extends Controller
{
    public function index($doctor_id)
    {
        $doctor = Doctor::with(['user', 'speciality', 'schedules'])->findOrFail($doctor_id);

        // Generate next 7 days dates
        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $dates[] = now()->addDays($i);
        }

        return view('frontend.booking', compact('doctor', 'dates'));
    }

    public function bookAppointment(Request $request, $doctor_id)
    {
        $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        $doctor = Doctor::findOrFail($doctor_id);

        // Store booking details in session
        session([
            'booking_details' => [
                'doctor_id' => $doctor_id,
                'date' => $request->appointment_date,
                'time' => $request->appointment_time,
                'fee' => $doctor->pricing === 'custom_price' ? $doctor->custom_price : 0
            ]
        ]);

        return redirect()->route('checkout');
    }

    public function checkout()
    {
        $booking = session('booking_details');
        if (!$booking) {
            return redirect()->route('home');
        }

        $doctor = Doctor::with('user', 'speciality')->findOrFail($booking['doctor_id']);

        return view('frontend.checkout', compact('doctor', 'booking'));
    }

    public function processPayment()
    {
        $booking = session('booking_details');
        if (!$booking) {
            return redirect()->route('home');
        }

        // Here we would create the appointment record
        // For now, let's assume successful payment

        // $appointment = Appointment::create([...]);

        // Clear session
        session()->forget('booking_details');

        return redirect()->route('booking.success');
    }
}
