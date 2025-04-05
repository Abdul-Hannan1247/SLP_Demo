@extends('admin.layouts.master')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Edit Appointment</h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                            @csrf
                            @method('PUT') {{-- Use PUT method for updates --}}

                            <div class="mb-3">
                                <label class="form-label">Patient</label>
                                <select class="form-select @error('patient_id') is-invalid @enderror" name="patient_id">
                                    <option value="">Select Patient</option>
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}" {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}>
                                            {{ $patient->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('patient_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                                       value="{{ old('date', $appointment->date ? $appointment->date->format('Y-m-d') : '') }}">
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control @error('time') is-invalid @enderror" name="time"
                                       value="{{ old('time', $appointment->time ? $appointment->time->format('H:i') : '') }}">
                                @error('time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" rows="3">{{ old('notes', $appointment->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection