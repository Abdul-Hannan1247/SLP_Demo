@extends('admin.layouts.master')

@section('content')
<br><br><br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h1 class="mb-0">{{ __('Edit Patient') }}</h1>
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary btn-sm">{{ __('Back') }}</a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('patients.update', $patient->id) }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $patient->name) }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $patient->email) }}" autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="gender" class="form-label">{{ __('Gender') }} <span class="text-danger">*</span></label>
                                        <select id="gender" class="form-select @error('gender') is-invalid @enderror" name="gender" required>
                                            <option value="">{{ __('Select Gender') }}</option>
                                            <option value="male" {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                            <option value="female" {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                            <option value="other" {{ old('gender', $patient->gender) == 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="date_of_birth" class="form-label">{{ __('Date of Birth') }}</label>
                                        <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth) }}">
                                        @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                        <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $patient->phone) }}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="emergency_contact" class="form-label">{{ __('Emergency Contact') }} <span class="text-danger">*</span></label>
                                        <input id="emergency_contact" type="tel" class="form-control @error('emergency_contact') is-invalid @enderror" name="emergency_contact" value="{{ old('emergency_contact', $patient->emergency_contact) }}">
                                        @error('emergency_contact')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">{{ __('Address') }}</label>
                                        <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address', $patient->address) }}</textarea>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="referral" class="form-label">{{ __('Referral') }}</label>
                                        <input id="referral" type="text" class="form-control @error('referral') is-invalid @enderror" name="referral" value="{{ old('referral', $patient->referral) }}">
                                        @error('referral')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="diagnose" class="form-label">{{ __('Diagnose') }}</label>
                                <textarea id="diagnose" class="form-control @error('diagnose') is-invalid @enderror" name="diagnose">{{ old('diagnose', $patient->diagnose) }}</textarea>
                                @error('diagnose')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="picture" class="form-label">{{ __('Profile Picture') }}</label>
                                <input id="picture" type="file" class="form-control @error('picture') is-invalid @enderror" name="picture">
                                @error('picture')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Patient') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection