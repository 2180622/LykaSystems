@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Pagamento')

{{-- Estilos de CSS --}}
@section('styleLinks')
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

    @if (isset($cliente))
        {{-- Registar pagamento CLIENTE --}}
        @include('payments.partials.create.add-cliente');
    @elseif (isset($agentes))
        {{-- Registar pagamento AGENTE --}}
        @include('payments.partials.create.add-agente');
    @endif






</div>

<div class="custom-cm" id="contextMenu">
    <div class="custom-cm-item">
        <p onclick="getFile()">Editar</p>
    </div>
    <div class="custom-cm-item">
        <p onclick="removeFile()">Remover</p>
    </div>
    <div class="custom-cm-divider"></div>
    <div class="custom-cm-item">Cancelar</div>
</div>

@section('scripts')
<script src="{{asset('/js/payments.js')}}"></script>
@endsection
@endsection
