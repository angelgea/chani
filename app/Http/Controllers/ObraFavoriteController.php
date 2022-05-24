<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ObraFavoriteController extends Controller
{
    public function index()
    {
        $obrasIds = DB::table('favorite_obra')
                ->where('user_id', Auth::id())
                ->get(['obra_id']);
                
        $obrasIds = $obrasIds->pluck('obra_id')->toArray();

        $obras = Obra::whereIn('id', $obrasIds)->get();
        
        $styles = Style::all(['id', 'name']);

        return view('obras.favorite', [
            'obras' => $obras,
            'styles' => $styles
        ]);
    }

    public function store($id)
    {
        $obra = Obra::findOrFail($id);
        $userId = request('user_id')[0];

        DB::table('favorite_obra')
            ->insert([
                'obra_id' => $id,
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
        return response()->json([
            'message' => 'You liked this obra!'
        ], 201);
    }

    public function destroy($id)
    {
        $obra = Obra::findOrFail($id);
        $userId = request('user_id')[0];

        DB::table('favorite_obra')
            ->where('obra_id', $id)
            ->where('user_id', $userId)
            ->delete();
            
        return response()->json([
            'message' => 'You unliked this obra!'
        ], 201);
    }
}

