@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Visualização de um fornecedor')

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
        <a href="{{route('provider.edit', $provider)}}" class="top-button mr-2">Editar informação</a>
        <a href="{{route('report')}}" class="top-button">reportar problema</a>
    </div>

    <br><br>

    <div class="cards-navigation">
        <div class="title">
            <h6>Visualização do fornecedor: {{$provider->nome}}</h6>
        </div>
        <br>
        <div class="payment-card shadow-sm show-provider">
            <div>
                <p><b>Nome:</b> {{$provider->nome}}</p>
            </div>
            <br>
            <div>
                <p><b>Descrição:</b> {{$provider->descricao}}</p>
            </div>
            <br>
            <div>
                <p><b>Contacto:</b> {{$provider->contacto}}</p>
            </div>
            <br>
            <div>
                <p><b>Morada:</b> {{$provider->morada}}</p>
            </div>
            @if ($provider->observacoes != null)
            <br>
            <div>
                <p><b>Observações:</b> {{$provider->observacoes}}</p>
            </div>
            @endif
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
