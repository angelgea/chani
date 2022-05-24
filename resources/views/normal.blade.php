@extends('layouts.app')
@section('content')
<p class="text-center mt-3">Chani, la nueva Galería de Arte online</p>
<div class="home-titulo">¿Qué estás buscando?</div>

<div class="container home-categorias-contenedor">
    <div class="home-categorias-lista">
        {{-- MIRAR QUE BOTON --}}

        {{-- <button class="button-bubble button-bubble--left">
            <svg width="48" height="48" viewBox="12 12 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M21.2 23.4a.998.998 0 0 0 0 1.2l3 4a.999.999 0 1 0 1.6-1.199L23.25 24l2.55-3.402a.997.997 0 0 0-.2-1.399 1 1 0 0 0-1.4.2l-3 4z">
                </path>
            </svg>
        </button> --}}
        {{-- MIRAR QUE BOTON --}}
        <div class="home-categorias-lista-contenido-wrapper">
            <div class="row home-categorias-lista-contenido">
                @foreach($styles as $style)
                <div class="col-md-3 mb-4">
                    <div class="card" style="border: none">
                        <div class="card-body px-3 py-3 home-categorias-lista-item mr-5 ml-5"
                            data-category-title="{{ $style->name }}">
                            <a href="{{ route('obras.style', $style->id) }}" title="{{ $style->name }}" rel="nofollow"
                                style="font-weight: 650">
                                <div class="home-categorias-item-icon-wrapper">
                                    <picture class="section-bg__background" data-refresh="cover">
                                        {{-- <img src="{{ url('storage/images/' . $style->image_path) }}"
                                            sizes="(min-width:768px) 100vw, 260px" class="section-bg__background-img"
                                            alt=""> --}}
                                        <img src="{{ url('storage/images/' . $style->image_path) }}" alt=""
                                            style="width:280px; height:280px;">
                                    </picture>
                                </div>
                                <label for="{{ $style->name }}" class="home-categorias-texto mt-3"> {{ $style->name
                                    }}</label>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection