@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
        <div class="container rounded bg-white mb-5">
                <div class="row">
                        <div class="col-md-5 border-right mx-auto">
                                @if(Session::has('failed'))
                                <p class="text-center alert alert-danger">{{ Session::get('failed')}}</p>
                                @endif
                                @if(Session::has('success'))
                                <p class="text-center alert alert-success">{{ Session::get('success')}}</p>
                                @endif
                                <form action="{{ route('edit.profile',Auth::user()->id) }}" method="post">
                                        @csrf

                                        {{-- <h4 class="text-right">Bienvenido {{Auth::user()->nombre}}
                                        </h4> --}}
                                        <label class="text-right h3"
                                                style="color:#000000; font-size:25px; font-weight:600; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
                                                Tu Perfil
                                        </label>
                                        <br>
                                        <label class="text-right" style="color: #323232">Aquí podrás ver y editar los
                                                datos de tu
                                                perfil</label>
                                        <div class="row mt-4">
                                                <div class="col-md-12"><label class="labels">Nombre</label>
                                                        <input id="name" type="text" class="form-control"
                                                                placeholder="Nombre" required name="name"
                                                                value="{{Auth::user()->name}}">
                                                </div>
                                                @error('name')
                                                <div class="alert alert-danger text-center mt-2"
                                                        style="width: 100%; color:rgb(0, 0, 0);">
                                                        ERROR: "NOMBRE" necesario </div>
                                                @enderror
                                        </div>
                                        <div class="row mt-1">
                                                <div class="col-md-12 mt-1"><label class="labels">Correo
                                                                Electrónico</label>
                                                        <input type="email" class="form-control" name="email"
                                                                placeholder="" required value="{{Auth::user()->email}}">
                                                        @error('email')
                                                        <div class="alert alert-danger  text-center mt-2"
                                                                style="width: 100%; color:rgb(0, 0, 0);">
                                                                Campo "CORREO ELECTRÓNICO" necesario </div>
                                                        @enderror
                                                </div>

                                                <div class="col-md-12 mt-1"><label class="labels">Numero de
                                                                telefono</label><input type="text" class="form-control"
                                                                name="telephone" placeholder="" required
                                                                value="{{Auth::user()->telephone}}">
                                                        {{-- @error('telephone')
                                                        <div class="alert alert-danger  text-center mt-2"
                                                                style="width: 100%; color:rgb(0, 0, 0);">
                                                                Campo "TELEFONO" necesario </div>
                                                        @enderror --}}
                                                </div>

                                                <div class="col-md-12 mt-1"><label class="labels">Contraseña
                                                                Actual</label><input type="password"
                                                                class="form-control" name="oldPassword"
                                                                placeholder="Contraseña Actual" required value="">
                                                </div>

                                                <div class="col-md-12 mt-1"><label class="labels">Nueva
                                                                Contraseña</label><input type="password"
                                                                class="form-control" name="password"
                                                                placeholder="Escribe tu nueva contraseña" value="">

                                                </div>
                                                <div class="col-md-12 mt-1"><label class="labels">Confirmar
                                                                Contraseña</label><input type="password"
                                                                class="form-control" name="confirmedPassword"
                                                                placeholder="Confirmar tu nueva contraseña" value="">
                                                                @error('password')
                                                                <p class="alert alert-danger mt-2">Las contraseñas no coinciden</p>
                                                        @enderror
                                                </div>
                                                <div class="col-md-12 mt-1"><label
                                                                class="labels">Nacionalidad</label><input type="text"
                                                                class="form-control" name="nationality" placeholder=""
                                                                required value="{{Auth::user()->nationality}}">
                                                        @error('nationality')
                                                        <div class="alert alert-danger  text-center mt-2"
                                                                style="width: 100%; color:rgb(0, 0, 0);">
                                                                Campo "NACIONALIDAD" necesario </div>
                                                        @enderror
                                                </div>
                                                <div class="col-md-12 mt-1"><label class="labels">address</label><input
                                                                type="text" class="form-control" name="address" required
                                                                placeholder="" value="{{Auth::user()->address}}">
                                                        @error('address')
                                                        <div class="alert alert-danger  text-center mt-2"
                                                                style="width: 100%; color:rgb(0, 0, 0);">
                                                                Campo "DIRECCIÓN" necesario </div>
                                                        @enderror
                                                </div>


                                                {{-- <div class="col-md-12"><label class="labels">Address Line
                                                                1</label><input type="text" class="form-control"
                                                                placeholder="enter address line 1" value="">
                                                </div>
                                                <div class="col-md-12"><label class="labels">Address Line
                                                                2</label><input type="text" class="form-control"
                                                                placeholder="enter address line 2" value="">
                                                </div>
                                                <div class="col-md-12"><label class="labels">Postcode</label><input
                                                                type="text" class="form-control"
                                                                placeholder="enter address line 2" value="">
                                                </div>
                                                <div class="col-md-12"><label class="labels">State</label><input
                                                                type="text" class="form-control"
                                                                placeholder="enter address line 2" value="">
                                                </div>
                                                <div class="col-md-12"><label class="labels">Area</label><input
                                                                type="text" class="form-control"
                                                                placeholder="enter address line 2" value="">
                                                </div>
                                                <div class="col-md-12"><label class="labels">Email
                                                                ID</label><input type="text" class="form-control"
                                                                placeholder="enter email id" value=""></div>
                                                <div class="col-md-12"><label class="labels">Education</label><input
                                                                type="text" class="form-control" placeholder="education"
                                                                value=""></div> --}}
                                        </div>
                                        <div class="mt-4 text-center"><button type="submit"
                                                        class="btn btn-primary profile-button"
                                                        style="background-color: #1cc88a; color:white;width:60%">Guardar
                                                        Cambios</button></div>



                                </form>
                                <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <div class="mt-2 text-center"><button class="btn btn-primary profile-button"
                                                        type="submit"
                                                        style="background-color: #858585; color:white; width:60%">&nbsp;&nbsp;&nbsp;Cerrar
                                                        Sesión
                                                        &nbsp;&nbsp;&nbsp;</button></div>
                                </form>
                                <form action="{{ route('delete.profile',Auth::user()->id)}}" method="post">
                                        @csrf
                                        <div class="mt-2 text-center"><button class="btn btn-primary profile-button"
                                                        type="submit"
                                                        style="background-color: #ff3737; color:white; width:60%">&nbsp;&nbsp;Elminar
                                                        Cuenta&nbsp;&nbsp;</button></div>
                                </form>
                        </div>
                </div>
        </div>
</div>
@include('layouts.footer')
@endsection