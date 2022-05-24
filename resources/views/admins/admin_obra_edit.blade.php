@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <div class="col-md-5 border-right mx-auto">
                <form action="{{ route('admin.obra.update', $obra->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="p-3 py-3">
                        <div class="d-flex justify-content-between">
                            {{-- <h4 class="text-right">Bienvenido {{Auth::user()->nombre}}</h4> --}}
                            <h4 class="text-right h3">Editar Obra</h4>

                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12"><label class="labels">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre"
                                    value="{{ $obra->name }}">
                                @error('name')
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);"> Campo
                                    "NOMBRE" incompleto o incorrecto </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-1"><label class="labels">Artista</label><select class="form-control"
                                    name="user_id" placeholder="Estado" value="">
                                    @foreach($artists as $artist)
                                    <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);"> Campo "ARTISTA" incompleto o incorrecto
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-1"><label class="labels">Descripción</label>
                                <input type="text" class="form-control" name="description" placeholder="Descripción"
                                    value="{{ $obra->description }}">
                                @error('description')
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);"> Campo
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
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);"> Campo
                                    "ESTILO" incompleto o incorrecto </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-1"><label class="labels">Precio</label><input type="number"
                                    class="form-control" name="price" placeholder="Precio" value="{{ $obra->price }}">
                                @error('price')
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);"> Campo
                                    "PRECIO" incompleto o incorrecto </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-1"><label class="labels">Fecha</label><input type="date"
                                    class="form-control" name="date" placeholder="Fecha" value="{{ $obra->date }}">
                                @error('date')
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);"> Campo
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
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);"> Campo "ESTADO" incompleto o incorrecto
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-1"><label class="labels">Imagen</label>
                                <input type="file"
                                    class="form-control" name="image_path" placeholder="Imagen"
                                    value="">

                                <p class="mt-3">Imagen previo</p>
                                <img src="{{ url('storage/images/' . $obra->image_path) }}" style="height:150px; width:150px" />
                                @error('image_path')
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);"> Campo
                                    "IMAGEN" incompleto o incorrecto </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4 text-center"><button type="submit" class="btn btn-primary profile-button"
                                style="background-color: #1cc88a; color:white; width:100%; font-size:18px">Guardar
                                cambios</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection