@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    <div class="col-md-5 mx-auto">
        <form action="{{ route('artist.obra.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="p-3 py-3">
                <div class="d-flex justify-content-between">
                    {{-- <h4 class="text-right">Bienvenido {{Auth::user()->nombre}}</h4> --}}
                    <h4 class="text-right h3">Públicar una nueva Obra</h4>

                </div>
                <div class="row mt-1">
                    <div class="col-md-12"><label class="labels">Nombre</label>
                        <input type="text" class="form-control" name="name" placeholder="Nombre" value="" required>
                        @error('name')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                            Campo "NOMBRE" incompleto o incorrecto </div>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-1"><label class="labels">Descripción</label>
                        <input type="text" class="form-control" name="description" placeholder="Descripción" value=""
                            required>
                        @error('description')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                            Campo
                            "DESCRIPCIÓN" incompleto o incorrecto </div>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-1"><label class="labels">Estilo</label><select class="form-control"
                            name="style_id" placeholder="Estilo" value="" required>
                            @foreach($styles as $style)
                            <option value="{{ $style->id }}">{{ $style->name }}</option>
                            @endforeach
                        </select>
                        @error('style')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                            Campo
                            "ESTILO" incompleto o incorrecto </div>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-1"><label class="labels">Precio</label><input type="number"
                            class="form-control" name="price" placeholder="Precio" value="" required>
                        @error('price')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                            Campo
                            "PRECIO" incompleto o incorrecto </div>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-1"><label class="labels">Fecha</label><input type="date"
                            class="form-control" name="date" placeholder="Fecha" value="" required>
                        @error('date')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                            Campo
                            "FECHA" incompleto o incorrecto </div>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-1"><label class="labels">Estado</label><select class="form-control"
                            name="status_id" placeholder="Estado" value="" required>
                            @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                            @error('status')
                            <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                                Campo
                                "ESTADO" incompleto o incorrecto </div>
                            @enderror
                        </select>
                    </div>

                    <div class="col-md-12 mt-1"><label class="labels">Imagen</label><input type="file" accept="image/*"
                            class="form-control" name="image_path" placeholder="Imagen" value="" required>
                        @error('image_path')
                        <p class="text-danger"> Solo se permiten publicar imagenes</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-4 text-center"><button type="submit" class="btn btn-primary profile-button"
                        style="background-color: #1cc88a; color:white; width:100%; font-size:18px">Publicar
                        Obra</button></div>
            </div>
        </form>
    </div>
</div>
@include('layouts.footer')
@endsection