<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request ,$id)
    {
        $book = Book::findOrFail($id);

        $item = [
            'book' => $book,
            'quantity' => $request->quantity,
        ];

        if (session()->has('cart'))
        {
            // Hvis kurv allerede eksisterer, Forøg antal af bog
            $cart = session()->get('cart');
            $key  = $this->checkItemInCart($item);

            if ($key != -1) {
                $cart[$key]['quantity'] += $request->quantity;
                session()->put('cart', $cart);
            } else {
                session()->push('cart', $item);
            }

        // Ny bog i kurven
        } else {
            session()->put('cart', [$item]);
        }

        return back()->with('addedToCart', 'Bogen blev tilføjet til kurven');
    }

    public function checkItemInCart($item)
    {
        foreach (session()->get('cart') as $key => $value)
        {
            if ($value['book']['id'] == $item['book']['id'])
            {
                return $key;
            }
        }
        return -1;
    }

    public function removeFromCart($key) {
        // Hvis kurven eksisterer, Fjern bogen med key via array_splice.
        if (session()->has('cart')) {
            $cart = session()->get('cart');
            array_splice($cart, $key, 1);

            // Opdater kurv session, og redirect tilbage med success besked.
            session()->put('cart', $cart);
            return back()->with('removedFromCart', 'Bogen blev fjernet fra kurven');
        }

        // TODO: Det bør ikke være muligt at komme her til, mangler test, fjernes efterfølgende.
        return back()->with('removedFromCart', 'Fejl.. ! - der er ingen varer i kurven');
    }
}
