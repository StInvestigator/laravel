<?php
$surname = "Мурашко";
$name = "Владислав";
$age = 17;
$university = "Львівська Політехніка";
?>

@extends('layouts.my-layout')

@section('title','Info details')

@section('content')
    <div class="text-center">
        <h1>Мене звати <span>{{$surname}} {{$name}}</span></h1>
        <h2>Мені {{$age}} років</h2>
        <h2>Нещодавно я закінчив школу</h2>
        <h2>Та тепер став студентом університету {{$university}}</h2>
        <h2>Де буду набувати вищу освіту з програми "системи та методи штучного інтелекту"</h2>
        <h2>У вільний час граю у відеоігри, дивлюся аніме, відвідую спортивний зал</h2>
        <img src="https://i.pinimg.com/originals/40/71/d6/4071d667fae30cd0e003c165f9dc757e.png" style="width:400px; margin:0 auto"
            alt="gigachad image (me)" />
    </div>
@endsection