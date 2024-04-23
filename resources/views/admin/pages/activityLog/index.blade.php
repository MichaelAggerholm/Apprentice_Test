@extends('layouts.admin')
@section('title', 'Aktivitets log')
@section('content')

    <h1 class="page-title">Aktivitets log</h1>
    <p>Her kan man se admin bruger aktivitet</p>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Sidste 20 hændelser</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Hvornår</th>
                                <th>Hændelse</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($activityLogs as $activityLog)
                                <tr>
                                    <td>{{$activityLog->id}}</td>
                                    <td>{{$activityLog->created_at}}</td>
                                    <td>{{$activityLog->description}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <a href="{{ route('adminpanel.activitylog.export') }}" class="btn btn-primary">Download fuld Log som Excel fil</a>
            </div>
        </div>
    </div>

@endsection
