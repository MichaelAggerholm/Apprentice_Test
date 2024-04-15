<?php

namespace App\Http\Controllers;

use App\Models\Format;
use Illuminate\Http\Request;

class FormatController extends Controller
{
    public function index(){
        $formats = Format::all();
        $deleted_formats = Format::onlyTrashed()->get();
        return view('admin.pages.formats.index', ['formats' => $formats, 'deleted_formats' => $deleted_formats]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:formats|max:255'
        ]);

        $format = new Format();
        $format->name = $request->name;
        $format->save();


        return redirect()->back()->with('success', 'Format blev oprettet');
    }

    public function destroy($id) {
        $format = Format::findOrFail($id);
        $format->delete();

        return back()->with('success', 'Format blev slettet');
    }

    public function restore($id) {
        $format = Format::onlyTrashed()->findOrFail($id);
        $format->restore();

        return redirect()->back()->with('success', 'Formatet blev gendannet');
    }
}
