<?php

namespace App\Http\Controllers;

use App\Events\GenreActivity;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(){
        $genres = Genre::all();
        $deleted_genres = Genre::onlyTrashed()->get();
        return view('admin.pages.genres.index', ['genres' => $genres, 'deleted_genres' => $deleted_genres]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:genres|max:255'
        ]);

        $genre = new Genre();
        $genre->name = $request->name;
        $genre->save();

        event(new GenreActivity(auth()->user(), $genre, 'created'));

        return redirect()->back()->with('success', 'Genren blev oprettet');
    }

    public function destroy($id) {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        event(new GenreActivity(auth()->user(), $genre, 'deleted'));

        return back()->with('success', 'Genren blev slettet');
    }

    public function restore($id) {
        $genre = Genre::onlyTrashed()->findOrFail($id);
        $genre->restore();

        event(new GenreActivity(auth()->user(), $genre, 'restored'));

        return redirect()->back()->with('success', 'Genren blev gendannet');
    }
}
