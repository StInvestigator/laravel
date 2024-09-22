@extends('layouts.my-layout')

@section('title', 'Info create')

@section('content')
<h2 class="display-3">Create the Info</h2>
<form method="post" action="{{ route('info.store') }}">
    @csrf
    <div class="mb-3 fs-3">
        <label for="first_name " class="form-label">First name</label>
        <input name="first_name" value="{{ old('first_name') }}" class="@error('first_name')
        is-invalid @enderror form-control my-2 fs-4">
        @error('first_name')
            <div class="alert alert-danger p-2">{{ $message }}</div>
        @enderror

        <label for="last_name" class="form-label">Last name</label>
        <input name="last_name" value="{{ old('last_name') }}" class="@error('last_name') is-invalid
        @enderror form-control fs-4 my-2">
        @error('last_name')
            <div class="alert alert-danger p-2">{{ $message }}</div>
        @enderror

        <div class="my-2">
            <input type="hidden" name="is_active" value="0" />
            <input type="checkbox" id="is_active" value="1" name="is_active" {{old('is_active') ? 'checked' : ''}}
                class="form-check-input">
            <label for="is_active">Is Active</label>
        </div>
        
        <label for="birthday" class="form-label">Birthday date</label>
        <input name="birthday" type="date" value="{{ old('birthday') }}" class="@error('birthday')
        is-invalid @enderror form-control fs-4 my-2">
        @error('birthday')
            <div class="alert alert-danger p-2">{{ $message }}</div>
        @enderror

    </div>
    <button type="submit" class="btn btn-outline-success my-3 fs-3">Submit</button>
</form>
@endsection