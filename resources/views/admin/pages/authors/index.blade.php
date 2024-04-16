@extends('layouts.admin')
@section('title', 'Forfatterer')
@section('content')

    <h1 class="page-title">Forfatterer</h1>
    <p>Her defineres bøgernes forfatterer.</p>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <h5>Tilføj ny forfatter</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adminpanel.author.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="first_name">Fornavn</label>
                                <input type="text" name="first_name" id="first_name"
                                       class="form-control @error('first_name') is-invalid @enderror"
                                       value="{{old('first_name')}}"/>
                                @error('first_name')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="middle_name">Mellemnavn</label>
                                <input type="text" name="middle_name" id="middle_name"
                                       class="form-control @error('middle_name') is-invalid @enderror"
                                       value="{{old('middle_name')}}"/>
                                @error('middle_name')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="last_name">Efternavn</label>
                                <input type="text" name="last_name" id="last_name"
                                       class="form-control @error('last_name') is-invalid @enderror"
                                       value="{{old('last_name')}}"/>
                                @error('last_name')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="author_name">Forfatternavn</label>
                                <input type="text" name="author_name" id="author_name"
                                       class="form-control @error('author_name') is-invalid @enderror"
                                       value="{{old('author_name')}}"/>
                                @error('author_name')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="language">Sprog</label>
                                <select name="language" id="language" class="form-control @error('language') is-invalid @enderror">
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                                @error('language')
                                <span class="invalid-feedback">
                                   <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="birth_date">Fødselsdato</label>
                                <input type="date" name="birth_date" id="birth_date"
                                       class="form-control @error('birth_date') is-invalid @enderror"
                                       value="{{old('birth_date')}}"/>
                                @error('birth_date')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="death_date">Dødsdato</label>
                                <input type="date" name="death_date" id="death_date"
                                       class="form-control @error('death_date') is-invalid @enderror"
                                       value="{{old('death_date')}}"/>
                                @error('death_date')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="biography">Biografi</label>
                                <textarea name="biography" id="biography" class="form-control @error('biography') is-invalid @enderror"></textarea>
                                @error('biography')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="website_url">Hjemmeside URL</label>
                                <input type="url" name="website_url" id="website_url"
                                       class="form-control @error('website_url') is-invalid @enderror"
                                       value="{{old('website_url')}}"/>
                                @error('website_url')
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
                        <h5>Eksisterende forfatterer</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Fornavn</th>
                                <th>Mellemnavn</th>
                                <th>Efternavn</th>
                                <th>Forfatternavn</th>
                                <th>Aktion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($authors as $author)
                                <tr>
                                    <td>{{$author->id}}</td>
                                    <td>{{$author->first_name}}</td>
                                    <td>{{$author->middle_name}}</td>
                                    <td>{{$author->last_name}}</td>
                                    <td>{{$author->author_name}}</td>
                                    <td>
                                        <form action="{{route('adminpanel.author.destroy', $author->id)}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Er du sikker på, at du vil slette?')">
                                                Slet
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

        @if(!$deleted_authors->isEmpty())
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
                                    <th>Fornavn</th>
                                    <th>Mellemnavn</th>
                                    <th>Efternavn</th>
                                    <th>Forfatternavn</th>
                                    <th>Aktion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($deleted_authors as $deleted_author)
                                    <tr>
                                        <td>{{$deleted_author->id}}</td>
                                        <td>{{$deleted_author->first_name}}</td>
                                        <td>{{$deleted_author->middle_name}}</td>
                                        <td>{{$deleted_author->last_name}}</td>
                                        <td>{{$deleted_author->author_name}}</td>
                                        <td>
                                            <form action="{{route('adminpanel.author.restore', $deleted_author->id)}}"
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
