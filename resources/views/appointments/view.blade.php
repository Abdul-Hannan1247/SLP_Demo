@extends('admin.layouts.master')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg rounded-lg">
                    <div class="card-header bg-primary text-white py-3">
                        <h3 class="mb-0">Appointment Details</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="patient_name" class="form-label fw-bold">Patient Name:</label>
                            <p class="form-control-plaintext">{{ $appointment->patient_name }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label fw-bold">Date:</label>
                            <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label fw-bold">Time:</label>
                            <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="appointment_notes" class="form-label fw-bold">Notes:</label>
                            <p class="form-control-plaintext">{{ $appointment->appointment_notes ?? 'No notes provided.' }}</p>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-primary">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this appointment?')">
                                    <i class="bi bi-trash me-1"></i> Delete
                                </button>
                            </form>
                            <a href="{{ route('appointments.calendar') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('styles')
    {{-- You might already have Bootstrap CSS included in your master layout --}}
    {{-- If not, you can include it via CDN here: --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.min.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
@endsection

@section('scripts')
    {{-- You might already have Bootstrap JS included in your master layout --}}
    {{-- If not, you can include it via CDN here: --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhG5lZNrrK/JUMPknSAiGgVAej/hRgg" crossorigin="anonymous"></script>
@endsection