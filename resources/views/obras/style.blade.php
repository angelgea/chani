@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row imgStyle">
        <picture class="section-bg__background" data-refresh="cover">
            <img src="{{ url('storage/images/' . $style->image_path) }}" sizes="(min-width:768px) 100vw, 260px"
                class="mb-4 img-responsive" alt="">
        </picture>
        <div class="tituloStyle" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">Obras de
            {{$style->name}}</div>
    </div>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <div class="row">
        @forelse($obras as $obra)
        <div class="col-md-3 mb-4">
            <div class="card mt-2" style="border:none">
                <img class="card-img-top mb-2" style="width:250px;height:250px;object-fit:cover;display:flex;" src="{{ url('storage/images/' . $obra->image_path) }}" alt=""
                    style="border: solid 4px black">
                <div class="card-body px-3 py-3" style="font-family: Manrope,sans-serif;">
                    <h2 class="card-text h4"> <b>{{ $obra->name }}</b>
                        @if($obra->status->id === 1 && auth()->user()->role_id === Role::NORMAL)
                        @if($obra->markedAsFavoriteByUser->whereIn('id', [Auth::id()])->pluck('id')->toArray())
                        <button id="{{ $obra->id }}" type="button" class="dislike"
                            style="color:#1cc88a; border:none; background-color:white;" class="text-right">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                        @else
                        <button id="{{ $obra->id }}" class="like" type="button"
                            style="color:#1cc88a; border:none; background-color:white; " class="text-right">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                        @endif
                        @endif
                    </h2>
                    <div class="card-text h5 mb-3" style="color: #9a9a9a; font-size:15px"><a href="{{ route('artist.profile', $obra->user->id) }}" style="color: #000000; text-decoration:none; font-size:20px">{{ $obra->user->name }}</a></div>
                    {{-- <p class="card-text h5 mb-3" style="color: #5c5c5c"> {{ $obra->description }}</p> --}}
                    {{-- <p class="card-text h5" style="color: #000000"> Estilo: <b>{{ $obra->style->name }}</b></p>
                    <p class="card-text h5 mt-2" style="color: #000000"> Fecha: <b>{{ $obra->date }}</b></p> --}}
                    @if($obra->status->id === 1 && auth()->user()->role_id === Role::NORMAL)
                    <p class="card-text h5 mt-2" style="color: #000000"> <b>{{ $obra->price }} €</b></p>
                    <a href="{{route('obras.obra.show', $obra->id)}}" class="btn btn-lg btn-block mt-3"
                        style="color: rgb(255, 255, 255); background-color: #1cc88a; width:100%">
                        {{ __('Comprar Obra') }} <i class="fa-solid fa-cart-shopping" style="font-size: 15px"></i>
                    </a>
                    @elseif($obra->status->id === 2)
                    <div class="btn btn-lg btn-block mt-2" style="color: rgb(255, 255, 255);color:#000000; background-color: #ffffff; 
                        width:100%; cursor:default; font-weight:600;">
                        {{ __('Obra Vendida') }} <i class="fa-solid fa-store-slash"
                            style="font-size: 15px; color:red;"></i>
                    </div>
                    {{-- <p class="card-text h5 mt-3" style="color: #000000"> {{ $statuses->name }}</p> --}}
                    @endif
                </div>
            </div>
        </div>
        
        @empty
        <p class="mt-4 text-center" style="font-size:17px">Lo sentimos, este estilo no tiene ninguna obra disponible en estos momentos.
            <br>
            <a class="btn btn-lg btn-block mt-4 mb-5"
            style="color: rgb(255, 255, 255); background-color: #1cc88a; width:50%" href="{{ route('home') }}"> Explorar otros Estilos</a>
        </p>
        @endforelse
        <div class="d-flex justify-content-center mt-3">{{ $obras->links() }}</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    let likeButtons = document.getElementsByClassName('like');
    let dislikeButttons = document.getElementsByClassName('dislike');

    for(let i = 0; i < likeButtons.length; i++) {
        likeButtons[i].addEventListener('click', like);
    }

    for(let i = 0; i < dislikeButttons.length; i++) {
        dislikeButttons[i].addEventListener('click', dislike);
    }

    function dislike(event) {
        let laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let apiEndpoint = "{{ url('api/obras/obra/{id}/favorite/delete') }}";
        apiEndpoint = apiEndpoint.replace('{id}', this.getAttribute('id'));
        let obraId = this.getAttribute('id');
        let userId = {!! json_encode((array)auth()->user()->id) !!};

        axios({
            method: 'delete',
            url: apiEndpoint,
            data: {
                'user_id': userId
            }
        })
            .then(function(response) {
                console.log('cc', response);
                if(response.status == 201) {
                    let button = event.target.parentNode;
                    event.target.remove();
                    let icon = document.createElement("i");
                    icon.setAttribute('class', 'fa-regular fa-heart');
                    icon.setAttribute('id', obraId);
                    button.appendChild(icon);
                    button.removeEventListener('click', dislike);
                    button.addEventListener('click', like);
                }
        })
            .catch(error => console.log('Error', error));
    }
    
    function like(event) {
        let laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
       
        // axios based on Promise
        // devuelve una promesa y lo tienes que resolver

        // cuando peticion, espero la respuesta del servidor,
        // la respuesta de servidor lo encapsurammos en Promise
        // y tenemos que resolverla
        // DOM = Document Object Model, background
        // XMLHttpRequest, Promise, callback, axios
        let apiEndpoint = "{{ url('api/obras/obra/{id}/favorite') }}";
        apiEndpoint = apiEndpoint.replace('{id}', this.getAttribute('id'));
        let obraId = this.getAttribute('id');
        let userId = {!! json_encode((array)auth()->user()->id) !!};

        axios({
            method: 'post',
            url: apiEndpoint,
            data: {
                'user_id': userId
            }
        })
            .then(function(response) {
                console.log('cc', response);
                if(response.status == 201) {
                    let button = event.target.parentNode;
                    event.target.remove();
                    let icon = document.createElement("i");
                    icon.setAttribute('class', 'fa-solid fa-heart');
                    icon.setAttribute('id', obraId);
                    button.appendChild(icon);
                    button.removeEventListener('click', like);
                    button.addEventListener('click', dislike);
                }
        })
            .catch(error => console.log('Error', error));
    }
</script>
@include('layouts.footer')
@endsection