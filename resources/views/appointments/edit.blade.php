@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <h1>Edit Appointment</h1>

        <form action="{{ route('appointments.update', $appointment) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="patient_name" class="form-label">Patient Name</label>
                <input type="text" class="form-control @error('patient_name') is-invalid @enderror" id="patient_name" name="patient_name" value="{{ old('patient_name', $appointment->patient_name) }}" required>
                @error('patient_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $appointment->date) }}" required>
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">Time (HH:MM)</label>
                <input type="time" class="form-control @error('time') is-invalid @enderror" id="time" name="time" value="{{ old('time', \Carbon\Carbon::parse($appointment->time)->format('H:i')) }}" required>
                @error('time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="appointment_notes" class="form-label">Notes</label>
                <textarea class="form-control @error('appointment_notes') is-invalid @enderror" id="appointment_notes" name="appointment_notes">{{ old('appointment_notes', $appointment->appointment_notes) }}</textarea>
                @error('appointment_notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Appointment</button>
            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection