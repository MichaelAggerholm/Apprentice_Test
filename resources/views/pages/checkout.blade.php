@extends('layouts.master')
@section('title', 'Checkout')
@section('head')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{asset('js/stripe.js')}}"></script>
@endsection
@section('content')

    <header class="page-header">
        <h1>Betaling</h1>
        <h3 class="cart-amount" style="border-bottom: 1px solid #fff">Total: {{\App\Models\Cart::totalAmount()}} Kr.</h3>
    </header>

    <main class="checkout-page">
        <div class="container">

            <div class="checkout-form">
                <form action="{{'stripe-checkout'}}" id="payment-form" method="post">
                    @csrf

                    <div class="field">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="@error('name') has-error @enderror" placeholder="John Doe" value="{{old('name') ? old('name') : auth()->user()->name}}">
                        @error('name')
                            <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="@error('email') has-error @enderror" placeholder="JohnDoe@sol.dk" value="{{old('email') ? old('email') : auth()->user()->email}}">
                        @error('email')
                        <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" class="@error('phone') has-error @enderror" placeholder="12 34 56 78" value="{{old('phone')}}">
                        @error('phone')
                        <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="address">Adresse</label>
                        <input type="text" id="address" name="address" class="@error('address') has-error @enderror" placeholder="Vimmersvej 123" value="{{old('address')}}">
                        @error('address')
                        <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="zipcode">Postnummer</label>
                        <input type="text" id="zipcode" name="zipcode" class="@error('zipcode') has-error @enderror" placeholder="1234" value="{{old('zipcode')}}">
                        @error('zipcode')
                        <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="city">By</label>
                        <input type="text" id="city" name="city" class="@error('city') has-error @enderror" placeholder="Bumleby" value="{{old('city')}}">
                        @error('city')
                        <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="country">Country</label>
                        <select name="country" id="country">
                            <option value="">-- Vælg land --</option>
                            <option value="Denmark">Danmark</option>
                            <option value="Norway">Norge</option>
                            <option value="Sweden">Sverige</option>
                            <option value="Germany">Tyskland</option>
                        </select>
                        @error('country')
                        <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <input type="hidden" name="payment_method_id" id="payment_method_id" value="">

                    <div class="field">
                        <label class="stripe-payment-label">
                            Card details
                            <!-- placeholder for Elements -->
                            <div id="card-element"></div>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Submit Payment</button>

                </form>
            </div>

        </div>
    </main>

    <script>
        const stripe = Stripe('pk_test_51NmjR6GC71TVlUFgJezxpJpmFwbzKKUrYKZNVKcrLCMFSrCuIW4WFUEpAHRCO9plNUk4pqcB6t0RK1uszj35KkVa007yISOxVG');

        const elements = stripe.elements();

        // Set up Stripe.js and Elements to use in checkout form
        const style = {
            base: {
                color: "#32325d",
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#aab7c4"
                }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            },
        };

        const cardElement = elements.create('card', {style});
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');

        form.addEventListener('submit', async (event) => {
            // We don't want to let default form submission happen here,
            // which would refresh the page.
            event.preventDefault();

            const result = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
                billing_details: {
                    // Include any additional collected billing details.
                    name: 'John Doe',
                },
            })

            stripePaymentMethodHandler(result);
        });

        const stripePaymentMethodHandler = async (result) => {
            if (result.error) {
                // Show error in payment form
            } else {
                document.getElementById('payment_method_id').value = result.paymentMethod.id;
                form.submit();
            }
        }
    </script>

@endsection
