@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    <div class="col-md-5 mx-auto">
        <form action="{{ route('admin.obra.style.store') }}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="p-3 py-3">
                <div class="d-flex justify-content-between">
                    {{-- <h4 class="text-right">Bienvenido {{Auth::user()->nombre}}</h4> --}}
                    <h4 class="text-right h3">Añadir un nuevo Estilo</h4>

                    {{-- @if($errors->any())
                    <div class="alert ">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif --}}
                </div>
                <div class="row mt-1">
                    <div class="col-md-12"><label class="labels">Nombre</label>
                        <input type="text" class="form-control" name="name" placeholder="Nombre" value="">
                        @error('name')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                            ERROR: campo "NOMBRE" incompleto o incorrecto</div>
                        @enderror
                    </div>
                    <div class="col-md-12"><label class="labels">Nombre</label>
                        <input type="file" class="form-control" name="image_path" placeholder="Nombre" value="">
                        @error('image_path')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                            ERROR: campo "IMAGEN" necesario o incorrecto</div>
                        @enderror
                    </div>
                </div>
                <div class="mt-4 text-center"><button type="submit" class="btn btn-primary profile-button"
                        style="background-color: #1cc88a; color:white; width:100%; font-size:18px">Añadir
                        Estilo</button></div>
            </div>
        </form>
    </div>
</div>
@endsection