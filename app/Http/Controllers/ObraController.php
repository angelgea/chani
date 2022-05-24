<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Role;
use App\Models\User;
use App\Models\Style;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ObraController extends Controller
{
    public function index()
    {
        $obras = Obra::where('user_id', auth()->user()->id)->get();
        $styles = Style::all(['id', 'name']);

        return view('artists.artist',  ['obras' => $obras, 'styles' => $styles]);
    }

    public function create()
    {

        // Style IDs
        // Status IDs
        $styles = Style::all(['id', 'name']);
        $statuses = Status::all(['id', 'name']);

        return view('artists.artist_obra_create', [
            'styles' => $styles,
            'statuses' => $statuses
        ]);
    }

    public function store(Request $request)
    {
        // Todo: Validation
        // Obra::create($request->validated());

        // Auth || auth()->user()->column
        // Create Obra

        /*$obra = new Obra();
        $obra->name = $request->name;
        $obra->save();*/
        // $request->validate([
        //     'name' =>'required',
        //     'description' => 'required',
        //     'date' => 'required',
        //     'price' => 'required',
        //     'style_id' => 'required',
        //     'status_id' => 'required',
        //     'user_id' => 'required',
        //     'image_path' => 'required|image'
        // ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30',
            'description' => 'required|min:2|max:350',
            'price' => 'required|integer',
            'date' => 'required|date',
            'style_id' => 'required|exists:styles,id',
            'status_id' => 'required|exists:statuses,id',
            'image_path' => 'required|file|image'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $path = $request->file('image_path')->store('public/images');

        $uploadedFile = $request->file('image_path');

        $obra = Obra::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'price' => $request->price,
            'style_id' => $request->style_id,
            'status_id' => $request->status_id,
            'user_id' => auth()->user()->id, // input name="user_id" value=user_id type="hidden"
            'image_path' => $uploadedFile->hashName()

        ]);

        $obras = Obra::where('user_id', auth()->user()->id)->get();
        $styles = Style::all(['id', 'name']);

        return view('artists.artist', [
            'obras' => $obras,
            'styles' => $styles
        ]);
    }


    public function show($id)
    {
       
        $obra = Obra::findOrFail($id);

        $obrasArtista = Obra::where('user_id', $obra->user_id)->get();

        $styles = Style::all(['id', 'name']);

        return view('obras.obra_show', [
            'obra' => $obra,
            'obrasArtista' => $obrasArtista,
            'styles' => $styles,
            'intent' => auth()->user()->createSetupIntent()
        ]);
    }

    public function edit($id)
    {

        $obra = Obra::findOrFail($id);
        $styles = Style::all(['id', 'name']);
        $statuses = Status::all(['id', 'name']);

        return view('artists.artist_obra_edit', [
            'styles' => $styles,
            'statuses' => $statuses,
            'obra' => $obra
        ]);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30',
            'description' => 'required|min:2|max:350',
            'price' => 'required|integer',
            'date' => 'required|date',
            'style_id' => 'required|exists:styles,id',
            'status_id' => 'required|exists:statuses,id',
            'image_path' => 'required|file|image'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $obra = Obra::findOrFail($id);

        $obra->name = $request->name;
        $obra->description = $request->description;
        $obra->style_id = $request->style_id;
        $obra->price = $request->price;
        $obra->status_id = $request->status_id;
        $obra->date = $request->date;
        $obra->image_path = $request->image_path;

        $obra->save();

        return redirect()->route('artist.obra', $id);
    }

    public function destroy($id)
    {

        //Obra::destroy($id);

        $obra = Obra::findOrFail($id);
        $obra->delete();

        // Flashed session(with('status', '...'));
        return redirect()->route('artist.obra', $id)->with('status', "Obra $obra->name eliminada correctamente");
    }


    public function generatePDF($id)
    {
        // TODO: validation, que exista en la tabla obra_user user_id = auth()->user()->id y obra_id = $id
        
        $obra = Obra::findOrFail($id);
        $pdf = Pdf::loadView('pdf', compact('obra'));
        $dateTime = Carbon::now()->format('Y-m-d_His');

        return $pdf->download($obra->name . '_' . $dateTime .'.pdf');
    }


    public function indexAdmin()
    {
        // ORM > Query builder > Raw sql
        // Facade, in this case, DB

        $obras = Obra::orderBy('id', 'DESC')->get();
        //$statuses = Status::all(['id', 'name']);
        $styles = Style::all(['id', 'name']);

        return view('admins.admin_obra', [
            'obras' => $obras,
            'styles' => $styles,
            // 'statuses' => $statuses,
        ]);
    }

    public function createAdmin()
    {

        // Style IDs
        // Status IDs
        $styles = Style::all(['id', 'name']);
        $statuses = Status::all(['id', 'name']);
        $artists = User::where('role_id', Role::ARTIST)->get(['id', 'name']);

        return view('admins.admin_obra_create', [
            'styles' => $styles,
            'statuses' => $statuses,
            'artists' => $artists
        ]);
    }

    public function storeAdmin(Request $request)
    {
        // Todo: Validation
        // Obra::create($request->validated());

        // Auth || auth()->user()->column
        // Create Obra

        /*$obra = new Obra();
        $obra->name = $request->name;
        $obra->save();*/

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30',
            'description' => 'required|min:2|max:350',
            'price' => 'required|integer',
            'date' => 'required|date',
            'style_id' => 'required|exists:styles,id',
            'status_id' => 'required|exists:statuses,id',
            'image_path' => 'required|file|image'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $path = $request->file('image_path')->store('public/images');

        $uploadedFile = $request->file('image_path');


        $obra = Obra::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'price' => $request->price,
            'style_id' => $request->style_id,
            'status_id' => $request->status_id,
            'user_id' => $request->user_id, // input name="user_id" value=user_id type="hidden"
            'image_path' => $uploadedFile->hashName()
        ]);

        $obras = Obra::where('user_id', auth()->user()->id)->get();

        return view('admins.admin_obra',  ['obras' => $obras]);
    }

    public function editAdmin($id)
    {

        $obra = Obra::findOrFail($id);
        $styles = Style::all(['id', 'name']);
        $statuses = Status::all(['id', 'name']);

        return view('admins.admin_obra_edit', [
            'styles' => $styles,
            'statuses' => $statuses,
            'obra' => $obra
        ]);
    }

    public function updateAdmin(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30',
            'user_id' => 'required|exists:users,id',
            'description' => 'required|min:2|max:350',
            'price' => 'required|integer',
            'date' => 'required|date',
            'style_id' => 'required|exists:styles,id',
            'status_id' => 'required|exists:statuses,id',
            'image_path' => 'file|image'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $obra = Obra::findOrFail($id);

        $obra->name = $request->name;
        $obra->user_id = $request->user_id;
        $obra->description = $request->description;
        $obra->style_id = $request->style_id;
        $obra->price = $request->price;
        $obra->status_id = $request->status_id;
        $obra->date = $request->date;

        if($request->image_path) {
            if(File::exists(public_path('storage/images/' .  $obra->image_path))) {
                File::delete(public_path('storage/images/' .  $obra->image_path));
            }

            $path = $request->file('image_path')->store('public/images');

            $uploadedFile = $request->file('image_path');
    
            $obra->image_path = $uploadedFile->hashName();
        }

        $obra->save();

        return redirect()->route('admin.obra', $id);
    }

    public function destroyAdmin($id)
    {

        //Obra::destroy($id);

        $obra = Obra::findOrFail($id);
        $obra->delete();

        // Flashed session(with('status', '...'));
        return redirect()->route('admin.obra', $id)->with('status', "Obra $obra->name eliminada correctamente");
    }
}
