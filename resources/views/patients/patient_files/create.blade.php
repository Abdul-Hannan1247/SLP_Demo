@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h1 class="mb-0">{{ __('Upload Patient File') }}</h1>
                </div>

                <div class="card-body">
                    <form method="POST"  action="{{ route('patient_files.upload') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="patient_id" class="form-label">{{ __('Patient') }} <span class="text-danger">*</span></label>
                            <select id="patient_id" class="form-select @error('patient_id') is-invalid @enderror" name="patient_id" required>
                                <option value="">{{ __('Select Patient') }}</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">{{ __('Patient File') }} <span class="text-danger">*</span></label>
                            <input type="hidden" name="uploaded_by" value="{{ Auth::id() }}">
                            <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" name="uploaded_by" required>
                            @error('file')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Upload File') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection