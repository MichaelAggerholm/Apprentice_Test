<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function stripeCheckout(Request $request) {

        // Valider request date
        $request->validate([
            'payment_method_id' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|max:255',
        ]);

        // Stripe public key
        // TODO: Sæt key i .env i stedet.
        Stripe::setApiKey('sk_test_51NmjR6GC71TVlUFgIj7F9tjHT0UC6ytYMsplpWEDWb7vxa9OnbrKyMlw83xCbIjF4uYO10OpaoVVHnJ1JSmC9iln00LvfaMtXo');

        try {
            if ($request->payment_method_id) {
                // Opret PaymentIntent, Dette opretter ordredetailjer til stripe
                // TODO: Opdater det her med mange flere brugerdetaljer, enten her, eller måske i det latterlige Javascript jeg fik tilføjet på checkout.blade.php
                // TODO: Det skal gøres med et 'line_items' object som i videoen her: https://www.youtube.com/watch?v=gkc1GcBKh1M
                // TODO: og alt skal med: bog, antal, navn, pris, osv. osv.
                PaymentIntent::create([
                    'payment_method' => $request->payment_method_id,
                    'amount' => Cart::totalAmount() * 100,
                    'currency' => 'dkk',
                    'confirmation_method' => 'manual',
                    'confirm' => true,
                    'return_url' => route('success'),
                ]);
            }
        } catch (ApiErrorException $e) {
            // TODO: Gør et eller andet for at håndtere fejl..
            echo json_encode([
                'error' => $e->getMessage()
            ]);
        }

        // Tilføj ordren til databasen
        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state, // TODO: State bliver ikke brugt, bør fjernes senere
            'city' => $request->city,
            'zip' => $request->zipcode,
            'stripe_id' => $request->payment_method_id,
            'status' => 'pending',
            'total' => Cart::totalAmount() * 100,
        ]);

        // Tilføj odre "Items" i databasen
        foreach (session()->get('cart') as $item) {
            $order->items()->create([
                'book_id' => $item['book']['id'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Alt er gjort, betaling er gennemført, Ordre og ordre-items tilføjet til db, clear cart.
        session()->forget('cart');

        // Redirect to success page with order details
        return view('pages.orderSuccess', [
         'order' => $order,
        ]);
    }
}
