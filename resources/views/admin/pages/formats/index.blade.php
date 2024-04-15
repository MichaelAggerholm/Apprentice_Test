@extends('layouts.admin')
@section('title', 'formater')
@section('content')

    <h1 class="page-title">Formater</h1>
    <p>Her defineres hvilke formater en bog kan have.</p>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Opret ny format</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('adminpanel.format.store')}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Format</label>
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
                        <h5>Eksisterende formater</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Format</th>
                                <th>Mængde bøger</th>
                                <th>Aktiv</th>
                                <th>Aktion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($formats as $format)
                                <tr>
                                    <td>{{$format->id}}</td>
                                    <td>{{$format->name}}</td>
                                    {{-- TODO: Husk at lave "Mængde af bøger med dette format"--}}
                                    <td>-</td>
                                    <td>{{\Carbon\Carbon::parse($format->created_at)->format('d/m/Y')}}</td>
                                    <td>
                                        <form action="{{route('adminpanel.format.destroy', $format->id)}}"
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

        @if(!$deleted_formats->isEmpty())
            <br>
            <hr>
            <br>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Slettede formater</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Format</th>
                                    <th>Mængde bøger</th>
                                    <th>Slettet</th>
                                    <th>Aktion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($deleted_formats as $deleted_format)
                                    <tr>
                                        <td>{{$deleted_format->id}}</td>
                                        <td>{{$deleted_format->name}}</td>
                                        <td>-</td>
                                        <td>{{\Carbon\Carbon::parse($deleted_format->deleted_at)->format('d/m/Y')}}</td>
                                        <td>
                                            <form action="{{route('adminpanel.format.restore', $deleted_format->id)}}"
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
