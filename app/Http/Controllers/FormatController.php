<?php

namespace App\Http\Controllers;

use App\Events\FormatActivity;
use App\Models\Format;
use Illuminate\Http\Request;

class FormatController extends Controller
{
    public function index(){
        $formats = Format::withCount('books')->get();
        $deleted_formats = Format::onlyTrashed()->withCount('books')->get();
        return view('admin.pages.formats.index', ['formats' => $formats, 'deleted_formats' => $deleted_formats]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:formats|max:255'
        ]);

        $format = new Format();
        $format->name = $request->name;
        $format->save();

        event(new FormatActivity(auth()->user(), $format, 'created'));

        return redirect()->back()->with('success', 'Format blev oprettet');
    }

    public function edit($id)
    {
        $format = Format::findOrFail($id);
        return view('admin.pages.formats.edit', compact('format'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:formats,name,' . $id . '|max:255'
        ]);

        $format = Format::findOrFail($id);
        $format->name = $request->name;
        $format->save();

        event(new FormatActivity(auth()->user(), $format, 'updated'));

        return redirect()->route('adminpanel.formats')->with('success', 'Formatet blev opdateret.');
    }

    public function destroy($id) {
        $format = Format::findOrFail($id);
        $format->delete();

        event(new FormatActivity(auth()->user(), $format, 'deleted'));

        return back()->with('success', 'Format blev slettet');
    }

    public function restore($id) {
        $format = Format::onlyTrashed()->findOrFail($id);
        $format->restore();

        event(new FormatActivity(auth()->user(), $format, 'restored'));

        return redirect()->back()->with('success', 'Formatet blev gendannet');
    }
}
