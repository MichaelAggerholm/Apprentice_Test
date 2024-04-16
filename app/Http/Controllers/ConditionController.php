<?php

namespace App\Http\Controllers;

use App\Events\ConditionActivity;
use App\Models\Condition;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    public function index(){
        $conditions = Condition::all();
        $deleted_conditions = Condition::onlyTrashed()->get();
        return view('admin.pages.conditions.index', ['conditions' => $conditions, 'deleted_conditions' => $deleted_conditions]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:conditions|max:255'
        ]);

        $condition = new Condition();
        $condition->name = $request->name;
        $condition->save();

        event(new ConditionActivity(auth()->user(), $condition, 'created'));

        return redirect()->back()->with('success', 'Tilstand blev oprettet');
    }

    public function destroy($id) {
        $condition = Condition::findOrFail($id);
        $condition->delete();

        event(new ConditionActivity(auth()->user(), $condition, 'deleted'));

        return back()->with('success', 'Tilstand blev slettet');
    }

    public function restore($id) {
        $condition = Condition::onlyTrashed()->findOrFail($id);
        $condition->restore();

        event(new ConditionActivity(auth()->user(), $condition, 'restored'));

        return redirect()->back()->with('success', 'Tilstanden blev gendannet');
    }
}
