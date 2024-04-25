@extends('layouts.admin')
@section('title', 'Forfatterer')
@section('content')

    <h1 class="page-title">Udgiverer</h1>
    <p>Her defineres bøgernes udgiverer.</p>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <h5>Tilføj ny udgiver</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adminpanel.publisher.store') }}" method="post">
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
                                <label for="address">Adresse</label>
                                <input type="text" name="address" id="address"
                                       class="form-control @error('address') is-invalid @enderror"
                                       value="{{old('address')}}"/>
                                @error('address')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="city">By</label>
                                <input type="text" name="city" id="city"
                                       class="form-control @error('city') is-invalid @enderror"
                                       value="{{old('city')}}"/>
                                @error('city')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="zip">Postnr</label>
                                <input type="number" name="zip" id="zip"
                                       class="form-control @error('zip') is-invalid @enderror"
                                       value="{{old('zip')}}"/>
                                @error('zip')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="country">Land</label>
                                <input type="text" name="country" id="country"
                                       class="form-control @error('country') is-invalid @enderror"
                                       value="{{old('country')}}"/>
                                @error('country')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="contact_name">Kontaktperson navn</label>
                                <input type="text" name="contact_name" id="contact_name"
                                       class="form-control @error('contact_name') is-invalid @enderror"
                                       value="{{old('contact_name')}}"/>
                                @error('contact_name')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="contact_email">Kontaktperson email</label>
                                <input type="text" name="contact_email" id="contact_email"
                                       class="form-control @error('contact_email') is-invalid @enderror"
                                       value="{{old('contact_email')}}"/>
                                @error('contact_email')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="contact_phone">Kontaktperson telefon</label>
                                <input type="text" name="contact_phone" id="contact_phone"
                                       class="form-control @error('contact_phone') is-invalid @enderror"
                                       value="{{old('contact_phone')}}"/>
                                @error('contact_phone')
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
                        <h5>Eksisterende udgiverer</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Navn</th>
                                <th>kontakt navn</th>
                                <th>kontakt email</th>
                                <th>kontakt telefon</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($publishers as $publisher)
                                <tr>
                                    <td>{{$publisher->id}}</td>
                                    <td>{{$publisher->name}}</td>
                                    <td>{{$publisher->contact_name}}</td>
                                    <td>{{$publisher->contact_email}}</td>
                                    <td>{{$publisher->contact_phone}}</td>
                                    <td style="display: flex;">
                                        <a href="{{route('adminpanel.publisher.edit', $publisher->id)}}"
                                           class="btn btn-primary"
                                           role="button"
                                           style="padding:5px 10px;margin-right:5px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                            </svg>
                                        </a>
                                        <form action="{{route('adminpanel.publisher.destroy', $publisher->id)}}"
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

        @if(!$deleted_publishers->isEmpty())
            <br>
            <hr>
            <br>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Slettede udgiverer</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Navn</th>
                                    <th>kontakt navn</th>
                                    <th>kontakt email</th>
                                    <th>kontakt telefon</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($deleted_publishers as $deleted_publisher)
                                    <tr>
                                        <td>{{$deleted_publisher->id}}</td>
                                        <td>{{$deleted_publisher->name}}</td>
                                        <td>{{$deleted_publisher->contact_name}}</td>
                                        <td>{{$deleted_publisher->contact_email}}</td>
                                        <td>{{$deleted_publisher->contact_phone}}</td>
                                        <td>
                                            <form action="{{route('adminpanel.publisher.restore', $deleted_publisher->id)}}"
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
