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
                                    <td style="display: flex;">
                                        <a href="{{route('adminpanel.author.edit', $author->id)}}"
                                           class="btn btn-primary"
                                           role="button"
                                           style="padding:5px 10px;margin-right:5px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                            </svg>
                                        </a>
                                        <form action="{{route('adminpanel.author.destroy', $author->id)}}"
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
