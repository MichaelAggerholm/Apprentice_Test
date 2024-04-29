@extends('layouts.admin')
@section('title', 'Ordrer')
@section('content')
    <h1 class="page-title">Ordrer</h1>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Ordrer</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>Ordre id</th>
                                <th>Navn</th>
                                <th>Bøger</th>
                                <th>Total</th>
                                <th>Dato</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->items->count()}}</td>
                                    <td>{{$order->total / 100}} Kr,-</td>
                                    <td>{{\Carbon\Carbon::parse($order->created_at)->format('d/m - Y')}}</td>
                                    <td>
                                        <span class="badge bg-@if($order->status == 'pending')warning
                                            @elseif($order->status == 'processing')info
                                            @elseif($order->status == 'shipped')success
                                            @elseif($order->status == 'cancelled')danger @endif
                                            ">
                                            {{$order->status}}</td>
                                        </span>
                                    <td>
                                        <div class="d-flex" style="gap: 5px;">
                                            <a href="{{route('adminpanel.orders.view', $order->id)}}" class="btn btn-primary btn-sm">View</a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <p><a href="https://dashboard.stripe.com/test/developers" target="_blank">Stripe hurtig adgang</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
