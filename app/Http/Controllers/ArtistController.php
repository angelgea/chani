<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtistController extends Controller
{
    public function show($id)
    {
        $artist = User::findOrFail($id);
        $obras = Obra::where('user_id', $id)->get();
        $comments = DB::table('user_profile_comments')
                        ->where('user_id', $id)
                        ->get();

        return view('public.artist_profile', [
            'artist' => $artist,
            'obras' => $obras,
            'comments' => $comments
        ]);
    }
}
