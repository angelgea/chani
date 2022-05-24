@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <div class="col-md-5 border-right mx-auto">
                <form action="{{ route('admin.user.update', $user->id) }}" method="post">
                    @csrf
                    <div class="p-3 py-3">
                        <div class="d-flex justify-content-between">
                            {{-- <h4 class="text-right">Bienvenido {{Auth::user()->nombre}}</h4> --}}
                            <h4 class="text-right h3">Editar Usuario {{$user->name}}</h4>

                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12"><label class="labels">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre"
                                    value="{{ $user->name }}">
                                @error('name')
                                <div class="alert alert-danger text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);">
                                    ERROR: "NOMBRE" necesario </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-1"><label class="labels">Correo Electronico</label>
                                <input type="text" class="form-control" name="email" placeholder="Correo Electronico"
                                    value="{{ $user->email }}">
                                @error('email')
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);">
                                    Campo "CORREO ELECTRÓNICO" necesario </div>
                                @enderror
                            </div>
                            {{--<div class="col-md-12 mt-1"><label class="labels">Password</label><input
                                    class="form-control" name="password" placeholder="Contraseña"
                                    value="{{ $user->password }}">
                                @error('password')
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);">
                                    Campo "CONTRASEÑA" necesario </div>
                                @enderror
                            </div> --}}

                            <div class="col-md-12 mt-1"><label class="labels">Telefono</label><input type="number"
                                    class="form-control" name="telephone" placeholder="Precio"
                                    value="{{ $user->telephone }}">
                                @error('telephone')
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);">
                                    Campo "TELEFONO" necesario </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-1"><label class="labels">Dirección</label><input type="text"
                                    class="form-control" name="address" placeholder="Direccion"
                                    value="{{ $user->address }}">
                                @error('address')
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);">
                                    Campo "DIRECCIÓN" necesario </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-1"><label class="labels">Nacionalidad</label><input
                                    class="form-control" type="text" name="nationality" placeholder="Nacionalidad"
                                    value="{{ $user->nationality }}">
                                @error('nationality')
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);">
                                    Campo "NACIONALIDAD" necesario </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-1"><label class="labels">Rol</label><select type="text"
                                    class="form-control" name="role_id" placeholder="Rol" value="">
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <div class="alert alert-danger  text-center mt-2"
                                    style="width: 100%; color:rgb(0, 0, 0);"> Campo
                                    "ROL" necesario </div>
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