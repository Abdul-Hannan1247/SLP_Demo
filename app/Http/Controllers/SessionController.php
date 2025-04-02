<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sessions = Session::all(); // Retrieve all sessions from the database

        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic to display the form for creating a new session
        return view('sessions.create'); // Create a view named sessions/create.blade.php
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            // Your validation rules here
        ]);

        // Create a new session in the database
        $session = Session::create($validatedData); // Replace Session with your model

        // Redirect to a success page or display a success message
        return redirect()->route('sessions.index')->with('success', 'Session created successfully!'); // Assuming you have a sessions.index route
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
{
    return view('sessions.edit', compact('session'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Session $session)
    {
        $session->delete();

        return redirect()->route('sessions.index')->with('success', 'Session deleted successfully!');
    }
}
