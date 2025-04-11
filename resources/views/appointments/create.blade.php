@extends('admin.layouts.master')

{{--- Working page --}}

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none mb-3 bg-primary text-white rounded">
            <div class="row align-items-center ">
                <div class="col">
                    <br>
                    <h2 class="page-title bg-primary text-white py-2 px-3"> Create Appointments</h2>
                    <br>
                </div>
            </div>
        </div>

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

        <div class="row row-cards mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">New Appointment</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('appointments.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="patient_name" class="form-label">{{ __('Patient Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" id="patient_name" class="form-control @error('patient_name') is-invalid @enderror" name="patient_name" placeholder="{{ __('Enter patient\'s name') }}" required>
                                        @error('patient_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="dateInput" required>
                                        @error('date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Time <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control @error('time') is-invalid @enderror" name="time" id="timeInput" required>
                                        @error('time')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Notes</label>
                                        <textarea class="form-control @error('appointment_notes') is-invalid @enderror" name="appointment_notes" rows="4"></textarea>
                                        @error('appointment_notes')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i> Create Appointment</button>
                                <a href="{{ route('appointments.index') }}" class="btn btn-secondary ms-2"><i class="bi bi-x-circle me-2"></i> Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Upcomming Appointments</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped table-hover table-bordered text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th class="w-1">#</th>
                                        <th>Patient</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Notes</th>
                                        <th class="w-1">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($earliestAppointments as $appointment)
                                        <tr>
                                            <td><span class="text-muted">{{ $i++ }}</span></td>
                                            <td>{{ $appointment->patient_name }}</td>
                                            <td><span>{{ \Carbon\Carbon::parse($appointment->date)->format('d M, Y') }}</span></td>
                                            <td><span>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</span></td>
                                            <td>{{ Str::limit($appointment->appointment_notes, 50) }}</td>
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
                                                                    Are you sure you want to delete the appointment for <strong>{{ $appointment->patient_name }}</strong> on {{ \Carbon\Carbon::parse($appointment->date)->format('d M, Y') }} at {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}?
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

@section('scripts')
    <script>
        // Date and Time Pickers (Keep these if you are using the native browser pickers)
        document.getElementById('dateInput').addEventListener('click', function() {
            this.showPicker();
        });
        document.getElementById('timeInput').addEventListener('click', function() {
            this.showPicker();
        });
    </script>
@endsection


@push('scripts')

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