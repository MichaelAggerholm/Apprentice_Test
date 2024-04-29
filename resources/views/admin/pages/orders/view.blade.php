@extends('layouts.admin')
@section('title', 'Ordre #' . $order->id)
@section('content')
    <div class="page-title">Ordre #{{$order->id}}</div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Ordre Detaljer</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <tbody>
                            <tr>
                                <td>Ordre #</td>
                                <td>{{$order->id}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <form action="{{route('adminpanel.order.status.update', $order->id)}}" method="post" style="display:flex;gap:15px;max-width:300px;">
                                        @csrf
                                        <select name="status" class="form-control">
                                            @foreach($states as $status)
                                                <option value="{{$status}}" @if($order->status == $status) selected @endif>{{$status}}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-success btn-sm">Opdater</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Total beløb</td>
                                <td>{{$order->total / 100}}</td>
                            </tr>
                            <tr>
                                <td>Navn</td>
                                <td>{{$order->name}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{$order->email}}</td>
                            </tr>
                            <tr>
                                <td>Telefon</td>
                                <td>{{$order->phone}}</td>
                            </tr>
                            <tr>
                                <td>Land</td>
                                <td>{{$order->country}}</td>
                            </tr>
                            <tr>
                                <td>By</td>
                                <td>{{$order->city}}</td>
                            </tr>
                            <tr>
                                <td>Postnr</td>
                                <td>{{$order->zip}}</td>
                            </tr>
                            <tr>
                                <td>Adresse</td>
                                <td>{{$order->address}}</td>
                            </tr>
                            <tr>
                                <td>Stripe #</td>
                                <td>{{$order->stripe_id}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
