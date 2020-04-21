@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Visualização de uma conta bancária')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/providers.css')}}" rel="stylesheet">
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
            <h6>Visualização do fornecedor: {{$provider->nome}}</h6>
        </div>
        <br>
        <div class="payment-card shadow-sm">
          <div>
            <p>Nome:{{$provider->nome}}</p>
          </div>
          <br>
          <div>
            <p>Morada: {{$provider->morada}}</p>
          </div>
          <br>
          <div>
            <p>Contacto: {{$provider->contacto}}</p>
          </div>
          <br>
          <div>
            <p>Descrição: {{$provider->descricao}}</p>
          </div>
        </div>
        <br>
    </div>
</div>

@section('scripts')
<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection

@endsection
