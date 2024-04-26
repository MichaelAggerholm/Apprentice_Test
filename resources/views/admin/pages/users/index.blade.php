@extends('layouts.admin')
@section('title', 'brugerer')
@section('content')

    <h1 class="page-title">Brugerer</h1>
    <p>Her defineres aktive brugerer.</p>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Tilføj ny bruger</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('adminpanel.user.store')}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Navn</label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{old('name')}}"/>
                                @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{old('email')}}"/>
                                @error('email')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Adgangskode</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}"/>
                                @error('password')
                                <span class="invalid-feedback">
                                            <strong>{{$message}}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password_confirmation">Bekræft Adgangskode</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="is_admin">Admin?</label>
                                <select name="is_admin" id="is_admin" class="form-control @error('is_admin') is-invalid @enderror">
                                    <option value="0" {{ old('is_admin') == '0' ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('is_admin') == '1' ? 'selected' : '' }}>Yes</option>
                                </select>
                                @error('is_admin')
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
                        <h5>Eksisterende brugerer</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>navn</th>
                                <th>email</th>
                                <th>admin?</th>
                                <th>Aktion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{ $user->is_admin == true ? 'Ja' : 'Nej' }}</td>
                                    <td style="display: flex;">
                                        <a href="{{route('adminpanel.user.edit', $user->id)}}"
                                           class="btn btn-primary"
                                           role="button"
                                           style="padding:5px 10px;margin-right:5px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                            </svg>
                                        </a>
                                        <form action="{{route('adminpanel.user.destroy', $user->id)}}"
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

        @if(!$deleted_users->isEmpty())
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
                                    <th>Navn</th>
                                    <th>Email</th>
                                    <th>Slettet</th>
                                    <th>Aktion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($deleted_users as $deleted_user)
                                    <tr>
                                        <td>{{$deleted_user->id}}</td>
                                        <td>{{$deleted_user->name}}</td>
                                        <td>-</td>
                                        <td>{{\Carbon\Carbon::parse($deleted_user->deleted_at)->format('d/m/Y')}}</td>
                                        <td>
                                            <form action="{{route('adminpanel.user.restore', $deleted_user->id)}}"
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
