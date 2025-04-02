import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');

    const calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin, timeGridPlugin, interactionPlugin ],
        initialView: 'dayGridMonth', // Default view
        events: '/schedule/events', // Endpoint to fetch events
        selectable: true, // Allow date selection
        select: function(info) {
            // Handle date selection
            console.log('Selected: ' + info.startStr + ' to ' + info.endStr);
            // You can open a modal or form to book an appointment here.
        },
        eventClick: function(info) {
            // Handle event click
            console.log('Event: ' + info.event.title);
            // You can open a modal to view event details.
        }
    });

    calendar.render();
});