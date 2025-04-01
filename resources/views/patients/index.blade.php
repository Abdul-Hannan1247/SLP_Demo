@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <br><br>
        <h1>All Patients</h1>
        <a href="{{ route('patients.create') }}" class="btn btn-primary mb-3 text">Create New Patient</a>

        <table class="table table-striped table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th style="font-size: 12px;">#</th>
                    <th style="font-size: 12px;">Name</th>
                    <th style="font-size: 12px;">Email</th>
                    <th style="font-size: 12px;">Gender</th>
                    <th style="font-size: 12px;">Date of Birth</th>
                    <th style="font-size: 12px;">Phone</th>
                    <th style="font-size: 12px;">Emergency Contact</th>
                    <th style="font-size: 12px;">Address</th>
                    <th style="font-size: 12px;">Referral</th>
                    <th style="font-size: 12px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                    <tr>
                        <td><b>{{ $loop->iteration }}</b></td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                @if ($patient->picture)
                                    <img src="{{ asset('storage/' . $patient->picture) }}" alt="Patient Picture" class="rounded mr-2" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('storage/avatar.png') }}" alt="Default Avatar" class="rounded mr-2" style="width: 60px; height: 60px; object-fit: cover;">
                                @endif
                                {{ $patient->name }}
                            </div>
                        </td>
                        <td>{{ $patient->email ? $patient->email : '-' }}</td>
                        <td>{{ $patient->gender }}</td>
                        <td>{{ $patient->date_of_birth }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->emergency_contact }}</td>
                        <td>{{ $patient->address }}</td>
                        <td>{{ $patient->referral ? $patient->referral : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('patients.show', $patient->id) }}" title="View"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('patients.edit', $patient->id) }}" title="Edit"><i class="bi bi-pencil"></i></a>
                            <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $patient->id }}" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>

                            <div class="modal fade" id="deleteModal{{ $patient->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $patient->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $patient->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete patient: <b>{{ $patient->name }}</b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display: inline;">
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
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection