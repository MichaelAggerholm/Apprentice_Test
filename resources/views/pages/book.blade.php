@extends('layouts.master')
@section('title', $book->title)
@section('content')

    @if(session()->has('addedToCart'))
        <section class="pop-up">
            <div class="pop-up-box">
                <div class="pop-up-title">
                    {{session()->get('addedToCart')}}
                </div>
                <div class="pop-up-actions">
                    <a href="{{route('home')}}" class="btn btn-outlined">Fortsæt indkøb</a>
                    <a href="{{route('cart')}}" class="btn btn-primary">Gå til kurv</a>
                </div>
            </div>
        </section>
    @endif

    <div class="book-page">
        <div class="container">
            <div class="book-page-row">
                <section class="book-page-image mt-3">
                    <img src="{{asset('storage/' . $book->image)}}" alt="{{$book->title . ' image'}}" style="max-width: 400px;">
                </section>
                <section class="book-page-details">
                    <p class="b-title">{{$book->title}}</p>
                    <p class="b-price">{{$book->price}} Dkk,-</p>
                    <p>Sider:
                        <span class="b-genre">{{ $book->page_count }}</span>
                    </p>
                    <p>Sprog:
                        <span class="b-genre">{{ $book->language->name }}</span>
                    </p>
                    <p>ISBN:
                        <span class="b-genre">{{ $book->isbn }}</span>
                    </p>
                    <p>forfatterer:
                        @php
                            $authorNames = [];
                            foreach($book->authors as $author) {
                                $authorNames[] = $author->author_name;
                            }
                            $authorList = implode(", ", $authorNames);
                        @endphp
                        <span class="b-genre">{{ $authorList }}</span>
                    </p>
                    <p>Format:
                        <span class="b-genre">{{ $book->format->name }}</span>
                    </p>
                    <p>Tilstand:
                        <span class="b-genre">{{ $book->condition->name }}</span>
                    </p>
                    <p>Udgiver:
                        <span class="b-genre">{{ $book->publisher->name }}</span>
                    </p>
                    <p>Udgivet:
                        <span class="b-genre">{{ $book->publish_date }}</span>
                    </p>
                    <p>Genrer:
                        @php
                            $genreNames = [];
                            foreach($book->genres as $genre) {
                                $genreNames[] = $genre->name;
                            }
                            $genresList = implode(", ", $genreNames);
                        @endphp
                        <span class="b-genre">{{ $genresList }}</span>
                    </p>
                    <p class="b-description">{{$book->summary}}</p>
                    <form action="{{Route('addToCart', $book->id)}}" method="post">
                        @csrf
                        <div class="b-form">
                            <div class="p-quantity">
                                <label for="quantity">Antal</label>
                                <input type="number" name="quantity" id="quantity" min="1" max="100" value="1" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-cart">Tilføj til kurv</button>
                    </form>
                </section>
            </div>
        </div>
    </div>

@endsection
