<?php

namespace App\Http\Controllers;

use App\Events\ConditionActivity;
use App\Events\LanguageActivity;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index(){
        $languages = Language::all();
        $deleted_languages = Language::onlyTrashed()->get();
        return view('admin.pages.languages.index', ['languages' => $languages, 'deleted_languages' => $deleted_languages]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:languages|max:255'
        ]);

        $genre = new Language();
        $genre->name = $request->name;
        $genre->save();

        event(new LanguageActivity(auth()->user(), $genre, 'created'));

        return redirect()->back()->with('success', 'Sproget blev oprettet');
    }

    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('admin.pages.languages.edit', compact('language'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:languages,name,' . $id . '|max:255'
        ]);

        $language = Language::findOrFail($id);
        $language->name = $request->name;
        $language->save();

        event(new LanguageActivity(auth()->user(), $language, 'updated'));

        return redirect()->route('adminpanel.languages')->with('success', 'Sproget blev opdateret.');
    }

    public function destroy($id) {
        $language = Language::findOrFail($id);
        $language->delete();

        event(new LanguageActivity(auth()->user(), $language, 'deleted'));

        return back()->with('success', 'Sproget blev slettet');
    }

    public function restore($id) {
        $language = Language::onlyTrashed()->findOrFail($id);
        $language->restore();

        event(new LanguageActivity(auth()->user(), $language, 'restored'));

        return redirect()->back()->with('success', 'Sproget blev gendannet');
    }
}
