@extends('layouts.app')
@section('content')

<div class="container" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
    <div class="row">
        <div class="col">
            <img src="{{ url('storage/images/' . $obra->image_path) }}" alt="" style="height:530px; width:530px;">
        </div>
        <div class="col">
            <div class="obraName"> <label style="font-size:30px; font-weight:400"> {{ $obra->name}} </label>
                @if($obra->status->id === 1 && auth()->user()->role_id === Role::NORMAL)
                @if($obra->markedAsFavoriteByUser->whereIn('id', [Auth::id()])->pluck('id')->toArray())
                <button id="{{ $obra->id }}" type="button" class="dislike text-right"
                    style="font-size:30px; color:#1cc88a; border:none;  background-color:white;" class="text-right">
                    <i class="fa-solid fa-heart"></i>
                </button>
                @else
                <button id="{{ $obra->id }}" class="like" type="button"
                    style="font-size:30px; color:#1cc88a; border:none; background-color:white; " class="text-right">
                    <i class="fa-regular fa-heart"></i>
                </button>
                @endif
                @endif
            </div>
            <div class="obraArtista"><label style="font-size:20px; color:rgba(0, 0, 0, 0.67)"> por
                    <a href="{{ route('artist.profile', $obra->user->id) }}"
                        style="color: #000000; text-decoration:none">{{ $obra->user->name }}</a>,
                    {{$obra->user->nationality}}.</label></div>
            <div class="obraDescrip"><label style="font-size:15px; color:rgba(0, 0, 0, 0.67)"> {{$obra->date}} </label>
            </div>

            <div class="obraEstilo"><label style="font-size:15px; color:rgba(0, 0, 0, 0.67)"> {{$obra->style->name}}
                </label></div>
            <hr>
            <div class="obraEstilo"><label style="font-size:20px;">Precio:</label>
                <p style="color: #1cc88a; font-size:40px">{{$obra->price}}€</p>
            </div>
            <input id="card-holder-name" type="hidden" value="{{auth()->user()->name}}">

            <!-- Stripe Elements Placeholder -->
            <div class="mt-5" id="card-element"></div>
            <hr>
            <button id="card-button" class="btn btn-lg btn-block mt-3"
                style="color: rgb(255, 255, 255); background-color: #1cc88a; width:100%">
                <b>ADQUIRIR ESTÁ OBRA
                    <i class="fa-solid fa-arrow-right"></i>
                </b>
            </button>

        </div>

    </div>

    <hr class="mt-5" style="color: #1cc88a; width:30%; border:solid 2px;">
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="title-section" style="font-size: 35px; font-weight:400"><i class="fa-solid fa-comment"
                    style="color: #1cc88a"></i> <span>Sobre la obra</span></div>
            <label style=""> {{$obra->description}} </label>
        </div>
        <div class="col-md-6 text-center">

            <i class="fa-solid fa-truck mb-2" style="font-size:50px; color:#1cc88a"></i>
            <div
                style="color:#000000; font-size:14px; font-weight:600; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
                Envio rápido y seguro
            </div>

            <i class="fa-solid fa-scroll mb-2 mt-4" style="font-size:50px; color:#1cc88a"></i>
            <div
                style="color:#000000; font-size:14px; font-weight:600; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
                Trabajo original con certificado de autenticidad
            </div>
            <i class="fa-solid fa-lock mb-2 mt-4" style="font-size:50px; color:#1cc88a"></i>
            <div
                style="color:#000000; font-size:14px; font-weight:600; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
                Pagos completamente asegurados</div>

        </div>
    </div>
    <hr class="mt-5" style="color: #1cc88a; width:30%; border:solid 2px;">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="title-section" style="font-size: 35px; font-weight:400"><i
                    class="fa-solid fa-circle-chevron-down" style="color: #1cc88a"></i> <span>Otras Obras de
                    {{$obra->user->name}}</span></div>
            <div class="row">
                @forelse($obrasArtista as $obra)
                <div class="col-md-3 mb-4 mt-5">
                    <div class="card me-4" style="border: none">
                        <img style="border: solid 4px black" class="card-img-top mb-2"
                            src="{{ url('storage/images/' . $obra->image_path) }}" alt="">
                        <div class="card-body px-3 py-3" style="">
                            <h2 class="card-text h3"> <b>{{ $obra->name }}</b></h2>
                            @if($obra->markedAsFavoriteByUser->whereIn('id', [Auth::id()])->pluck('id')->toArray())
                            <button id="{{ $obra->id }}" type="button" class="dislike"
                                style="color:#1cc88a; border:none; background-color:white;font-size:30px;"
                                class="text-right">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                            @else
                            <button id="{{ $obra->id }}" class="like" type="button"
                                style="color:#1cc88a; border:none; background-color:white;font-size:30px;"
                                class="text-right">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                            @endif
                            {{-- <p class="card-text h5 mb-3" style="color: #5c5c5c"> {{ $obra->description }}</p> --}}
                            {{-- <p class="card-text h5" style="color: #000000"> Estilo: <b>{{ $obra->style->name }}</b>
                            </p> --}}
                            {{-- <p class="card-text h5 mt-2" style="color: #000000"> Fecha: <b>{{ $obra->date }}</b>
                            </p> --}}
                            <p class="card-text h5 mt-2" style="color: #000000"><b>{{ $obra->price }} €</b></p>
                            {{-- <p class="card-text h5 mt-3" style="color: #000000"> {{ $statuses->name }}</p> --}}
                            @if(auth()->user()->role_id === Role::NORMAL)
                            <a href="{{route('obras.obra.show', $obra->id)}}" class="btn btn-lg btn-block mt-3"
                                style="color: rgb(255, 255, 255); background-color: #1cc88a; width:100%">
                                {{ __('Comprar Obra') }} <i class="fa-solid fa-cart-shopping"
                                    style="font-size: 15px"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <p>Este artista no tiene ninguna obra disponible en estos momentos.
                    <a href="{{ route('home') }}"></a>
                </p>
                @endforelse
            </div>
        </div>
    </div>
