@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    <div class="col-md-5 mx-auto">
        <form action="{{ route('admin.user.store') }}" method="post">
            @csrf
            <div class="p-3 py-3">
                <div class="d-flex justify-content-between">
                    {{-- <h4 class="text-right">Bienvenido {{Auth::user()->nombre}}</h4> --}}
                    <h4 class="text-right h3">Añadir un nuevo Usuario</h4>

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
                        <div class="alert alert-danger text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                            ERROR: "NOMBRE" necesario </div>
                        @enderror
                    </div>


                    <div class="col-md-12 mt-1"><label class="labels">Correo Electrónico</label>
                        <input type="text" class="form-control" name="email" placeholder="Correo Electronico" value="">
                        @error('email')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                            Campo "CORREO ELECTRÓNICO" necesario </div>
                        @enderror
                    </div>


                    <div class="col-md-12 mt-1"><label class="labels">Contraseña</label>
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" value="">
                        @error('password')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                            Campo "CONTRASEÑA" necesario </div>
                        @enderror
                    </div>


                    <div class="col-md-12 mt-1"><label class="labels">Telefono</label><input type="number"
                            class="form-control" name="telephone" placeholder="Numero de telefono" value="">
                        @error('telephone')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                            Campo "TELEFONO" necesario </div>
                        @enderror
                    </div>


                    <div class="col-md-12 mt-1"><label class="labels">Dirección</label><input type="text"
                            class="form-control" name="address" placeholder="C/ Ejemplo, 1ºD, 8" value="">
                        @error('address')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                            Campo "DIRECCIÓN" necesario </div>
                        @enderror
                    </div>


                    <div class="col-md-12 mt-1"><label class="labels">Nacionalidad</label><input type="text"
                            class="form-control" name="nationality" placeholder="Nacionalidad" value="">
                        @error('nationality')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);">
                            Campo "NACIONALIDAD" necesario </div>
                        @enderror
                    </div>


                    <div class="col-md-12 mt-1"><label class="labels">Rol</label>
                        <select class="form-control" name="role_id" placeholder="Rol" value="">
                            @foreach($roles as $role)
                            <option name="role_id" value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <div class="alert alert-danger  text-center mt-2" style="width: 100%; color:rgb(0, 0, 0);"> Campo
                            "ROL" necesario </div>
                        @enderror
                    </div>

                </div>
                <div class="mt-4 text-center"><button type="submit" class="btn btn-primary profile-button"
                        style="background-color: #1cc88a; color:white; width:100%; font-size:18px">Añadir
                        Usuario</button></div>
            </div>
        </form>
    </div>
</div>
@endsection