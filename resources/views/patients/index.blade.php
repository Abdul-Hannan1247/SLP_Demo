@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <h1>Patients</h1>
        <a href="{{ route('patients.create') }}" class="btn btn-primary mb-3">Create New Patient</a>

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
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ $patient->gender }}</td>
                        <td>{{ $patient->date_of_birth }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->emergency_contact }}</td>
                        <td>{{ $patient->address }}</td>
                        <td>{{ $patient->referral }}</td>
                        <td>
                            <a href="{{ route('patients.show', $patient->id) }}" title="View"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('patients.edit', $patient->id) }}" title="Edit"><i
                                    class="bi bi-pencil"></i></a>
                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0" title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this patient?')"><i
                                        class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