</div>


{{-- <form class="formStripe" id="payment-form" method="POST" action="{{ route('obras.obra.purchase', $obra->id) }}">
    <div id="payment-element">
        <!--Stripe.js injects the Payment Element-->
    </div>
    <button class="buttonStripe" id="submit">
        <div class="spinner hidden" id="spinner"></div>
        <span id="button-text">Adquirir está obra</span>
    </button>
    <div id="payment-message" class="hidden"></div>
</form> --}}


</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('pk_test_51L02OPAlvjh4CQShGQ3bIsc8XlG6W1k9XOJPmyt3ayBF97dJhAQF7Fhh7eLW71Z26dxcgHjK72Su2CXzV084zDwi00iG2XtAb1');
 
    const elements = stripe.elements();
    const cardElement = elements.create('card');
 
    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    
    cardButton.addEventListener('click', async (e) => {
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );
    
        if (error) {
            alert('error: ', error);
            // Display "error.message" to the user...
        } else {
            const obraId = "{{ $obra->id }}";
            const userId = "{{ auth()->user()->id }}";
            alert('Verified');
            console.log(paymentMethod);
            // The card has been verified successfully...
            axios.post(`/api/obras/obra/purchase/${obraId}`, {
                'payment_method_id': paymentMethod.id,
                'user_id': userId
            })
                .then(response => {
                    console.log(response, 200)
                    alert(response.data.status)
                    redirect();
                })
                .catch(error => console.log(error, 500));

        }
});

const redirect = () => {
    window.location = "{{ url('/obra/purchase/history') }}"
}

//obras.obra.purchase
</script>

{{-- <script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe("pk_test_51L02OPAlvjh4CQShGQ3bIsc8XlG6W1k9XOJPmyt3ayBF97dJhAQF7Fhh7eLW71Z26dxcgHjK72Su2CXzV084zDwi00iG2XtAb1");

    let elements;

    initialize();

    document
        .querySelector("#payment-form")
        .addEventListener("submit", handleSubmit);    

    function initialize() {
        
        const clientSecret = "{{ $intent->client_secret }}";

        const appearance = {
            theme: 'stripe',
        };

        elements = stripe.elements({ appearance, clientSecret });

        const paymentElement = elements.create("payment");
        paymentElement.mount("#payment-element");
    }

    async function handleSubmit(e) {
        e.preventDefault();

        setLoading(true);

        const { setupIntent, error } = await stripe.confirmSetup({
            elements,
            confirmParams: {
            // Make sure to change this to your payment completion page
            return_url: "http://localhost:4242/public/checkout.html",
            },
            redirect: "if_required"
        });


        // This point will only be reached if there is an immediate error when
        // confirming the payment. Otherwise, your customer will be redirected to
        // your `return_url`. For some payment methods like iDEAL, your customer will
        // be redirected to an intermediate site first to authorize the payment, then
        // redirected to the `return_url`.
        if(error) {
            if (error.type === "card_error" || error.type === "validation_error") {
                showMessage(error.message);
            } else {
                showMessage("Ha ocurrido un error, revisa tus credenciales.");
            }
        } else {
            console.log(setupIntent, 200);
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'paymentMethod');
            hiddenInput.setAttribute('value', setupIntent.payment_method);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }    
        

        setLoading(false);

        }

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function () {
                messageContainer.classList.add("hidden");
                messageText.textContent = "";
            }, 4000);
        }

        // Show a spinner on payment submission
        function setLoading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
        }

</script> --}}
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