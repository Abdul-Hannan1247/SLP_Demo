<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
 
    public function create(): View
    {
        $existingAppointments = Appointment::latest()->take(5)->get(); // Example of fetching existing appointments
        $appointments = Appointment::with('patient')->latest()->paginate(10); // Adjust pagination as needed
        return view('appointments.create', compact('appointments','existingAppointments'));
    }

  
    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        Appointment::create([
            'patient_name' => $validatedData['patient_name'], // Save the entered name
            'date' => $validatedData['date'],
            'time' => $validatedData['time'],
            'notes' => $validatedData['appointment_notes'] ?? null,
            // If you still want to associate with a Patient model later, you might need to add logic here
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::with('patient')->get(); // Retrieve appointments with patient data.

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $appointment = Appointment::findOrFail($id); // Fetch the appointment by ID
    //     return view('appointments.edit', compact('appointment'));
        
    // }
    public function edit(Appointment $appointment): View
    {
        $patients = Patient::all(); // Fetch all patients to populate the dropdown
        return view('appointments.edit', compact('appointment', 'patients'));
    }

   
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'time' => 'required',
            'appointment_notes' => 'nullable|string',
        ]);
        $validatedData = $request->only(['patient_id', 'date', 'time', 'appointment_notes']);


        $appointment->update($validatedData);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    
    /**
     * 
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id); // Fetch the appointment by ID
        $appointment->delete(); // Delete the appointment
        
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
        
    }
    /**---------------------------------------------------------------------
     *             Used to integrate Appointment with Calendar                 
     *---------------------------------------------------------------------
     */

     public function calendar()
    {
        $appointments = Appointment::with('patient')->get();

        $events = [];

        foreach ($appointments as $appointment) {
            $events[] = [
                'id' => $appointment->id,
                'title' => $appointment->patient->name, // Include time in title
                'start' => $appointment->date . 'T' . $appointment->time,
                // 'end' => $appointment->date . 'T' . $appointment->time, // Adjust if you have end times
                'url' => route('appointments.edit', $appointment->id),
                'backgroundColor' => $this->generateRandomColor(), // Generate unique color
                'borderColor' => $this->generateRandomColor(), // Optional: Border color
                'textColor' => '#ffffff', // Optional: Text color
            ];
        }

        return view('appointments.calendar', compact('events'));
    }

    // Helper function to generate a random color
    private function generateRandomColor()
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
    
    
    
}