@extends('admin.layouts.master')

@section('content')
    <h1>Edit Patient</h1>
    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $patient->name }}">
        <input type="email" name="email" value="{{ $patient->email }}">
        <button type="submit">Update</button>
    </form>
@endsection