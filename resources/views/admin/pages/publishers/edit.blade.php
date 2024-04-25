@extends('layouts.admin')
@section('title', 'Rediger udgiver')
@section('content')

    <h1 class="page-title">Rediger udgiver</h1>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <h5>Rediger udgiver</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adminpanel.publisher.update', $publisher->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="name">Navn</label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{old('name', $publisher->name)}}"/>
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
                                       value="{{old('address', $publisher->address)}}"/>
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
                                       value="{{old('city', $publisher->city)}}"/>
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
                                       value="{{old('zip', $publisher->zip)}}"/>
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
                                       value="{{old('country', $publisher->country)}}"/>
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
                                       value="{{old('contact_name', $publisher->contact_name)}}"/>
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
                                       value="{{old('contact_email', $publisher->contact_email)}}"/>
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
                                       value="{{old('contact_phone', $publisher->contact_phone)}}"/>
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
                                       value="{{old('website_url', $publisher->website_url)}}"/>
                                @error('website_url')
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
