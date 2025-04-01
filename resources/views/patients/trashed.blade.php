@extends('admin.layouts.master')

@section('content')
<h1> Trash folder</h1>
    {{-- <div class="container">
        <br><br>
        <h1>Trashed Patients</h1>

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
                @foreach ($trashedPatients as $patient)
                    <tr>
                        <td><b>{{ $loop->iteration }}</b></td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                @if ($patient->picture)
                                    <img src="{{ asset('storage/' . $patient->picture) }}" alt="Patient Picture" class="rounded mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('storage/avatar.png') }}" alt="Default Avatar" class="rounded mr-2" style="width: 40px; height: 40px; object-fit: cover;">
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
                            <form action="{{ route('patients.restore', $patient->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-success" title="Restore">
                                    <i class="bi bi-arrow-clockwise"></i> Restore
                                </button>
                            </form>
                            <form action="{{ route('patients.forceDelete', $patient->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Force Delete" onclick="return confirm('Are you sure you want to permanently delete this patient?')">
                                    <i class="bi bi-trash"></i> Force Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> --}}
@endsection