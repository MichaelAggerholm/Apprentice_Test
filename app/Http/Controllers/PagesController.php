<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $books = Book::with('genres', 'condition', 'format', 'publisher', 'language')->orderBy('created_at')->get();

        return view('pages.home', [
            'books' => $books
        ]);
    }

    // Kurv
    public function cart() {
        return view('pages.cart');
    }

    public function book($id) {
        return view('pages.book');
    }

    public function account() {
        return view('pages.account');
    }
}
