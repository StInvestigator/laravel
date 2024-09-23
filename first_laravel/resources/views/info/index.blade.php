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
    <form class="d-flex my-auto" method="get" action="{{route('info.index',["pag"=>0])}}" role="search">
        <input class="form-control me-2 fs-5" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success fs-5" type="submit">Search</button>
    </form>
    <a class="btn btn-outline-primary fs-5 d-flex my-auto" href="{{route('info.create')}}">Create</a>
</div>
<table class="table">
    <thead>
        <tr scope="row">
            <th scope="col">#</th>
            <th>Avatar</th>
            <th>Full name</th>
            <th>Active</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($models as $model)
            <tr scope="row">
                <th  scope="col">{{$model->id}}</th>
                <th style="padding:2px"><img style="width:50px; height:50px; border-radius:100%; margin:3px 0 0 15px;" src="{{$model->image?$model->image->src:Storage::disk("infos")->url('guest.jpg')}}" /></th>
                <th><span>{{$model->first_name . ' '}}</span>{{$model->last_name}}</th>
                <th>{{$model->is_active ? 'Yes' : 'No'}}</th>
                <th>
                    <a class="btn btn-outline-success fs-5 w-25" href="{{route('info.info', ['info' => $model])}}">Info</a>
                    <a class="btn btn-outline-warning fs-5 w-25" href="{{route('info.edit', ['info' => $model])}}">Edit</a>
                    <a class="btn btn-outline-danger fs-5 w-25"
                        href="{{route('info.delete', ['info' => $model])}}">Delete</a>
                </th>
            </tr>
        @endforeach
    </tbody>
</table>

@if($count > 5)
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link fs-4" href="{{route('info.index', ['pag' => $currentPage != 0 ? $currentPage - 1 : $currentPage])}}"
                aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        @for($i = 0; $i < ceil(num: $count / 5); $i++)
            <li class="page-item {{$i==$currentPage?'active':''}}"><a class="page-link fs-4" href="{{route('info.index', ['pag' => $i])}}">{{$i + 1}}</a></li>
        @endfor
        <li class="page-item">
            <a class="page-link fs-4"
                href="{{route('info.index', ['pag' => ceil(num: $count / 5)-1 != $currentPage ? $currentPage + 1 : $currentPage])}}"
                aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
@endif

@endsection