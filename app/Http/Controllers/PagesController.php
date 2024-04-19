<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $books = Book::with('genres', 'condition', 'format', 'language')->latest()->take(6)->get();

        return view('pages.home', [
            'books' => $books
        ]);
    }

    public function book($id) {
        $book = Book::with('genres', 'condition', 'format', 'publisher', 'language', 'authors')->findOrFail($id);

        return view('pages.book', [
            'book' => $book
        ]);
    }

    // Kurv
    public function cart() {
        return view('pages.cart');
    }

    public function account() {
        return view('pages.account');
    }

    // Checkout
    public function checkout() {
        return view('pages.checkout');
    }

    // success
    public function success() {
//        return view('pages.success');
        return 'success';
    }
}
