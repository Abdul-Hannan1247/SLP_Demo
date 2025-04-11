@extends('admin.layouts.master')

{{--- Working page --}}

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none mb-3 bg-primary text-white rounded">
            <div class="row align-items-center ">
                <div class="col">
                    <br>
                    <h2 class="page-title bg-primary text-white py-2 px-3"> Edit Appointment</h2>
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
                        <h3 class="card-title">Edit Appointment</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="patient_name" class="form-label">{{ __('Patient Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" id="patient_name" class="form-control @error('patient_name') is-invalid @enderror" name="patient_name" placeholder="{{ __('Enter patient\'s name') }}" value="{{ old('patient_name', $appointment->patient_name) }}" required>
                                        @error('patient_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="dateInput" value="{{ old('date', $appointment->date) }}" required>
                                        @error('date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Time <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control @error('time') is-invalid @enderror" name="time" id="timeInput" value="{{ old('time', \Carbon\Carbon::parse($appointment->time)->format('H:i')) }}" required>
                                        @error('time')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Notes</label>
                                        <textarea class="form-control @error('appointment_notes') is-invalid @enderror" name="appointment_notes" rows="4">{{ old('appointment_notes', $appointment->appointment_notes) }}</textarea>
                                        @error('appointment_notes')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i> Update Appointment</button>
                                <a href="{{ route('appointments.index') }}" class="btn btn-secondary ms-2"><i class="bi bi-x-circle me-2"></i> Cancel</a>
                                <button type="button" class="btn btn-danger ms-auto" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bi bi-trash me-2"></i> Delete Appointment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
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