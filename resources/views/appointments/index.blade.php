@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>Appointments</h2>

                @if (session('success'))
                    <div id="success-notification" class="alert alert-success d-flex align-items-center position-fixed top-2 end-0 m-3" role="alert"
                         style="top: 60px; z-index: 1050; background-color: #d4edda;">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Add Appointment
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Notes</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($appointments as $appointment)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $appointment->patient_name }}</td>
                                            <td>{{ $appointment->date }}</td>
                                            <td>{{ $appointment->time }}</td>
                                            <td>{{ $appointment->appointment_notes }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-primary me-2">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('success-notification');
            if (notification) {
                // Remove Bootstrap's fade classes to avoid conflicts
                notification.classList.remove('fade', 'show');

                // Set initial opacity and transition
                notification.style.opacity = 0;
                notification.style.transition = 'opacity 1s ease-in-out';

                // Fade in
                setTimeout(function() {
                    notification.style.opacity = 1;
                }, 100);

                // Fade out after 3 seconds
                setTimeout(function() {
                    notification.style.opacity = 0;
                    // Remove after transition
                    setTimeout(function() {
                        notification.remove();
                    }, 1000);
                }, 3000);
            }
        });
        // this is demo
        // this is demo
    </script>
@endpush


