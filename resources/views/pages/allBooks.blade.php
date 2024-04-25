@extends('layouts.master')
@section('name', 'Alle bøger')
@section('content')
    <main class="homepage">

        @include('pages.components.home.header')

        <section class="books-section">
            <div class="container">
                <h1 class="section-title">Alle bøger</h1>

                <div class="filter-section" style="display: flex;justify-content: center;margin-top: 50px;margin-bottom: 50px;">
                    <form method="GET" action="{{ route('allBooks') }}">
                        <div class="filter-group">
                            <label for="format">Format: </label>
                            @foreach($formats as $format)
                                <!-- Tager Format parameter fra url request, hvis sat, flueben er valgt, ellers ikke valgt -->
                                <input type="checkbox" id="{{ $format->id }}" name="formats[]" value="{{ $format->id }}"
                                    {{ collect(request()->input('formats'))->contains($format->id) ? 'checked' : '' }}>
                                <label for="{{ $format->id }}">{{ $format->name }}</label>
                            @endforeach
                        </div>
                        <div class="filter-group">
                            <label for="condition">Tilstand: </label>
                            @foreach($conditions as $condition)
                                <!-- Tager Condition parameter fra url request, hvis sat, flueben er valgt, ellers ikke valgt -->
                                <input type="checkbox" id="{{ $condition->id }}" name="conditions[]" value="{{ $condition->id }}"
                                    {{ collect(request()->input('conditions'))->contains($condition->id) ? 'checked' : '' }}>
                                <label for="{{ $condition->id }}">{{ $condition->name }}</label>
                            @endforeach
                        </div>
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </form>
                </div>

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
