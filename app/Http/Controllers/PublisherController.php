<?php

namespace App\Http\Controllers;

use App\Events\PublisherActivity;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::all();
        $deleted_publishers = Publisher::onlyTrashed()->get();
        return view('admin.pages.publishers.index', ['publishers' => $publishers, 'deleted_publishers' => $deleted_publishers]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'zip' => 'required|regex:/\b\d{4}\b/', // Regex matching a 4 digit zipcode
            'country' => 'required|max:255',
            'contact_name' => 'required|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|digits:8',
            'website_url' => '',
        ]);

        $publisher = new Publisher();
        $publisher->name = $request->name;
        $publisher->address = $request->address;
        $publisher->city = $request->city;
        $publisher->zip = $request->zip;
        $publisher->country = $request->country;
        $publisher->contact_name = $request->contact_name;
        $publisher->contact_email = $request->contact_email;
        $publisher->contact_phone = $request->contact_phone;
        $publisher->website_url = $request->website_url ? $request->website_url : NULL;


        $publisher->save();

        event(new PublisherActivity(auth()->user(), $publisher, 'created'));

        return redirect()->back()->with('success', 'Udgiveren blev oprettet');
    }

    public function destroy($id) {
        $publisher = Publisher::findOrFail($id);
        $publisher->delete();

        event(new PublisherActivity(auth()->user(), $publisher, 'deleted'));

        return back()->with('success', 'Udgiveren blev slettet');
    }

    public function restore($id) {
        $publisher = Publisher::onlyTrashed()->findOrFail($id);
        $publisher->restore();

        event(new PublisherActivity(auth()->user(), $publisher, 'restored'));

        return redirect()->back()->with('success', 'Udgiveren blev gendannet');
    }
}
