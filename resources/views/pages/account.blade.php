@extends('layouts.master')
@section('title', 'account')
@section('content')
    <div class="account-page">
        <div class="container">
            <section class="u-box">
                <div class="user-info">
                    <p class="user-name">
                        {{auth()->user()->name}}
                    </p>
                    <p class="user-email">
                        {{auth()->user()->email}}
                    </p>
                </div>
                <div class="user-btn">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button class="btn btn-primary">Log ud</button>
                    </form>
                </div>
            </section>

        </div>
    </div>
@endsection
