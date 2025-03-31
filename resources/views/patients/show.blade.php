@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Patient Details</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <strong class="text-muted">Name:</strong>
                        <p class="mb-0">{{ $patient->name }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="text-muted">Email:</strong>
                        <p class="mb-0">{{ $patient->email }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="text-muted">Gender:</strong>
                        <p class="mb-0">{{ $patient->gender }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="text-muted">Date of Birth:</strong>
                        <p class="mb-0">{{ $patient->date_of_birth }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <strong class="text-muted">Phone:</strong>
                        <p class="mb-0">{{ $patient->phone }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="text-muted">Emergency Contact:</strong>
                        <p class="mb-0">{{ $patient->emergency_contact }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="text-muted">Address:</strong>
                        <p class="mb-0">{{ $patient->address }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="text-muted">Referral:</strong>
                        <p class="mb-0">{{ $patient->referral }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Back to Patients</a>
        </div>
    </div>
</div>
@endsection