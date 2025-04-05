@extends('admin.layouts.master')

{{--- Working page --}}

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Create Appointment</h2>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('appointments.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <h3 class="card-title">Patient Information</h3>
                                <hr>
                                <div class="mb-3">
                                    <label for="patient_name" class="form-label">{{ __('Patient Name') }} <span class="text-danger">*</span></label>
                                    <input type="text" id="patient_name" class="form-control @error('patient_name') is-invalid @enderror" name="patient_name" value="{{ old('patient_name') }}" required>
                                    @error('patient_name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <h3 class="card-title">Appointment Details</h3>
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="dateInput" value="{{ old('date') }}" required>
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Time <span class="text-danger">*</span></label>
                                    <select class="form-select @error('time') is-invalid @enderror" name="time" id="timeInput" required>
                                        <option value="">Select Time</option>
                                    </select>
                                    @error('time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Notes</label>
                                    <textarea class="form-control @error('appointment_notes') is-invalid @enderror" name="notes" rows="3">{{ old('appointment_notes') ?? $appointment->appointment_notes ?? '' }}</textarea>

                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary">Create Appointment</button>
                                <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Existing Appointments</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>#</th> <th>Patient</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Notes</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($existingAppointments as $index => $appointment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td> <td>{{ $appointment->patient_name }}</td>
                                            <td>{{ $appointment->date }}</td>
                                            <td>{{ $appointment->time }}</td>
                                            <td>{{ $appointment->appointment_notes }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-primary me-2">Edit</a>
                                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const timeInput = document.getElementById('timeInput');

            function generateTimeOptions() {
                timeInput.innerHTML = '<option value="">Select Time</option>'; // Clear existing options
                const startTime = new Date();
                startTime.setHours(7, 0, 0, 0); // Start at 7:00 AM

                const endTime = new Date();
                endTime.setHours(22, 45, 0, 0); // End at 10:45 PM (one interval before 11 PM)

                let currentTime = new Date(startTime);

                while (currentTime <= endTime) {
                    let hours = currentTime.getHours();
                    const minutes = currentTime.getMinutes().toString().padStart(2, '0');
                    const ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; // the hour '0' should be '12'
                    const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes} ${ampm}`;
                    const timeValue = `${currentTime.getHours().toString().padStart(2, '0')}:${minutes}`; // Store in 24-hour format

                    const option = document.createElement('option');
                    option.value = timeValue; // Store 24-hour format
                    option.textContent = formattedTime; // Display 12-hour format
                    timeInput.appendChild(option);

                    currentTime.setTime(currentTime.getTime() + 15 * 60 * 1000); // Add 15 minutes
                }
            }

            generateTimeOptions();

            // Optional: If you want to retain the selected time after a validation error
            const oldTime = "{{ old('time') }}";
            if (oldTime) {
                timeInput.value = oldTime;
            }
        });
    </script>
@endsection