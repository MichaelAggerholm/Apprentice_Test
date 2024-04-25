@extends('layouts.admin')
@section('title', 'Rediger orfatterer')
@section('content')

    <h1 class="page-title">Rediger forfatterer</h1>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <h5>Rediger forfatterer</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adminpanel.author.update', $author->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="first_name">Fornavn</label>
                                <input type="text" name="first_name" id="first_name"
                                       class="form-control @error('first_name') is-invalid @enderror"
                                       value="{{old('first_name', $author->first_name)}}" />
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
                                       value="{{old('middle_name', $author->middle_name)}}"/>
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
                                       value="{{old('last_name', $author->last_name)}}"/>
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
                                       value="{{old('author_name', $author->author_name)}}"/>
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
                                        <option value="{{$language->id}}" {{ old('language', $author->language_id) == $language->id ? 'selected' : ''}}>
                                            {{$language->name}}
                                        </option>
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
                                       value="{{old('birth_date', $author->birth_date)}}"/>
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
                                       value="{{old('death_date', $author->death_date)}}"/>
                                @error('death_date')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="biography">Biografi</label>
                                <textarea name="biography" id="biography" class="form-control @error('biography') is-invalid @enderror">{{old('biography', $author->biography)}}</textarea>
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
                                       value="{{old('website_url', $author->website_url)}}"/>
                                @error('website_url')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="image">Billede</label>
                                @if($author->image)
                                    <div>
                                        <img src="{{ asset('storage/' . $author->image) }}" width="100" height="100" alt="Forfatter Billede">
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
