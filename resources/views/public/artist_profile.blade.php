@extends('layouts.app')
@section('content')
<div class="container">
    <div class="text-center mt-5"
        style="font-size:30px; font-weight:600; font-family:Helvetica Neue,Helvetica,Arial,sans-serif; "> Obras de {{
        $artist->name}}</div>

    @forelse($obras as $obra)
    <div class="col-md-3 mb-4 mt-5">
        <div class="card" style="border: none">
            <img style="border: solid 4px black" class="card-img-top mb-2"
                src="{{ url('storage/images/' . $obra->image_path) }}" alt="">
            <div class="card-body px-3 py-3">
                <div class="card-text" style="font-size: 23px; font-weight:600; text-aling:justify">{{ $obra->name }}
                    @if($obra->markedAsFavoriteByUser->whereIn('id', [Auth::id()])->pluck('id')->toArray())
                    <button id="{{ $obra->id }}" type="button" class="dislike"
                        style="color:#1cc88a; border:none; background-color:white;font-size:25px;" class="text-right">
                        <i class="fa-solid fa-heart"></i>
                    </button>
                    @else
                    <button id="{{ $obra->id }}" class="like" type="button"
                        style="color:#1cc88a; border:none; background-color:white;font-size:25px;" class="text-right">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                    @endif
                </div>
                <p class="card-text h5 mt-2 mb-3" style="color: #5c5c5c; "> {{ $obra->description }}</p>
                <p class="card-text h5" style="color: #5c5c5c"> {{ $obra->style->name }}</p>
                <p class="card-text h5 mt-2" style="color: #5c5c5c"> {{ $obra->date }}</p>
                <p class="card-text h5 mt-2" style="color: #000000"> <b>{{ $obra->price }} € </b></p>
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
    <p class="mt-4 text-center" style="font-size:17px">Lo sentimos, este artista no tiene ninguna obra disponible en
        estos momentos.
        <br>
        <a class="btn btn-lg btn-block mt-4 mb-5"
            style="color: rgb(255, 255, 255); background-color: #1cc88a; width:50%" href="{{ route('home') }}"> Explorar
            otros Artistas</a>
    </p>
    @endforelse

    <hr class="mt-5" style="color: #1cc88a; width:30%; border:solid 2px;">

    @if(Session::has('status'))
    <p class="alert alert-primary text-center mt-3">{{ Session::get('status') }}</p>
    @endif

    <div class="mt-5">
        <h3 style="font-weight:600"><i class="fa-solid fa-comments" style="color:#1cc88a"></i> Comentarios:</h3>
        @forelse($comments as $comment)
        <div class="card mt-3">
            <div class="card-body">
                <div class="card-text"><b style="font-size: 16px">{{ App\Models\User::find($comment->commentor_id)->name
                        }}</b>:
                    {{ $comment->comment }}</div>
                <div class="text-end mt-2" style="color: gray"> {{ $comment->created_at }}
                    @if(auth()->user()->role_id === Role::ADMIN || auth()->user()->id === $comment->commentor_id)
                    <br>
                    <form method="post" action="{{ route('artist.comment.delete', $comment->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-round btn-danger"><i class="fa fa-trash-can"></i></button>
                    </form>
                    @endif
                </div>
            </div>

        </div>
        @empty
        <p>Este usuario aun no ha ricibido ningun comentario</p>
        @endforelse
    </div>

    {{-- haz un comentatio! --}}
    {{-- <div class="card mt-5"> --}}
        @if(auth()->user()->role_id === Role::NORMAL)
        <form action="{{ route('artist.comment') }}" method="POST">
            @csrf

            <textarea class="card card-body mt-5 comment" style="width:100%;" class="mt-5" name="comment"
                placeholder="Haz un comentario (minimo 15 caracteres)"></textarea>

            @error('comment')
            <label class="alert alert-danger mt-3 text-center" style="width: 100%"> Comentario no enviado, vuelve a intentarlo, por favor</label>
            @enderror

            <input type="hidden" name="user_id" value="{{ $artist->id }}">
            <br>
            <button type="submit" class="btn btn-lg btn-block mb-5"
                style="color: rgb(255, 255, 255); background-color: #1cc88a; width:15%;">
                Enviar Comentario
            </button>
        </form>
        @endif

        {{--
    </div> --}}
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