@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            @if(session('status'))
            <div class="alert alert-success"> {{ session('status') }}</div>
            @endif
            <p class="h4 mt-3">Bienvenido <b>{{Auth::User()->name}}</b>, estas son tus obras publicadas:</p>
            @forelse($obras as $obra)
            <table class="table table-responsive" style="border: 1px solid black; margin-top:2rem">
                <thead>
                    <tr>
                        <th scope="col"> Nombre</th>
                        <th scope="col"> Descripcion</th>
                        <th scope="col"> Estilo</th>
                        <th scope="col"> precio</th>
                        <th scope="col"> fecha</th>
                        <th scope="col"> Estado</th>
                        <th scope="col"> Image_path</th>
                        <th scope="col"> Editar</th>
                        <th scope="col"> Eliminar</th>
                    </tr>
                </thead>
                <tbody style="cursor: pointer; align-items: center; text-align: center;">
                    <tr>
                        <td scope="row">{{ $obra->name }}</td>
                        <td scope="row">{{ $obra->description }}</td>
                        <td scope="row">{{ $obra->style->name }}</td>
                        <td scope="row">{{ $obra->price }}</td>
                        <td scope="row">{{ $obra->date }}</td>
                        <td scope="row">{{ $obra->status->name }}</td>
                        <td scope="row">{{ $obra->image_path }}</td>
                        <td scope="row">
                            <button class="btn btn-round btn-primary">
                                <a style="color: #ffffff; text-decoration:none;"
                                    href="{{ route('artist.obra.edit', $obra->id) }}">Editar Obra
                                </a>
                            </button>
                        </td>
                        <td scope="row">
                            <form method="post" action="{{ route('artist.obra.delete', $obra->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-round btn-danger"> Eliminar Obra</button>
                            </form>
                        </td>

                    </tr>
                </tbody>
            </table>
            @empty
            <p>Ninguna obra publicada!</p> <button><a href="{{ route('artist.obra.create') }}">Subir</a></button>
            @endforelse

            <label class="mt-5" for="">¿Tienes una nueva obra que publicar? No dudes en ello:</label>

            <a class="btn btn-lg btn-block mt-3 mb-5 col-12"
                style="color: #ffffff; text-decoration:none; background-color: #1cc88a; width:100%; font-size:18px"
                href="{{ route('artist.obra.create') }}">
                Publicar una nueva obra
            </a>

        </div>

    </div>
</div>
@include('layouts.footer')
@endsection