@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>Appointments</h2>

                @if (session('success'))
                    <div id="success-notification" class="alert alert-success alert-dismissible fade show d-flex align-items-center position-fixed top-2 end-0 m-3" role="alert"
                         style="top: 60px; z-index: 1050; background-color: #d4edda;">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                            <table class="table table-striped table-hover table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th class="fs-4">#</th>
                                        <th class="fs-4">Patient Name</th>
                                        <th class="fs-4">Date</th>
                                        <th class="fs-4">Time</th>
                                        <th class="fs-4">Notes</th>
                                        <th class="fs-4">Actions</th>
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
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-primary me-2">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $appointment->id }}">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>

                                                    <div class="modal fade" id="deleteModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $appointment->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger text-white">
                                                                    <h5 class="modal-title" id="deleteModalLabel{{ $appointment->id }}">Confirm Delete</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete the appointment for <strong>{{ $appointment->patient_name }}</strong> on {{ $appointment->date }} at {{ $appointment->time }}?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">
                                                                            <i class="bi bi-trash"></i> Delete
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
    </script>
@endpush