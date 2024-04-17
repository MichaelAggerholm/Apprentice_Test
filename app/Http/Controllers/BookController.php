<?php

namespace App\Http\Controllers;

use App\Events\BookActivity;
use App\Models\Book;
use App\Models\Condition;
use App\Models\Format;
use App\Models\Language;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        $deleted_books = Book::onlyTrashed()->get();
        $conditions = Condition::all();
        $formats = Format::all();
        $publishers = Publisher::all();
        $languages = Language::all();
        return view('admin.pages.books.index', [
            'books' => $books,
            'deleted_books' => $deleted_books,
            'conditions' => $conditions,
            'formats' => $formats,
            'publishers' => $publishers,
            'languages' => $languages,
            ]);
    }

    public function store(Request $request) {
        $request->validate([
            'condition_id' => 'required|integer|exists:conditions,id',
            'format_id' => 'required|integer|exists:formats,id',
            'publisher_id' => 'required|integer|exists:publishers,id',
            'language_id' => 'required|integer|exists:languages,id',
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'isbn' => 'required|string|max:13|unique:books,isbn',
            'publish_date' => 'required|date',
            'page_count' => 'required|integer|min:1',
            'stock' => 'integer|nullable',
            'price' => 'required|numeric|min:0',
            'image' => 'image|nullable|max:2048'
        ]);

        $book = new Book;
        $book->condition_id = $request->condition_id;
        $book->format_id = $request->format_id;
        $book->publisher_id = $request->publisher_id;
        $book->language_id = $request->language_id;
        $book->title = $request->title;
        $book->summary = $request->summary;
        $book->isbn = $request->isbn;
        $book->publish_date = $request->publish_date;
        $book->page_count = $request->page_count;
        $book->stock = $request->has('stock') ? $request->stock : 0;
        $book->price = $request->price;

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'_'.$image->getClientOriginalName();
            $destinationPath = storage_path('uploads');
            $image->move($destinationPath, $name);
            $book->image = '/uploads/'.$name;
        }
        else {
            $book->image = NULL;
        }

        $book->save();

        event(new BookActivity(auth()->user(), $book, 'created'));

        return redirect()->back()->with('success', 'Bogen blev oprettet')->withInput();
    }

    public function destroy($id) {
        $book = Book::findOrFail($id);
        $book->delete();

        event(new BookActivity(auth()->user(), $book, 'deleted'));

        return back()->with('success', 'Bogen blev slettet');
    }

    public function restore($id) {
        $book = Book::onlyTrashed()->findOrFail($id);
        $book->restore();

        event(new BookActivity(auth()->user(), $book, 'restored'));

        return redirect()->back()->with('success', 'Bogen blev gendannet');
    }
}
