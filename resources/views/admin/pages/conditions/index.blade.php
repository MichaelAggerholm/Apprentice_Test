@extends('layouts.admin')
@section('title', 'Tilstande')
@section('content')

    <h1 class="page-title">Tilstande</h1>
    <p>Her defineres hvilke tilstande en bog kan have ved salg.</p>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Opret ny tilstand</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('adminpanel.condition.store')}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Tilstand</label>
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
                        <h5>Eksisterende tilstande</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tilstand</th>
                                <th>Mængde bøger</th>
                                <th>Aktiv</th>
                                <th>Aktion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($conditions as $condition)
                                <tr>
                                    <td>{{$condition->id}}</td>
                                    <td>{{$condition->name}}</td>
                                    <td>{{$condition->books_count}}</td>
                                    <td>{{\Carbon\Carbon::parse($condition->created_at)->format('d/m/Y')}}</td>
                                    <td>
                                        <form action="{{route('adminpanel.condition.destroy', $condition->id)}}"
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

        @if(!$deleted_conditions->isEmpty())
            <br>
            <hr>
            <br>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Slettede tilstande</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tilstand</th>
                                    <th>Mængde bøger</th>
                                    <th>Slettet</th>
                                    <th>Aktion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($deleted_conditions as $deleted_condition)
                                    <tr>
                                        <td>{{$deleted_condition->id}}</td>
                                        <td>{{$deleted_condition->name}}</td>
                                        <td>-</td>
                                        <td>{{\Carbon\Carbon::parse($deleted_condition->deleted_at)->format('d/m/Y')}}</td>
                                        <td>
                                            <form action="{{route('adminpanel.condition.restore', $deleted_condition->id)}}"
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
