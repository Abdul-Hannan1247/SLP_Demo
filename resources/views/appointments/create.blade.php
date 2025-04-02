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
                                    <label for="patient_id" class="form-label">{{ __('Patient') }} <span class="text-danger">*</span></label>
                                    <select id="patient_id" class="form-select @error('patient_id') is-invalid @enderror" name="patient_id" required>
                                        <option value="">{{ __('Select Patient') }}</option>
                                        @foreach ($patients as $patient)
                                            <option value="{{ $patient->id }}"
                                                    data-image="{{ asset('storage/' . $patient->picture) }}"
                                                    data-name="{{ $patient->name }}" data-phone="{{ $patient->phone }}"
                                                    data-emergency="{{ $patient->emergency_contact }}">
                                                {{ $patient->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('patient_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Patient Image & Details</label>
                                    <div class="d-flex align-items-start">
                                        <img id="patientImage" src="" alt="Patient Image" class="rounded" style="max-width: 150px; margin-right: 20px;">
                                        <div id="patientDetails"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h3 class="card-title">Appointment Details</h3>
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date" id="dateInput" required>
                                    @error('date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Time <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control" name="time" id="timeInput" required>
                                    @error('time')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Notes</label>
                                    <textarea class="form-control" name="notes" rows="3"></textarea>
                                    @error('notes')
                                        <div class="text-danger">{{ $message }}</div>
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
                                        <th>Patient</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Notes</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($existingAppointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                                            <td>{{ $appointment->date }}</td>
                                            <td>{{ $appointment->time }}</td>
                                            <td>{{ $appointment->notes }}</td>
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
        // Patient Selection & Details
        document.getElementById('patient_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var imageSrc = selectedOption.getAttribute('data-image');
            var patientImage = document.getElementById('patientImage');
            var patientDetails = document.getElementById('patientDetails');

            if (imageSrc) {
                patientImage.src = imageSrc;
            } else {
                patientImage.src = '';
            }

            var patientName = selectedOption.getAttribute('data-name');
            var patientPhone = selectedOption.getAttribute('data-phone');
            var patientEmergency = selectedOption.getAttribute('data-emergency');

            var detailsHtml = `
                <p><strong>Name:</strong> ${patientName}</p>
                <p><strong>Phone:</strong> ${patientPhone}</p>
                <p><strong>Emergency:</strong> ${patientEmergency}</p>
            `;

            patientDetails.innerHTML = detailsHtml;
        });

        // Date and Time Pickers
        document.getElementById('dateInput').addEventListener('click', function() {
            this.showPicker();
        });
        document.getElementById('timeInput').addEventListener('click', function() {
            this.showPicker();
        });
    </script>
@endsection

