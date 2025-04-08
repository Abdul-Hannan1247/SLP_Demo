@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white py-3">
            <h1 class="mb-0"><i class="fas fa-user-injured mr-2"></i> Patient Details</h1>
        </div>
        <div class="card-body py-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <strong class="text-info"><i class="fas fa-signature mr-1"></i> Name:</strong>
                        <p class="mb-0 lead text-secondary">{{ $patient->name }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="text-info"><i class="fas fa-envelope mr-1"></i> Email:</strong>
                        <p class="mb-0 text-secondary">{{ $patient->email }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="text-info"><i class="fas fa-venus-mars mr-1"></i> Gender:</strong>
                        <p class="mb-0 text-secondary">{{ ucfirst($patient->gender) }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="text-info"><i class="fas fa-calendar-alt mr-1"></i> Date of Birth:</strong>
                        <p class="mb-0 text-secondary">{{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('F j, Y') : 'N/A' }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="text-info"><i class="fas fa-stethoscope mr-1"></i> Diagnose:</strong>
                        <p class="mb-0 text-secondary">{{ $patient->diagnose ?: 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <strong class="text-info"><i class="fas fa-phone mr-1"></i> Phone:</strong>
                        <p class="mb-0 text-secondary">{{ $patient->phone ?: 'N/A' }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="text-info"><i class="fas fa-user-shield mr-1"></i> Emergency Contact:</strong>
                        <p class="mb-0 text-secondary">{{ $patient->emergency_contact ?: 'N/A' }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="text-info"><i class="fas fa-map-marker-alt mr-1"></i> Address:</strong>
                        <p class="mb-0 text-secondary">{{ $patient->address ?: 'N/A' }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="text-info"><i class="fas fa-share-alt mr-1"></i> Referral:</strong>
                        <p class="mb-0 text-secondary">{{ $patient->referral ?: 'N/A' }}</p>
                    </div>
                    @if($patient->picture)
                        <div class="mb-4">
                            <strong class="text-info"><i class="fas fa-image mr-1"></i> Profile Picture:</strong>
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $patient->picture) }}" alt="Profile Picture" class="img-thumbnail rounded-circle shadow" style="max-width: 150px; height: auto;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer bg-light py-3">
            <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left mr-1"></i> Back to Patients</a>
            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-primary ml-2"><i class="fas fa-edit mr-1"></i> Edit Patient</a>
            <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#deletePatientModal">
                <i class="fas fa-trash-alt mr-1"></i> Delete Patient
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="deletePatientModal" tabindex="-1" role="dialog" aria-labelledby="deletePatientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deletePatientModalLabel"><i class="fas fa-exclamation-triangle mr-2"></i> Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete patient: <strong>{{ $patient->name }}</strong>? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"></i> Cancel</button>
                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt mr-1"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQmOXtgFhi0l6VlRZO6+rQ2PdcGGZmJHcYJuG6hkPWIlnlxlZrzc+vejP2YXjqkHtjOOud6HOO7BYlHQ+8+ii0OaeKtPTF==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .bg-gradient-primary {
        background: linear-gradient(to right, #007bff, #6610f2); /* Example gradient */
    }
    .text-info {
        color: #17a2b8 !important; /* Bootstrap info color */
    }
    .lead {
        font-size: 1.1rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endpush