<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv=”X-UA-Compatible” content=”ie=edge”>

    @vite('resources/css/app.scss')
    <title>@yield('title')</title>
    @yield('head')
</head>
    <body>
        @include('layouts.partials.nav')

        <main class="page">
            @yield('content')
        </main>

        @include('layouts.partials.footer')
    </body>
</html>
