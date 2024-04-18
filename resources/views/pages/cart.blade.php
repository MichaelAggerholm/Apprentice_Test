@extends('layouts.master')
@section('title', 'Kurv')
@section('content')

    <header class="page-header">
        <h1>Kurv</h1>
        <h3 class="cart-amount" style="border-bottom: 1px solid #fff">Total: {{\App\Models\Cart::totalAmount()}} Kr.</h3>
    </header>

    <main class="cart-page">
        <div class="container">

            @if(session()->has('removedFromCart'))
                <div class="confirmMessage">
                    {{session()->get('removedFromCart')}}
                </div>
            @endif

            <div class="cart-table">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Bog</th>
                        <th></th>
                        <th>Pris</th>
                        <th>Antal</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(session()->has('cart') && count(session()->get('cart')) > 0)
                            @foreach(session()->get('cart') as $key => $item)
                                <tr>
                                    <td>
                                        <a href="{{route('book', $item['book']['id'])}}" class="cart-item-title">
                                            <p>{{$item['book']['title']}}</p>
                                        </a>
                                    </td>
                                    <td><img src="{{asset('storage/' . $item['book']['image'])}}" alt="{{$item['book']['title']}}" style="width:75px;"></td>
                                    <td>{{$item['book']['price']}} kr.</td>
                                    <td>{{$item['quantity']}}</td> <!-- TODO: Gør det muligt at +/- fra quantity, direkte fra kurven -->
                                    <td>{{App\Models\Cart::unitPrice($item)}} kr.</td>
                                    <td>
                                        <form action="{{route('removeFromCart', $key)}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">X</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            <tr class="cart-total">
                                <td colspan="5" style="text-align: right;">Total:</td>
                                <td>{{\App\Models\Cart::totalAmount()}} kr.</td>
                            </tr>

                            @else
                            <tr>
                                <td colspan="6" class="empty-cart">Kurven er tom.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="cart-actions">
                <a href="#" class="btn btn-primary">Til betaling</a>
{{--                <a href="{{route('checkout')}}" class="btn btn-primary">Til betaling</a>--}}
            </div>

        </div>
    </main>

@endsection
