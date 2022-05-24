@extends('layouts.app')
@section('content')

<div class="container">
    <div class="mt-1"
        style="color:#000000; font-size:20px; font-weight:600; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
        Tus Favoritos
    </div>
    <div class="mt-1" style="color:#7d7d7d; font-size:15px; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
        Estas son las Obras de CHANI que mas te gustan.
    </div>

    <div class="row mt-4">
        @forelse($obras as $obra)
        <div class="col-md-3 mb-4">
            <div class="card me-5">
                <img style="object-fit:cover;" class="mb-2"
                    src="{{ url('storage/images/' . $obra->image_path) }}" alt="">
                <div class="card-body px-3 py-3" style="">
                    <h2 class="card-text h3"> <b>{{ $obra->name }}</b></h2>
                    @if($obra->markedAsFavoriteByUser->whereIn('id', [Auth::id()])->pluck('id')->toArray())
                    <button id="{{ $obra->id }}" type="button" class="dislike"
                        style="color:#1cc88a; border:none; background-color:white;font-size:30px; " class="text-right">
                        <i class="fa-solid fa-heart"></i>
                    </button>
                    @else
                    <button id="{{ $obra->id }}" class="like" type="button"
                        style="color:#1cc88a; border:none; background-color:white;font-size:30px; " class="text-right">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                    @endif
                    <h3 class="card-text h5 mb-3"> <b>{{ $obra->user->name }}</b></h3>
                    <p class="card-text h5 mb-3" style="color: #5c5c5c"> {{ $obra->description }}</p>
                    <p class="card-text h5" style="color: #000000"> Estilo: <b>{{ $obra->style->name }}</b></p>
                    <p class="card-text h5 mt-2" style="color: #000000"> Fecha: <b>{{ $obra->date }}</b></p>
                    <p class="card-text h5 mt-2" style="color: #000000"> Precio: <b>{{ $obra->price }} €</b></p>
                    {{-- <p class="card-text h5 mt-3" style="color: #000000"> {{ $statuses->name }}</p> --}}
                    @if(auth()->user()->role_id === Role::NORMAL)
                    <a href="{{route('obras.obra.show', $obra->id)}}" class="btn btn-lg btn-block mt-3"
                        style="color: rgb(255, 255, 255); background-color: #1cc88a; width:100%">
                        {{ __('Comprar Obra') }} <i class="fa-solid fa-cart-shopping" style="font-size: 15px"></i>
                    </a>
                    @endif

                </div>
            </div>
        </div>
        @empty
        <div class="text-center mt-5">
            <p
                style="color:#000000; font-size:20px; font-weight:600; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
                ¡Aun no tienes ninguna Obra Favorita!
                <br>
                <a href="{{ route('home') }}" class="btn btn-lg btn-block mt-3 mb-5"
                    style="color: rgb(255, 255, 255); background-color: #1cc88a; width:50%;font-weight:600; "> 
                    EXPLORAR OBRAS <i class="fa-solid fa-arrow-right"></i>
                </a>
            </p>
        </div>
        @endforelse

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