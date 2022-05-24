<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make(request()->all(), [
            'comment' => 'required|min:15|max:300'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('user_profile_comments')
            ->insert([
                'user_id' => $request->user_id,
                'commentor_id' => Auth::id(),
                'comment' => $request->comment,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        
        
        return redirect()->route('artist.profile', $request->user_id)
                            ->with('success', 'Comentario publicado con éxito');
        
        
    }

    public function destroy($id)
    {
        $comment = DB::table('user_profile_comments')->where('id', $id);
        $comment->delete();
    
        return redirect()->back()->with('status', 'Comentario eliminado correctamente');
    }
}
