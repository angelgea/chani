<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    {{--
    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
</head>

<body>
    <div class="container">
        <div class="imagenPDF">
            <img src="{{ public_path() . '/css/img/chani.png' }}" width="110" height="40">
        </div>
        <div style=" margin-top:50px;">
           <div style="color:#000000; font-size:15px; font-weight:600;"> {{auth()->user()->name}}</div>
            <div style="color:#000000; font-size:15px; font-weight:400; magin-reight:70%">
                <table style="background-color: #c9c9c9">
                    <thead> Pagado </thead>
                    <tr>
                        <th scope="row">Vendido Por</th>
                        <td> CHANI SL, Zaragoza, España</td>
                        <hr>
                        <th scope="row">Fecha de envio</th>
                        {{-- <td>{{ $obra->pivot->created_at }}</td> --}}
                        <th scope="row">Total a Pagar</th>
                        <td>{{$obra->price}}</td>
                </table>
            </div>
        </div>
        <hr>
        <div style="margin-top:50px;">
            <table style="background-color: #ffffff">
                <thead>  </thead>
                <tr>
                    <th scope="row">Dirección de envio</th>
                    <td> {{auth()->user()->address}},{{auth()->user()->nationality}}</td>
                    <hr>
                    <th scope="row">Vendido por</th>
                    <td>CHANI SL, Zaragoza,Avenida Valencia, 18, España</td>
            </table>
        </div>
        <hr>
        <div style="margin-top:50px;">
            <table style="background-color: #ffffff">
                <thead> Información del pedido </thead>
                <tr>
                    <th scope="row">Fecha del pedido</th>
                    {{-- <td>{{ $obra->pivot->created_at }}</td> --}}
                    <hr>
                    <th scope="row">Número del pedido</th>
                    <td>{{DB::table('obra_user')->pluck('id')}}</td>
            </table>
        </div>
        <hr>
        <div style="margin-top:50px;">
            <table style="background-color: #ffffff">
                <thead> Información del pedido </thead>
                <tr>
                    <th scope="row">Fecha del pedido</th>
                    {{-- <td>{{ $obra->pivot->created_at }}</td> --}}
                    <th scope="row">Número del pedido</th>
                    <td>{{DB::table('obra_user')->pluck('id')}}</td>
            </table>
        </div>

        <hr>

        <div style="margin-top:50px;">
            <table style="background-color: #ffffff">
                <thead> Detalles de la obra </thead>
                <tr>
                    <th scope="row">Descripción</th>
                    <td>{{ $obra->description }}</td>
                    <th scope="row">Artista</th>
                    <td>{{ $obra->user }}</td>
                    <th scope="row">Cantidad</th>
                    <td>1</td>
                    <th scope="row">Precio</th>
                    <td>{{ $obra->price }}</td>
            </table>
        </div>

        <div style="page-break-after: always"></div>

        <img src="{{ public_path() . '/storage/images/' . $obra->image_path }}" width="200px" height="200px" />
        <div class="col">
            <div class="mb-4"
                style="color:#000000; font-size:25px; font-weight:600; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
                {{ $obra->name }} por:
                <label
                    style="color:#767676; font-size:25px; font-weight:400; font-family:Helvetica Neue, Helvetica,Arial,sans-serif;">
                    {{$obra->user->name}}
                </label>
            </div>
            <div class="mb-3"
                style="color:#000000; font-size:25px; font-weight:400; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
                {{ $obra->description }}
            </div>
            <div class="mb-3"
                style="color:#000000; font-size:25px; font-weight:400; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
                {{ $obra->price }}
            </div>
            <div class="mb-3"
                style="color:#000000; font-size:25px; font-weight:400; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
                {{ $obra->style->name }}
            </div>
        </div>
    </div>
    {{-- <p>{{ $name }}</p>
    <p>{{ $description }}</p>
    <p>{{ $price }}</p>
    <p>{{ $date }}</p>
    <p>{{ $style }}</p> --}}

    </div>


</body>

</html>