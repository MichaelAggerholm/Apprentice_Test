@extends('layouts.admin')
@section('title', 'Bøger')
@section('content')

    <h1 class="page-title">Bøger</h1>
    <p>Her defineres bøger.</p>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <h5>Tilføj ny bog</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adminpanel.book.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="condition_id">Tilstand</label>
                                <select name="condition_id" id="condition_id"
                                        class="form-control @error('condition_id') is_invalid @enderror">
                                    <option value="">-- Vælg tilstand --</option>
                                    @foreach($conditions as $condition)
                                        <option
                                            value="{{$condition->id}}" {{old('condition_id') == $condition->id ? 'selected' : ''}}>
                                            {{$condition->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('condition_id')
                                <span class="invalid-feedback">
                                            <strong>{{$message}}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="format_id">Format</label>
                                <select name="format_id" id="format_id"
                                        class="form-control @error('format_id') is_invalid @enderror">
                                    <option value="">-- Vælg format --</option>
                                    @foreach($formats as $format)
                                        <option
                                            value="{{$format->id}}" {{old('format_id') == $format->id ? 'selected' : ''}}>
                                            {{$format->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('format_id')
                                <span class="invalid-feedback">
                                            <strong>{{$message}}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="publisher_id">Udgiver</label>
                                <select name="publisher_id" id="publisher_id"
                                        class="form-control @error('publisher_id') is_invalid @enderror">
                                    <option value="">-- Vælg udgiver --</option>
                                    @foreach($publishers as $publisher)
                                        <option
                                            value="{{$publisher->id}}" {{old('publisher_id') == $publisher->id ? 'selected' : ''}}>
                                            {{$publisher->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('publisher_id')
                                <span class="invalid-feedback">
                                            <strong>{{$message}}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="language_id">Sprog</label>
                                <select name="language_id" id="language_id"
                                        class="form-control @error('language_id') is_invalid @enderror">
                                    <option value="">-- Vælg sprog --</option>
                                    @foreach($languages as $language)
                                        <option
                                            value="{{$language->id}}" {{old('language_id') == $language->id ? 'selected' : ''}}>
                                            {{$language->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('language_id')
                                <span class="invalid-feedback">
                                            <strong>{{$message}}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="genres">Genrer</label>
                                <select name="genres[]" id="genres"
                                        multiple
                                        class="form-control @error('genres') is-invalid @enderror">
                                    @foreach($genres as $genre)
                                        <option
                                            value="{{$genre->id}}" {{in_array($genre->id, old('genres', [])) ? 'selected' : ''}}>
                                            {{$genre->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('genres')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="authors">Forfattere</label>
                                <select name="authors[]" id="authors"
                                        multiple
                                        class="form-control @error('authors') is-invalid @enderror">
                                    @foreach($authors as $author)
                                        <option
                                            value="{{$author->id}}" {{in_array($author->id, old('authors', [])) ? 'selected' : ''}}>
                                            {{$author->author_name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('authors')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="title">Titel</label>
                                <input type="text" name="title" id="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{old('title')}}"/>
                                @error('title')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="isbn">ISBN</label>
                                <input type="text" name="isbn" id="isbn"
                                       class="form-control @error('isbn') is-invalid @enderror"
                                       value="{{old('isbn')}}"/>
                                @error('isbn')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="publish_date">Udgivelsesdato</label>
                                <input type="date" name="publish_date" id="publish_date"
                                       class="form-control @error('publish_date') is-invalid @enderror"
                                       value="{{old('publish_date')}}"/>
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
                                       value="{{old('page_count')}}"/>
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
                                       value="{{old('stock')}}"/>
                                @error('stock')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Pris</label>
                                <input type="number" name="price" id="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{old('price')}}"/>
                                @error('price')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="image">Billede</label>
                                <input type="file" name="image" id="image"
                                       class="form-control @error('image') is-invalid @enderror"/>
                                @error('image')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="summary">Resumé</label>
                                <textarea name="summary" id="summary" class="form-control @error('summary') is-invalid @enderror"></textarea>
                                @error('summary')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group text-end">
                                <button type="submit" class="btn btn-primary">Opret</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Eksisterende bøger</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Titel</th>
                                <th>ISBN</th>
                                <th>Lagerantal</th>
                                <th>Pris</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{$book->id}}</td>
                                    <td>{{$book->title}}</td>
                                    <td>{{$book->isbn}}</td>
                                    <td>{{$book->stock}}</td>
                                    <td>{{$book->price}}</td>
                                    <td style="display: flex;">
                                        <a href="{{route('adminpanel.book.edit', $book->id)}}"
                                           class="btn btn-primary"
                                           role="button"
                                           style="padding:5px 10px;margin-right:5px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                            </svg>
                                        </a>
                                        <form action="{{route('adminpanel.book.destroy', $book->id)}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="padding:5px 10px;"
                                                    onclick="return confirm('Er du sikker på, at du vil slette?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if(!$deleted_books->isEmpty())
            <br>
            <hr>
            <br>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Slettede forfatterer</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Titel</th>
                                    <th>ISBN</th>
                                    <th>Lagerantal</th>
                                    <th>Pris</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($deleted_books as $deleted_book)
                                    <tr>
                                        <td>{{$deleted_book->id}}</td>
                                        <td>{{$deleted_book->title}}</td>
                                        <td>{{$deleted_book->isbn}}</td>
                                        <td>{{$deleted_book->stock}}</td>
                                        <td>{{$deleted_book->price}}</td>
                                        <td>
                                            <form action="{{route('adminpanel.book.restore', $deleted_book->id)}}"
                                                  method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success"
                                                        onclick="return confirm('Er du sikker på, at du vil gendanne?')">
                                                    Gendan
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
