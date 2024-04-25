@extends('layouts.admin')
@section('title', 'Rediger Bog')
@section('content')

    <h1 class="page-title">Rediger Bog</h1>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <h5>Rediger Bog</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adminpanel.book.update', $book->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="condition_id">Tilstand</label>
                                <select name="condition_id" id="condition_id" class="form-control @error('condition_id') is_invalid @enderror">
                                    <option value="">-- Vælg tilstand --</option>
                                    @foreach($conditions as $condition)
                                        <option value="{{ $condition->id }}"
                                            {{ old('condition_id', $book->condition_id) == $condition->id ? 'selected' : '' }}>
                                            {{ $condition->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('condition_id')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="format_id">Format</label>
                                <select name="format_id" id="format_id" class="form-control @error('format_id') is_invalid @enderror">
                                    <option value="">-- Vælg format --</option>
                                    @foreach($formats as $format)
                                        <option value="{{ $format->id }}"
                                            {{ old('format_id', $book->format_id) == $format->id ? 'selected' : '' }}>
                                            {{ $format->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('format_id')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="publisher_id">Udgiver</label>
                                <select name="publisher_id" id="publisher_id" class="form-control @error('publisher_id') is_invalid @enderror">
                                    <option value="">-- Vælg udgiver --</option>
                                    @foreach($publishers as $publisher)
                                        <option value="{{ $publisher->id }}"
                                            {{ old('publisher_id', $book->publisher_id) == $publisher->id ? 'selected' : '' }}>
                                            {{ $publisher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('publisher_id')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="language_id">Sprog</label>
                                <select name="language_id" id="language_id" class="form-control @error('language_id') is_invalid @enderror">
                                    <option value="">-- Vælg sprog --</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}"
                                            {{ old('language_id', $book->language_id) == $language->id ? 'selected' : '' }}>
                                            {{ $language->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('language_id')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="genres">Genrer</label>
                                <select name="genres[]" id="genres" multiple class="form-control @error('genres') is-invalid @enderror">
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre->id }}"
                                            {{ in_array($genre->id, old('genres', $book->genres->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $genre->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('genres')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="authors">Forfattere</label>
                                <select name="authors[]" id="authors" multiple class="form-control @error('authors') is-invalid @enderror">
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}"
                                            {{ in_array($author->id, old('authors', $book->authors->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $author->author_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('authors')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="title">Titel</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title', $book->title) }}"/>
                                @error('title')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="isbn">ISBN</label>
                                <input type="text" name="isbn" id="isbn" class="form-control @error('isbn') is-invalid @enderror"
                                       value="{{ old('isbn', $book->isbn) }}"/>
                                @error('isbn')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="publish_date">Udgivelsesdato</label>
                                <input type="date" name="publish_date" id="publish_date"
                                       class="form-control @error('publish_date') is-invalid @enderror"
                                       value="{{old('publish_date', $book->publish_date)}}"/>
                                @error('publish_date')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="page_count">Sidetal</label>
                                <input type="number" name="page_count" id="page_count"
                                       class="form-control @error('page_count') is-invalid @enderror"
                                       value="{{old('page_count', $book->page_count)}}"/>
                                @error('page_count')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="stock">Lagerantal</label>
                                <input type="number" name="stock" id="stock"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       value="{{ old('stock', $book->stock) }}"/>
                                @error('stock')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Pris</label>
                                <input type="number" name="price" id="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price', $book->price) }}"/>
                                @error('price')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="image">Billede</label>
                                @if($book->image)
                                    <div>
                                        <img src="{{ asset('storage/' . $book->image) }}" width="100" height="100" alt="Bog Billede">
                                        <p>Nuværende billede</p>
                                    </div>
                                @endif
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror"/>
                                @error('image')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="summary">Resumé</label>
                                <textarea name="summary" id="summary" class="form-control @error('summary') is-invalid @enderror">{{ old('summary', $book->summary) }}</textarea>
                                @error('summary')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group text-end">
                                <button type="submit" class="btn btn-primary">Gem redigering</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
