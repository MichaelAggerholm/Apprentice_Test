@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <h1 class="page-title">Dashboard</h1>
    <p>Antal bøger: {{$bookCount}}</p>
    <p>Antal forfattere: {{$authorCount}}</p>
    <p>Antal brugere: {{$userCount}}</p>
    <p>Antal tilstande: {{$conditionCount}}</p>
    <p>Antal formater: {{$formatCount}}</p>
    <p>Antal genrer: {{$genreCount}}</p>
    <p>Antal sprog: {{$languageCount}}</p>
    <p>Antal udgivere: {{$publisherCount}}</p>
    <br>
    <p>Ellers intet at vise..</p>
@endsection
