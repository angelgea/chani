@extends('layouts.app')
@section('content')

<div class="container">
    <div class="mt-1"
    style="color:#000000; font-size:20px; font-weight:600; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
    Tus Compras
</div>
<div class="mt-1" style="color:#7d7d7d; font-size:15px; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
    Estas son las Obras de CHANI que has adquirido.
</div>
    <div class="row mt-4">
        @forelse($purchasedObras as $obra)
        <div class="col-md-3 mb-4">
            <div class="card">
                <img class="mb-2" src="{{ url('storage/images/' . $obra->image_path) }}" alt="">
                <div class="card-body px-3 py-3" style="">
                    <h2 class="card-text h3"> <b>{{ $obra->name }}</b>
                    </h2>
                    <h3 class="card-text h5 mb-3"> <b>{{ $obra->user->name }}</b></h3>
                    <p class="card-text h5 mb-3" style="color: #5c5c5c"> {{ $obra->description }}</p>
                    {{-- <p class="card-text h5" style="color: #000000"> Estilo: <b>{{ $obra->style->name }}</b></p>
                    <p class="card-text h5 mt-2" style="color: #000000"> Fecha: <b>{{ $obra->date }}</b></p> --}}
                    <p class="card-text h5 mt-2" style="color: #000000">Precio: <b>{{ $obra->price }} €</b></p>
                    <p class="card-text h5 mt-2" style="color: #000000"> Comprada el: <b>{{ $obra->pivot->created_at
                            }}</b></p>
                    <a href="{{ route('obra.generate.pdf',$obra->id) }}" class="btn btn-lg btn-block mt-3"
                        style="color: rgb(255, 255, 255); background-color: #1cc88a; width:100%">
                        Descargar como PDF  <i class="fa-solid fa-download"></i>
                    </a>

                    {{-- <p class="card-text h5 mt-3" style="color: #000000"> {{ $statuses->name }}</p> --}}

                </div>
            </div>
        </div>
        @empty
        <p>Lo sentimos mucho no has realizado ninguna compra todavia:
            <button><a href="{{ route('home') }}">COMPRAR</a></button>
        </p>
        @endforelse

    </div>
</div>

@endsection