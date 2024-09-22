@php
use App\Models\Info;
/**
* @var Info[] $models
*/
@endphp


@extends('layouts.my-layout')

@section('title', 'Info index')

@section('content')
<div class="d-flex justify-content-between">
    <h2 class="display-3">Infos</h2>
    <a class="btn btn-outline-primary fs-5 d-flex my-auto" href="{{route('info.create')}}">Create</a>
</div>
<table class="table">
    <thead>
        <tr scope="row">
            <th scope="col">#</th>
            <th scope="col">Full name</th>
            <th scope="col">Active</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($models as $model)
        <tr scope="row">
            <th scope="col">{{$model->id}}</th>
            <th scope="col"><span>{{$model->first_name.' '}}</span>{{$model->last_name}}</th>
            <th scope="col">{{$model->is_active?'Yes':'No'}}</th>
            <th>
                <a class="btn btn-outline-success fs-5 w-25" href="{{route('info.info',['info'=>$model])}}">Info</a>
                <a class="btn btn-outline-warning fs-5 w-25" href="{{route('info.edit',['info'=>$model])}}">Edit</a>
                <a class="btn btn-outline-danger fs-5 w-25" href="{{route('info.delete',['info'=>$model])}}">Delete</a>
            </th>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection