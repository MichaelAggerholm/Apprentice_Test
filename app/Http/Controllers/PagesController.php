<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Condition;
use App\Models\Format;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(Request $request)
    {
        $query = $request->get('query');

        if($query){
            $books = Book::with('genres', 'condition', 'format', 'language')
                ->join('conditions', 'books.condition_id', '=', 'conditions.id')
                ->join('formats', 'books.format_id', '=', 'formats.id')
                ->join('languages', 'books.language_id', '=', 'languages.id')
                ->where('books.title', 'LIKE', "%{$query}%")
                ->orWhere('conditions.name', 'LIKE', "%{$query}%")
                ->orWhere('formats.name', 'LIKE', "%{$query}%")
                ->orWhere('languages.name', 'LIKE', "%{$query}%")
                ->latest()
                ->take(8)
                ->get();
        } else {
            $books = Book::with('genres', 'condition', 'format', 'language')
                ->latest()
                ->take(8)
                ->get();
        }


        return view('pages.home', [
            'books' => $books
        ]);
    }

    public function allBooks(Request $request)
    {
        $conditions = $request->get('conditions', []);
        $formats = $request->get('formats', []);
        $query = $request->get('query', '');

        $books = Book::with('genres', 'condition', 'format', 'language');

        if(count($conditions) > 0){
            $books->whereIn('condition_id', $conditions);
        }

        if(count($formats) > 0){
            $books->whereIn('format_id', $formats);
        }

        if($query != ''){
            $books
                ->where('books.title', 'LIKE', "%{$query}%")
                ->orWhere('conditions.name', 'LIKE', "%{$query}%")
                ->orWhere('formats.name', 'LIKE', "%{$query}%")
                ->orWhere('languages.name', 'LIKE', "%{$query}%");
        }

        $books = $books->latest()->get();

        $conditions = Condition::all();
        $formats = Format::all();

        return view('pages.allBooks', [
            'books' => $books,
            'conditions' => $conditions,
            'formats' => $formats
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
