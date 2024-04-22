<?php

namespace App\Http\Controllers;

use App\Events\BookActivity;
use App\Imports\BooksImport;
use App\Models\Author;
use App\Models\Book;
use App\Models\Condition;
use App\Models\Format;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

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
        $genres = Genre::all();
        $authors = Author::all();
        return view('admin.pages.books.index', [
            'books' => $books,
            'deleted_books' => $deleted_books,
            'conditions' => $conditions,
            'formats' => $formats,
            'publishers' => $publishers,
            'languages' => $languages,
            'genres' => $genres,
            'authors' => $authors,
            ]);
    }

    public function store(Request $request) {
        $request->validate([
            'condition_id' => 'required|integer|exists:conditions,id',
            'format_id' => 'required|integer|exists:formats,id',
            'publisher_id' => 'required|integer|exists:publishers,id',
            'language_id' => 'required|integer|exists:languages,id',
            'genres' => 'required|array',
            'authors' => 'required|array',
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'isbn' => 'required|string|max:13|unique:books,isbn',
            'publish_date' => 'required|date',
            'page_count' => 'required|integer|min:1',
            'stock' => 'integer|nullable',
            'price' => 'required|numeric|min:0', // TODO: Skal muligvis ganges med 100 for at virke med betalingsopsætning. (Stripe)
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        // For at sikre et unikt navn til billeder som uploades.
        $image_name = 'book_images/' . time() . '-' . rand(0, 9999) . '.' . $request->image->extension();
        $request->image->storeAs('public', $image_name);

        // Gem bog
        $book = Book::create([
            'condition_id' => $request->condition_id,
            'format_id' => $request->format_id,
            'publisher_id' => $request->publisher_id,
            'language_id' => $request->language_id,
            'title' => $request->title,
            'summary' => $request->summary,
            'isbn' => $request->isbn,
            'publish_date' => $request->publish_date,
            'page_count' => $request->page_count,
            'stock' => $request->stock,
            'price' => $request->price,
            'image' => $image_name
        ]);

        // Tilføj genre og forfatter til bog
        $book->genres()->attach($request->genres);
        $book->authors()->attach($request->authors);

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

    public function import(Excel $excel)
    {
        try {
            $path = Storage::disk('public')->path('test/import_test.xlsx');
            $excel->import(new BooksImport, $path);

            return back()->with('success', 'Bøger blev importeret med succes');

        } catch (\Exception $e) {
            return back()->with('warning', 'Der blev ikke importeret nogen bøger, bedre fejlbesked og logging over hvad der sker under import, bør komme senere, her er nuværende exception: '.$e->getMessage());
        }
    }
}
