@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    <div class="col-md-5 mx-auto">
        <form action="{{ route('admin.obra.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="p-3 py-3">
                <div class="d-flex justify-content-between">
                    {{-- <h4 class="text-right">Bienvenido {{Auth::user()->nombre}}</h4> --}}
                    <h4 class="text-right h3">Añadir una nueva Obra</h4>

                </div>
                <div class="row mt-1">
                    <div class="col-md-12"><label class="labels">Nombre</label>
                        <input type="text" class="form-control" name="name" placeholder="Nombre" value="">
                        @error('name')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);"> Campo
                            "NOMBRE" incompleto o incorrecto </div>
                        @enderror
                    </div>


                    <div class="col-md-12 mt-1"><label class="labels">Artista</label>
                        <select class="form-control" name="user_id" placeholder="Artistas" value="">
                            @foreach($artists as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);"> Campo
                            "ARTISTA" incompleto o incorrecto </div>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-1"><label class="labels">Descripción</label>
                        <input type="text" class="form-control" name="description" placeholder="Descripción" value="">
                        @error('description')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);"> Campo
                            "DESCRIPCIÓN" incompleto o incorrecto </div>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-1"><label class="labels">Estilo</label><select class="form-control"
                            name="style_id" placeholder="Estilo" value="">
                            @foreach($styles as $style)
                            <option value="{{ $style->id }}">{{ $style->name }}</option>
                            @endforeach
                        </select>
                        @error('style_id')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);"> Campo
                            "ESTILO" incompleto o incorrecto </div>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-1"><label class="labels">Precio</label><input type="number"
                            class="form-control" name="price" placeholder="Precio" value="">
                            @error('price')
                            <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);"> Campo
                                "PRECIO" incompleto o incorrecto </div>
                            @enderror
                    </div>

                    <div class="col-md-12 mt-1"><label class="labels">Fecha</label><input type="date"
                            class="form-control" name="date" placeholder="Fecha" value="">
                            @error('date')
                            <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);"> Campo
                                "FECHA" incompleto o incorrecto </div>
                            @enderror
                    </div>

                    <div class="col-md-12 mt-1"><label class="labels">Estado</label><select class="form-control"
                            name="status_id" placeholder="Estado" value="">
                            @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                        @error('status_id')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);"> Campo
                            "ESTADO" incompleto o incorrecto </div>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-1"><label class="labels">Imagen</label><input type="file"
                            class="form-control" name="image_path" placeholder="Imagen" value="">
                            @error('image_path')
                            <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);"> Campo
                                "IMAGEN" incompleto o incorrecto </div>
                            @enderror
                    </div>
                </div>
                <div class="mt-4 text-center"><button type="submit" class="btn btn-primary profile-button"
                        style="background-color: #1cc88a; color:white; width:100%; font-size:18px">Añadir
                        Obra</button></div>
            </div>
        </form>
    </div>
</div>
@endsection