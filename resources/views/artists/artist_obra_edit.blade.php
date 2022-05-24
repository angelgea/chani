@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <div class="col-md-5 border-right mx-auto">
                <form action="{{ route('artist.obra.update', $obra->id) }}" method="post">
                    @csrf
                    <div class="p-3 py-3">
                        <div class="d-flex justify-content-between">
                            {{-- <h4 class="text-right">Bienvenido {{Auth::user()->nombre}}</h4> --}}
                            <h4 class="text-right h3">Edita tu Obra</h4>

                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12"><label class="labels">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre" value="{{ $obra->name }}">
                            </div>

                            <div class="col-md-12 mt-1"><label class="labels">Descripción</label>
                                <input type="text" class="form-control" name="description" placeholder="Descripción"
                                    value="{{ $obra->description }}">
                            </div>

                            <div class="col-md-12 mt-1"><label class="labels">Estilo</label><select class="form-control"
                                    name="style_id" placeholder="Estilo" value="">
                                    @foreach($styles as $style)
                                    <option value="{{ $style->id }}">{{ $style->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 mt-1"><label class="labels">Precio</label><input type="number"
                                    class="form-control" name="price" placeholder="Precio" value="{{ $obra->price }}"></div>

                            <div class="col-md-12 mt-1"><label class="labels">Fecha</label><input type="date"
                                    class="form-control" name="date" placeholder="Fecha" value="{{ $obra->date }}"></div>

                            <div class="col-md-12 mt-1"><label class="labels">Estado</label><select class="form-control"
                                    name="status_id" placeholder="Estado" value="">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 mt-1"><label class="labels">Imagen</label><input type="file"
                                    class="form-control" name="image_path" placeholder="Imagen" value="{{ $obra->image_path }}">
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
@include('layouts.footer')
@endsection