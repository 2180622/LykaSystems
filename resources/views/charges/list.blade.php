@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem de cobranças')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/charges.css')}}" rel="stylesheet">
<link href="{{asset('/css/tables.css')}}" rel="stylesheet">
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
        <div class="title row">
            <div class="col-md-6">
                <h6>Listagem de cobranças</h6>
            </div>
            <div class="col-md-6" style="bottom:5px; height:32px;">
                <div class="input-group pl-0 float-right search-section" style="width:250px">
                    <input class="shadow-sm" type="text" id="customSearchBox" placeholder="Secção de procura" aria-label="Procurar">
                    <div class="search-button input-group-append">
                        <ion-icon name="search-outline" class="search-icon"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row mt-2">
            <div class="col">
                @if (count($numberProducts) == 1)
                Está registada <strong>{{count($numberProducts)}} (uma)</strong> cobrança pendente.
                @else
                Estão registadas <strong>{{count($numberProducts)}}</strong> cobranças pendentes.
                @endif
            </div>
        </div>
        <br>
        <table class="table table-striped table-bordered display" id="table" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 150px !important;">Nome</th>
                    <th>Descrição</th>
                    <th>Valor total</th>
                    <th class="text-truncate">Valor recebido</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr data-href="{{route('charges.show', $product)}}">
                    <td class="text-truncate">{{$product->cliente->nome.' '.$product->cliente->apelido}}</td>
                    <td class="text-truncate">{{$product->descricao}}</td>
                    <td class="text-truncate">{{number_format((float)$product->valorTotal, 2, ',', '')}}€</td>
                    <td class="text-truncate">50,00€</td>
                    <td class="text-truncate">Pendente</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@section('scripts')
<script src="{{asset('/js/tables.js')}}"></script>
@endsection
@endsection
