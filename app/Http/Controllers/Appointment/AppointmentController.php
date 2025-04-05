<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(): View
    {
        $appointments = Appointment::latest()->paginate(10);
        return view('appointments.index', compact('appointments'));
    }

    public function create(): View
    {
        $existingAppointments = Appointment::latest()->take(5)->get(); // Fetch the 5 latest appointments
        return view('appointments.create', compact('existingAppointments'));
    }

    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        Appointment::create($request->validated());

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully!');
    }

    public function edit(Appointment $appointment): View
    {
        return view('appointments.edit', compact('appointment'));
    }

    public function update(StoreAppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        $appointment->update($request->validated());

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully!');
    }
}