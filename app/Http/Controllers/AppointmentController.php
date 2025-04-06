<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all(); // Retrieve all patients
        // $existingAppointments = Appointment::with('patient')->get(); 
                   $earliestAppointments = Appointment::orderBy('date', 'asc')
        ->orderBy('time', 'asc') // To break ties if dates are the same
        ->take(5)
        ->get();

        // dd($patients);
        return view('appointments.create', compact('patients', 'earliestAppointments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'appointment_notes' => 'nullable|string',
        ]);
    
        Appointment::create([
            'patient_name' => $request->patient_name, // Directly store the patient's name
            'date' => $request->date,
            'time' => $request->time,
            'appointment_notes' => $request->notes,
        ]);
    
        return redirect()->route('appointments.create')->with('success', 'Appointment created successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::with('patient')->get(); 
     
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id); // Fetch the appointment by ID
        return view('appointments.edit', compact('appointment'));
        
    }

    
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'patient_name' => 'required|exists:patients,id',
            'date' => 'required|date',
            'time' => 'required',
            'appointment_notes' => 'nullable|string',
        ]);

        $appointment->update($request->all());

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
                'title' => $appointment->patient_name, // Include time in title
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