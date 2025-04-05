@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <br>
        <br>
        <h1>Appointments</h1>
        @if (session('success'))
            <div id="success-notification" class="alert alert-success d-flex align-items-center position-fixed top-2 end-0 m-3" role="alert"
                 style="top: 60px; z-index: 1050; background-color: #d4edda;">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill"/>
                </svg>
                <div>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-3">Create Appointment</a>
        <br>
        <br>
        @if ($appointments->isEmpty())
            <p>No appointments found.</p>
        @else
            <table class="table table-striped table-hover table-bordered text-center">
                <thead>
                <tr >
                    <th class="fs-4">#</th>
                    <th class="fs-4">Patient Name</th>
                    <th class="fs-4">Date</th>
                    <th class="fs-4">Time</th>
                    <th class="fs-4">Notes</th>
                    <th class="fs-4">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $appointment->patient_name }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>{{ $appointment->appointment_notes }}</td>
                        <td>
                            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-sm btn-primary">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteConfirmationModal{{ $appointment->id }}">
                                Delete
                            </button>

                            <div class="modal fade" id="deleteConfirmationModal{{ $appointment->id }}" tabindex="-1"
                                 aria-labelledby="deleteConfirmationModalLabel{{ $appointment->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title"
                                                id="deleteConfirmationModalLabel{{ $appointment->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the appointment for
                                            <strong>{{ $appointment->patient_name }}</strong> on
                                            <strong>{{ $appointment->date }}</strong> at
                                            <strong>{{ $appointment->time }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel
                                            </button>
                                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $appointments->links() }}
        @endif
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#success-notification').fadeOut('slow');
            }, 3000); // 3000 milliseconds = 3 seconds
        });
    </script>
@endpush