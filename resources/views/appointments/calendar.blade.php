{{-- @extends('admin.layouts.master')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Appointments Calendar</h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Add Appointment
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div id="calendar"></div>
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($events),
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    if (info.event.url) {
                        window.location.href = info.event.url;
                    }
                },
            });
            calendar.render();
        });
    </script>
@endpush --}}


{{-- ----------------------------------------------- --}}
@extends('admin.layouts.master')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Appointments Calendar</h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Add Appointment
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="btn-group">
                <button class="btn btn-secondary active" id="monthButton">Month</button>
                <button class="btn btn-secondary" id="weekButton">Week</button>
                <button class="btn btn-secondary" id="todayButton">Today</button>
            </div>
        </div>

        <div id="calendar"></div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <style>
        .btn-group .btn.active {
            background-color: #007bff; /* Change to your desired color */
            color: white;
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
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    if (info.event.url) {
                        window.location.href = info.event.url;
                    }
                },
            });
            calendar.render();

            document.getElementById('todayButton').addEventListener('click', function() {
                calendar.today();
                setActiveButton('todayButton');
            });

            document.getElementById('weekButton').addEventListener('click', function() {
                calendar.changeView('timeGridWeek');
                setActiveButton('weekButton');
            });

            document.getElementById('monthButton').addEventListener('click', function() {
                calendar.changeView('dayGridMonth');
                setActiveButton('monthButton');
            });

            function setActiveButton(buttonId) {
                var buttons = document.querySelectorAll('.btn-group .btn');
                buttons.forEach(function(button) {
                    button.classList.remove('active');
                });
                document.getElementById(buttonId).classList.add('active');
            }
        });
    </script>
@endpush