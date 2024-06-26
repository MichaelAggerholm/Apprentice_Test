@extends('layouts.master')
@section('name', 'Home Page')
@section('content')
    <main class="homepage">

        @include('pages.components.home.header')

        <section class="books-section">
            <div class="container">
                <h1 class="section-title">Vores nyeste bøger</h1>
                <div class="books-row">

                    @forelse($books as $book)
                        <x-book-box :book="$book" />
                    @empty
                        <p>Ingen resultater fundet.</p>
                    @endforelse

                </div>
            </div>
        </section>

    </main>
@endsection
