@extends('layouts.admin')
@section('title', 'sprog')
@section('content')

    <h1 class="page-title">Sprog</h1>
    <p>Her defineres aktive sprog.</p>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Tilføj nyt sprog</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('adminpanel.language.store')}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Sprog</label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{old('name')}}"/>
                                @error('name')
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
                        <h5>Eksisterende sprog</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Sprog</th>
                                <th>Mængde bøger</th>
                                <th>Aktiv</th>
                                <th>Aktion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($languages as $language)
                                <tr>
                                    <td>{{$language->id}}</td>
                                    <td>{{$language->name}}</td>
                                    {{-- TODO: Husk at lave "Mængde af bøger med dette sprog"--}}
                                    <td>-</td>
                                    <td>{{\Carbon\Carbon::parse($language->created_at)->format('d/m/Y')}}</td>
                                    <td>
                                        <form action="{{route('adminpanel.language.destroy', $language->id)}}"
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

        @if(!$deleted_languages->isEmpty())
            <br>
            <hr>
            <br>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Slettede sprog</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sprog</th>
                                    <th>Mængde bøger</th>
                                    <th>Slettet</th>
                                    <th>Aktion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($deleted_languages as $deleted_language)
                                    <tr>
                                        <td>{{$deleted_language->id}}</td>
                                        <td>{{$deleted_language->name}}</td>
                                        <td>-</td>
                                        <td>{{\Carbon\Carbon::parse($deleted_language->deleted_at)->format('d/m/Y')}}</td>
                                        <td>
                                            <form action="{{route('adminpanel.language.restore', $deleted_language->id)}}"
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
