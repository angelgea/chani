<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObraStyleController extends Controller
{
    public function index($id)
    {
        $obras = Obra::where('style_id', $id)
                    ->orderBy('status_id')
                    ->paginate(8);

        $style = Style::findOrFail($id);
        $styles = Style::all(['id', 'name','image_path']);

        return view('obras.style', [
            'obras' => $obras,
            'style' => $style,
            'styles' => $styles
        ]);
    }

    public function create()
    {
        $styles = Style::all(['id', 'name','image_path']);

        return view('admins.admin_obra_style_create', [
            "styles" => $styles
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30|unique:styles',
            'image_path' => 'required|file|image'
        ]);
        
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $path = $request->file('image_path')->store('public/images');

        $uploadedFile = $request->file('image_path');

        $style = Style::create([
            'name' => $request->name,
            'image_path' => $uploadedFile->hashName()
        ]);

        return redirect()->route('admin.obra')->with('success', "Nuevo estilo '$style->name' añadido correctamente");
    }
}
