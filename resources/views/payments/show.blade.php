@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Lista de Utilizadores')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/payment.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')

<div class="container mt-2 ">

    {{-- Navegação --}}
    <div class="float-left buttons">
        <a href="javascript:history.go(-1)" title="Voltar">
            <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
        </a>
        <a href="javascript:window.history.forward();" title="Avançar">
            <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
        </a>
    </div>

    <div class="float-right">
        <a href="{{route('report')}}" class="top-button">reportar problema</a>
    </div>

    <br><br>

    <div class="cards-navigation">
        <div class="title">
            <h6>Secção de cobrança - <b>{{$product->cliente->nome.' '.$product->cliente->apelido}}</b></h6>
        </div>
        <br>
        @foreach ($fases as $fase)
        <a href="#">
            <div class="payment-card shadow-sm row">
                <p class="col-md-4">{{$fase->descricao}}</p>
                <p class="col-md-5">{{$fase->valorFase}}€</p>
                <p class="col-md-3">
                    @if ($fase->verificacaoPago == 0)
                    Pendente
                    @else
                    Pago
                    @endif
                </p>
            </div>
        </a>
        <br>
        @endforeach
    </div>
</div>

@endsection
