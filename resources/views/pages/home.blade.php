@extends('layouts.master')
@section('name', 'Home Page')
@section('content')
    <main class="homepage">

        @include('pages.components.home.header')

        <section class="books-section">
            <div class="container">
                <h1 class="section-title">Fremhævede bøger</h1>
                <div class="books-row">

                    @foreach($books as $book)
                        <x-book-box :book="$book" />
                    @endforeach

                </div>
            </div>
        </section>

    </main>
@endsection
