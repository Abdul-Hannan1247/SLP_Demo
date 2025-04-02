@extends('admin.layouts.master')

@section('content')
    <h1>Sessions</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($sessions->isEmpty())
        <p>No sessions found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sessions as $session)
                    <tr>
                        <td>{{ $session->id }}</td>
                        <td>{{ $session->patient_id }}</td>
                        <td>{{ $session->date }}</td>
                        <td>{{ $session->time }}</td>
                        <td>
                            <a href="{{ route('sessions.edit', $session->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('sessions.destroy', $session->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection