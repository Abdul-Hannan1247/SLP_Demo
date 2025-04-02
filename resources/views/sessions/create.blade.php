@extends('admin.layouts.master')

@section('content')
    <h1>Create New Session</h1>

    <form action="{{ route('sessions.store') }}" method="POST">
        @csrf
        <button type="submit">Create Session</button>
    </form>
@endsection