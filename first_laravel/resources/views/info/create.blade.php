@extends('layouts.my-layout')

@section('title', 'Info create')

@section('content')
<h2 class="display-3">Create the Info</h2>
<form method="post" action="{{ route('info.store') }}">
    @csrf
    <div class="mb-3 fs-3">
        @include("info._form_fields")
    </div>
    <button type="submit" class="btn btn-outline-success my-3 fs-3">Submit</button>
</form>
@endsection