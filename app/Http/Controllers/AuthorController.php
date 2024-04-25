<?php

namespace App\Http\Controllers;

use App\Events\AuthorActivity;
use App\Models\Author;
use App\Models\Language;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        $deleted_authors = Author::onlyTrashed()->get();
        $languages = Language::all();
        return view('admin.pages.authors.index', ['authors' => $authors, 'deleted_authors' => $deleted_authors, 'languages' => $languages]);
    }

    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required|max:255',
            'middle_name' => 'nullable|max:255',
            'last_name' => 'required|max:255',
            'author_name' => 'required|unique:authors,author_name|max:255',
            'language' => 'required|integer|exists:languages,id',
            'birth_date' => 'required|date',
            'death_date' => 'nullable|date|after:birth_date',
            'biography' => 'nullable',
            'website_url' => '',
            'image' => 'nullable|image|max:2048'
        ]);

        $author = new Author();
        $author->first_name = $request->first_name;
        $author->middle_name = $request->middle_name ? $request->middle_name : NULL;
        $author->last_name = $request->last_name;
        $author->author_name = $request->author_name;
        $author->language_id = $request->language;
        $author->birth_date = $request->birth_date;
        $author->death_date = $request->death_date;
        $author->biography = $request->biography ? $request->biography : NULL;
        $author->website_url = $request->website_url ? $request->website_url : NULL;

        if($request->hasFile('image')) {
            // For at sikre et unikt navn til billeder som uploades.
            $image_name = 'author_images/' . time() . '-' . rand(0, 9999) . '.' . $request->image->extension();
            $request->image->storeAs('public', $image_name);
            $author->image = $image_name;
        }
        else {
            $author->image = NULL;
        }

        $author->save();

        event(new AuthorActivity(auth()->user(), $author, 'created'));

        return redirect()->back()->with('success', 'Forfatteren blev oprettet');
    }

    public function edit($id) {
        $author = Author::findOrFail($id);
        $languages = Language::all();

        return view('admin.pages.authors.edit', ['author' => $author, 'languages' => $languages]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'first_name' => 'required|max:255',
            'middle_name' => 'nullable|max:255',
            'last_name' => 'required|max:255',
            'author_name' => 'required|unique:authors,author_name,' . $id . '|max:255',
            'language' => 'required|integer|exists:languages,id',
            'birth_date' => 'required|date',
            'death_date' => 'nullable|date|after:birth_date',
            'biography' => 'nullable',
            'website_url' => '',
            'image' => 'nullable|image|max:2048'
        ]);

        $author = Author::findOrFail($id);
        $author->first_name = $request->first_name;
        $author->middle_name = $request->middle_name ? $request->middle_name : NULL;
        $author->last_name = $request->last_name;
        $author->author_name = $request->author_name;
        $author->language_id = $request->language;
        $author->birth_date = $request->birth_date;
        $author->death_date = $request->death_date;
        $author->biography = $request->biography ? $request->biography : NULL;
        $author->website_url = $request->website_url ? $request->website_url : NULL;

        if($request->hasFile('image')) {
            // For at sikre et unikt navn til billeder som uploades.
            $image_name = 'author_images/' . time() . '-' . rand(0, 9999) . '.' . $request->image->extension();
            $request->image->storeAs('public', $image_name);
            $author->image = $image_name;
        }

        $author->save();

        return redirect()->route('adminpanel.authors')->with('success', 'Forfatteren blev opdateret!');
    }

    public function destroy($id) {
        $author = Author::findOrFail($id);
        $author->delete();

        event(new AuthorActivity(auth()->user(), $author, 'deleted'));

        return back()->with('success', 'Forfatteren blev slettet');
    }

    public function restore($id) {
        $author = Author::onlyTrashed()->findOrFail($id);
        $author->restore();

        event(new AuthorActivity(auth()->user(), $author, 'restored'));

        return redirect()->back()->with('success', 'Forfatteren blev gendannet');
    }
}
