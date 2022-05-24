<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Style;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        $styles = Style::all(['id', 'name']);

        return view('admins.admin', ['users' => $users, 'styles' => $styles]);
    }

    public function create()
    {
        $roles = Role::all(['id', 'name']);

        return view('admins.admin_user_create', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30',
            'address' => 'required|min:2|max:30',
            'email' => 'required|email',
            'telephone' => 'required|min:9|max:9',
            'password' => 'required|min:7',
            'nationality' => 'required|min:3|max:15',
            'role_id' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'address' => $request->address,
            'nationality' => $request->nationality,
            'role_id' => $request->role_id,
            // 'user_id' => auth()->user()->id, // input name="user_id" value=user_id type="hidden"
        ]);

        return redirect()->route('admin.user');
    }

    public function destroy($id)
    {
        //Obra::destroy($id);

        $user = User::findOrFail($id);
        $user->delete();

        // Flashed session(with('status', '...'));
        return redirect()->route('admin.user', $id)->with('status', "user $user->name eliminada correctamente");
    }

    public function edit($id)
    {

        $user = User::findOrFail($id);
        $roles = Role::all(['id', 'name']);

        return view('admins.admin_user_edit', [
            'roles' => $roles,
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30',
            'address' => 'required|min:2|max:30',
            'email' => 'required|email',
            'telephone' => 'required|min:9|max:9',
            // 'password' => 'required|min:7',
            'nationality' => 'required|min:3|max:15',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->telephone = $request->telephone;
        $user->address = $request->address;
        $user->nationality = $request->nationality;
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('admin.user', $id)->with('success', "Usuario $user->name actualizado correctamente");
    }
}
