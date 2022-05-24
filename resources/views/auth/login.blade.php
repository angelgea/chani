@extends('layouts.app')

@section('content')

<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{ route('login') }}" class="form-signin">
                @csrf
                <a>
                    <img class="mb-1" src="\css\img\chani.png" alt="" width="220" height="100">
                </a>
                <label class="h2 font-weight-bold mb-2 titulo">Bienvenido a Chani
                </label>

                <label class="h6 font-weight-normal mb-3">Inicia Sesión o Registrate</label>

                <label for="email" class="sr-only"> </label>
                <input class="form-control" id="email" type="email" placeholder="Correo Electronico"
                    class="wCorreo  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required
                    autocomplete="email" autofocus>


                <label for="password" class="sr-only"></label>
                <input class="form-control mt-3" id="password" type="password" placeholder="Contraseña"
                    class="wContra @error('password') is-invalid @enderror" name="password" required
                    autocomplete="current-password">

                @error('email')
                <p class="mt-2" style="color:#ef0606;">Correo Electronico o Contraseña incorrectos.</p>
                @enderror
                <div class="checkbox mt-3">
                    <label>
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                            style="color: black">
                        {{ __('Remember Me') }}
                    </label>
                </div>


                <button type="submit" class="btn btn-lg btn-block mt-3"
                    style="color: rgb(255, 255, 255); background-color: #1cc88a; width:100%">
                    {{ __('Iniciar Sesión') }}
                </button>

                <label for="registrase" class="sr-only"></label>

                <br>

                <label class="mt-3"> ¿Todavía no tienes una cuenta?</label>
                <a class="btn linkColor" href="{{ route('register') }}" style="color: #1cc88a; font-weight:600">
                    {{ __('Registrarse') }}
                </a>

                @if (Route::has('password.request'))
                <a class="btn linkColor" href="{{ route('password.request') }}" style="color: #1cc88a; font-weight:600">
                    {{ __('¿No recuerdas tu contraseña?') }}
                </a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection