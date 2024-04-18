@extends('layouts.master')
@section('title', 'Success')
@section('content')

    <header class="page-header">
        <h1>Ordren er betalt!</h1>
    </header>

    <section class="page-success">
        <div class="container">
            <h2>Din ordre er er nu betalt, i den virkelige verden ville du sikkert modtage en ordrebekræftigelse!</h2>
            <h3>Dit ordre id er: {{$order->id}}</h3>
        </div>
    </section>

@endsection
