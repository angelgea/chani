@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="text-center mt-4 mb-4" style="font-size:20px; font-weight: 400; color:#000000;" >{{ session('success') }}</div>
        <div class="col-md-12">
            <div class="card">
                <div style="font-weight: 600; font-size:25px;" class="py-5 card-header h4 text-center">
                    {{ __('Administrar Obras') }}
                    @if(session('success'))
                    @endif
                    <br>
                    <br>
                    <a href="{{route('admin.obra.create')}}"
                        style="background-color: #1cc88a; border: 0px solid;"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm me-2">
                        <i class="fa-solid fa-plus"></i> <i class="fa-solid fa-palette"></i> Agregar Una Obra</a>
                    <a href="{{route('admin.obra.style.create')}}"
                        style="background-color: #1cc88a; border: 0px solid;"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm me-2">
                        <i class="fa-solid fa-plus"></i> <i class="fa-solid fa-palette"></i> Agregar Un Estilo</a>
                    <a href="{{route('admin.user')}}" style="background-color: #1cc88a; border: 0px solid "
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm me-2">
                        <i class="fa-solid fa-user"></i> Administración de Usuarios</a>
                </div>
                <div class="row">

                    <div class="card-body">
                        {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif --}}
                        @if($message = Session::get('UsuarioAgregado'))
                        <div class="col-12 alert alert-success alert-dismissable fade show" role="alert">
                            <span>{{$message}}</span>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table col-12 table-responsive px-2 py-y aling-items-center">
                                <caption class="text-center">Lista de Obras</caption>
                                <thead style="border-top: none">
                                    <tr>
                                        <td><b>Nombre</b></td>
                                        <td><b>Artista</b></td>
                                        <td><b>Descripción</b></td>
                                        <td><b>Precio</b></td>
                                        <td><b>Fecha</b></td>
                                        <td><b>Estilo</b></td>
                                        <td><b>Estado</b></td>
                                        <td><b>Imagen</b></td>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($obras as $obra)
                                    <tr class="align-middle">
                                        <td>{{ $obra->name }}</td>
                                        <td>{{ $obra->user->name }}</td>
                                        <td>{{ $obra->description }}</td>
                                        <td>{{ $obra->price }}</td>
                                        <td>{{ $obra->date }}</td>
                                        <td>{{ $obra->style->name }}</td>
                                        <td>{{ $obra->status->name }}</td>
                                        <td>{{ $obra->image_path }}</td>
                                        <td>
                                            <a href="{{route('admin.obra.edit', $obra->id)}}"
                                                class="btn btn-round btn-primary mb-2">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form method="post" action="{{ route('admin.obra.delete', $obra->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-round btn-danger"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <p>No obras</p>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection