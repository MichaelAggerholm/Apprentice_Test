@extends('layouts.master')
@section('title', 'Login')
@section('content')
    <section class="login-page">
        <div class="login-form-box">
            <div class="login-title">Login</div>
            <div class="login-form">
                <form action="{{route('login')}}" method="post">
                    @csrf

                    <div class="field">
                        <label for="email">Email</label>
                        <!-- TODO: Gem gammel data ved fejlende registrering -->
                        <input type="email" name="email" id="email" class="@error('email') has-error @enderror" placeholder="Mail@gmail.com" value="{{old('email')}}">
                        @error('email')
                            <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="@error('password') has-error @enderror" placeholder="********">
                        @error('password')
                            <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <button type="submit" class="btn btn-primary btn-block">Log ind</button>
                    </div>

                    <a href="{{route('register')}}">Ny bruger? Registrer nu..</a>

                </form>
            </div>
        </div>
    </section>
@endsection
