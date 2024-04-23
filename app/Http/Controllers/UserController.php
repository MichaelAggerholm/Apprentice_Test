<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        $deleted_users = User::onlyTrashed()->get();

        return view('admin.pages.users.index', ['users' => $users, 'deleted_users' => $deleted_users]);
    }

    public function store(Request $request) {
        $request->validate([
            'name'          => 'required|max:255',
            'email'         => 'required|unique:users|max:255',
            'password'      => 'required|confirmed',
            'is_admin'      => 'required'
        ]);

        $user = new User;
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);
        $user->is_admin     = $request->is_admin;
        $user->save();

        return redirect()->route('adminpanel.users')->with('success', 'Brugeren blev oprettet!');
    }

    public function edit($id) {
        $user = User::findOrFail($id);

        return view('admin.pages.users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name'          => 'required|max:255',
            'email'         => 'required|max:255',
            'is_admin'      => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->is_admin = $request->is_admin;
        $user->save();

        return redirect()->route('adminpanel.users')->with('success', 'Brugeren blev opdateret!');
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Bruger Slettet!');
    }

    public function restore($id) {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->back()->with('success', 'Bruger blev gendannet');
    }
}
