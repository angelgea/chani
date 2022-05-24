@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(Session::has('success'))
                <p class="alert alert-success text-center">{{Session::get('success')}}</p>
            @endif
            <div class="card">
                <div style="font-weight: 600; font-size:25px;" class="py-5 card-header h4 text-center">
                    {{__('Administrar Usuarios') }}
                    <br>
                    <br>
                    <a href="{{route('admin.user.create')}}"
                        style="background-color: #1cc88a; border: 0px solid; margin-left: 10px"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm me-2">
                        <i class="fa-solid person-circle-plus"></i> Agregar Usuario</a>

                    <a href="{{route('admin.obra')}}" style="background-color: #1cc88a; border: 0px solid;"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-paintbrush"></i> Administración de Obras</a>
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
                            <table class="table col-12 px-2 py-y aling-items-center">
                                <caption class="text-center">Lista de Usuarios</caption>
                                <thead>
                                    <tr>
                                        <td><b>Nombre</b></td>
                                        <td><b>Email</b></td>
                                        {{-- <td><b>Contraseña</b></td> --}}
                                        <td><b>Telefono</b></td>
                                        <td><b>Dirección</b></td>
                                        <td><b>Nacionalidad</b></td>
                                        <td><b>Rol</b></td>

                                    </tr>
                                </thead>
                                <tbody class="">
                                    @forelse ($users as $user)
                                    <tr class="align-middle">
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        {{-- <td>{{ $user->password }}</td> --}}
                                        <td>{{ $user->telephone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->nationality }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>
                                            <a href="{{route('admin.user.edit', $user->id)}}"
                                                class="btn btn-round btn-primary mb-2">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form method="post" action="{{ route('admin.user.delete', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-round btn-danger"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <p>No users</p>
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