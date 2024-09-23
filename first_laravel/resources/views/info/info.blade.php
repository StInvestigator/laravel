@extends('layouts.my-layout')

@section('title','Info details')

@section('content')
<h2>Full information: </h2>
<table class="table table-dark table-striped">
   <tbody>
   <tr>
    <td>Avatar</td>
    <th style="padding:2px"><img style="width:50px; height:50px; border-radius:100%; margin:3px 0 0 15px;" src="{{$model->image?$model->image->src:Storage::disk("infos")->url('guest.jpg')}}" /></th>
   </tr>
    <tr>
        <td>First Name</td>
        <th>{{$model->first_name}} </th>
    </tr>
    <tr>
        <td>Last Name</td>
        <th>{{$model->last_name}}</th>
    </tr>
    <tr>
        <td>Is Active</td>
        <th>{{$model->is_active}}</th>
    </tr>
    <tr>
        <td>Birthday</td>
        <th>{{$model->birthday}}</th>
    </tr>
   </tbody>
  </table>
@endsection