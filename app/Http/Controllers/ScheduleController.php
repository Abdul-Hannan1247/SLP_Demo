<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('schedule.calendar');
    }

    public function getEvents()
    {
        // Fetch events from your database or any other source
        $events = [
            [
                'title' => 'Appointment 1',
                'start' => '2024-10-27T10:00:00',
                'end' => '2024-10-27T11:00:00',
            ],
            [
                'title' => 'Appointment 2',
                'start' => '2024-10-28T14:00:00',
                'end' => '2024-10-28T15:30:00',
            ],
            // ... more events
        ];

        return response()->json($events);
    }
}