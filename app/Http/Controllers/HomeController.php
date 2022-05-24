<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Role;
use App\Models\User;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->role_id === Role::NORMAL) {
            $obras = Obra::all();
            $artists = User::where('role_id', Role::ARTIST)->get();

            return view('normal', [
                'obras' => $obras, 
                'artists' => $artists
            ]);
        } else if(auth()->user()->role_id == Role::ARTIST) {
            $obras = Obra::where('user_id', auth()->user()->id)->get();
            
            // return view ('artists.artist', [array associative] key => value ) || compact('obras')
            return view('artists.artist', [
                'obras' => $obras,
                'obras' => $obras,
            ]);
        }
        
        // TODO: Pagination
        $users = User::all();
        $obras = Obra::all();

        return view('admins.admin', [
            'users' => $users,
            'obras' => $obras
        ]);
    }

    public function indexInfo()
    {
        $styles = Style::all(['id', 'name','image_path']);
        return view('info',
        ['styles' => $styles]);
    }
}
