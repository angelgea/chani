<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $styles = Style::all(['id', 'name']);
        
        return view('profile', [
            'styles' => $styles
        ]);

    }


    public function store(Request $request, $id)
    { 

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30',
            'address' => 'required|min:2|max:30',
            'email' => 'required|email',
            'telephone' => 'required|min:9|max:9',
            'oldPassword' => 'required|min:7',
            'password' => 'nullable|min:7|required_with:confirmedPassword|same:confirmedPassword',
            'confirmedPassword' => 'nullable|min:7',
            'nationality' => 'required|min:3|max:15',
        ]);

        $canUpdate = false;
        
        if(Hash::check($request->oldPassword, auth()->user()->password)) {
            $canUpdate = true;
        }

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if(! $canUpdate) {
            return redirect()->route('profile')
                    ->with('failed', 'Tienes que introducir contraseña actual para poder actualizar.');
        }
        
        $user = Auth::user();
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!is_null($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->telephone = $request->telephone;
        $user->address = $request->address;
        $user->nationality = $request->nationality;
        $user->save();

        return redirect()->route('profile')->with('success', 'Datos modificados correctamente');
    }




        // if ($request->passwordActual != "") {
        //     $passwordNueva = $request->passwordNueva;
        //     $passwordConfirm = $request->passwordConfirm;
        //     $nombre = $request->nombre;;
        //     if (Hash::check($request->passwordActual, $usuarioPassword)) {

        //         if($passwordNueva == $passwordConfirm){
        //             if(strlen($passwordNueva)>=7){
        //                 $usuario->password = Hash::make($request->password);
        //                 $bbdd = DB::table('usuarios')
        //                 ->where('id',$usuario->id)
        //                 ->update(['password' => $usuario->password],['name' => $usuario->name],);
                        
        //                 return redirect()->back()->with('La contraseña se actualizo correctamente');
        //             }else{
        //                 return redirect()->back()->with('La contraseña debe ser mayor a 7 caracteres');
        //             }
        //         }
        //     }
        // }


    public function destroy($id)
    {
        $user = Auth::user();
        $user = User::findOrFail($id);
        $user->delete($id);
        return redirect()->route('/login')->with("El ususario se elimino correctamente");
    }
}
