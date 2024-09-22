@extends('layouts.my-layout')

@section('title', 'Info edit')

@section('content')
<h2 class="display-3">Edit the Info</h2>
<form method="post" action="{{ route('info.update') }}">
    @csrf
    <div class="mb-3 fs-3">
        <input type="hidden" name="id" value="{{$model->id}}">
        <label for="first_name " class="form-label">First name</label>
        <input name="first_name" class="form-control my-2 fs-4 @error('first_name')
        is-invalid @enderror" value="{{ old('first_name') ?? $model->first_name }}">
        @error('first_name')
            <div class="alert alert-danger p-2">{{ $message }}</div>
        @enderror

        <label for="last_name" class="form-label">Last name</label>
        <input name="last_name" class="form-control fs-4 my-2 @error('last_name') is-invalid
        @enderror" value="{{ old(key: 'last_name') ?? $model->last_name }}">
        @error('last_name')
            <div class="alert alert-danger p-2">{{ $message }}</div>
        @enderror

        <div class="my-2">
            <input type="hidden" name="is_active" value="0" />
            <input class="form-check-input" type="checkbox" id="is_active" value="1" name="is_active"
                {{ old(key: 'is_active') ?? $model->is_active ? 'checked' : ''}}>Is Active</label>
        </div>

        <label for="birthday" class="form-label">Birthday date</label>
        <input name="birthday" class="form-control fs-4 my-2 @error('birthday')
        is-invalid @enderror" type="date" value="{{ old(key: 'birthday') ?? $model->birthday }}">
        @error('birthday')
            <div class="alert alert-danger p-2">{{ $message }}</div>
        @enderror
        
    </div>
    <button type="submit" class="btn btn-outline-success my-3 fs-3">Submit</button>
</form>
@endsection