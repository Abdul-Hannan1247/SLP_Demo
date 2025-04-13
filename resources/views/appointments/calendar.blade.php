@extends('admin.layouts.master')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Appointments Calendar</h2>
                    <br>
                    <br>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="input-icon">
                                <input type="text" class="form-control rounded-pill" placeholder="Search appointments..." id="appointmentSearch">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('appointments.create') }}" class="btn btn-primary rounded-pill shadow-sm" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Add Appointment
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="btn-group shadow-sm rounded-pill">
                <button class="btn btn-secondary active rounded-pill" id="monthButton" style="padding: 0.5rem 0.75rem; font-size: 0.9rem;">Month</button>
                <button class="btn btn-secondary rounded-pill" id="weekButton" style="padding: 0.5rem 0.75rem; font-size: 0.9rem;">Week</button>
                {{-- <button class="btn btn-secondary rounded-pill" id="todayButton" style="padding: 0.5rem 0.75rem; font-size: 0.9rem;">Today</button> --}}
            </div>
        </div>

        <div id="calendar"></div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <style>
        .btn-group .btn {
            border-radius: 25px;
            background-color: #f8f9fa; /* Light gray default */
            color: #495057; /* Dark gray default text */
            border: 1px solid #ced4da; /* Light border */
        }

        .btn-group .btn:hover {
            background-color: #e2e6ea; /* Slightly darker hover */
            border-color: #d1d7dc;
        }

        .btn-group .btn.active {
            background-color: #007bff !important; /* Blue active background - !important to override */
            color: white !important; /* White active text - !important to override */
            border-color: #007bff !important; /* Blue active border - !important to override */
        }

        .btn-group button:first-child {
            border-top-left-radius: 25px;
            border-bottom-left-radius: 25px;
        }

        .btn-group button:last-child {
            border-top-right-radius: 25px;
            border-bottom-right-radius: 25px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($events),
                editable: true, // Enable dragging
                eventDrop: function(info) {
                    const newStart = info.event.start.toISOString();
                    const appointmentId = info.event.id;

                    updateAppointmentTime(appointmentId, newStart);
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    if (info.event.url) {
                        window.location.href = info.event.url;
                    }
                },
            });
            calendar.render();

            const monthButton = document.getElementById('monthButton');
            const weekButton = document.getElementById('weekButton');
            const searchInput = document.getElementById('appointmentSearch');

            weekButton.addEventListener('click', function() {
                calendar.changeView('timeGridWeek');
                setActiveButton('weekButton');
            });

            monthButton.addEventListener('click', function() {
                calendar.changeView('dayGridMonth');
                setActiveButton('monthButton');
            });

            // Set "Month" as active on initial load
            setActiveButton('monthButton');

            function setActiveButton(buttonId) {
                var buttons = document.querySelectorAll('.btn-group .btn');
                buttons.forEach(function(button) {
                    button.classList.remove('active');
                });
                const activeButton = document.getElementById(buttonId);
                if (activeButton) {
                    activeButton.classList.add('active');
                }
            }

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                calendar.getEvents().forEach(function(event) {
                    const title = event.title ? event.title.toLowerCase() : '';
                    if (title.includes(searchTerm)) {
                        event.setProp('display', 'auto');
                    } else {
                        event.setProp('display', 'none');
                    }
                });
            });

            function updateAppointmentTime(appointmentId, newStart) {
                fetch(`/appointments/${appointmentId}`, { // Assuming your update route
                    method: 'PATCH', // Or PUT, match your route
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        date: newStart.split('T')[0],
                        time: newStart.split('T')[1].substring(0, 8)
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Appointment time updated:', data);
                        // Optionally, re-render the calendar or provide feedback
                    } else {
                        console.error('Error updating appointment time:', data);
                        info.revert(); // Revert the drag if the update fails
                    }
                })
                .catch(error => {
                    console.error('Error sending update request:', error);
                    info.revert(); // Revert the drag on network error
                });
            }
        });
    </script>
@endpush