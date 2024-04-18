@extends('layouts.admin')
@section('title', 'Rediger Sprog')
@section('content')

    <h1 class="page-title">Rediger Sprog</h1>

    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Rediger sprog</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('adminpanel.language.update', $language->id)}}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="name">Sprog</label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{old('name', $language->name)}}"/>
                                @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group text-end">
                                <button type="submit" class="btn btn-primary">Opdater</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
