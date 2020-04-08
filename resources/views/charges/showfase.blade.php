@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Lista de cobranças')

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
            <h6>Secção de cobrança - {{$product->cliente->nome.' '.$product->cliente->apelido}} ({{$fase->descricao}})</h6>
        </div>
        <br>
        <div class="payment-card shadow-sm">
            <p>VALOR A COBRAR:</p>
            <p>&nbsp;{{($fase->valorFase)}}€</p>
            <br><br>
            @php
            $responsabilidade = $responsabilidades[0];
            @endphp
            <form action="{{route('payments.update', $responsabilidade)}}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-4">
                        <label for="valorPago">Valor cobrado</label>
                        <br>
                        <input type="text" name="valorPago">
                    </div>
                    <div class="col-md-4">
                        <label for="paymentType">Tipos de pagamento</label>
                        <br>
                        <select name="paymentType">
                            <option>Multibanco</option>
                            <option>Paypal</option>
                            <option>Outro</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="dataPagamento">Data de pagamento</label>
                        <br>
                        <input type="text" name="dataPagamento">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="valorUni">Valor a pagar a Universidade</label>
                        <br>
                        <select name="valorUni">
                          <option value="">Pago</option>
                          <option value="">Pendente</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="valorAgente">Valor a pagar ao Agente</label>
                        <br>
                        <input type="text" name="valorAgente" placeholder="{{$responsabilidades[0]->valorAgente}}€">
                    </div>
                    <div class="col-md-4">
                        <label for="valorSubagente">Valor a pagar ao SubAgente</label>
                        <br>
                        <input type="text" name="valorSubagente" placeholder="{{$responsabilidades[0]->valorSubAgente}}€">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col">
                        <label for="valorSubagente">Observações</label>
                        <br>
                        <textarea name="obsersacoes" rows="5"></textarea>
                    </div>
                </div>
        </div>
        <div class="form-group text-right">
            <br>
            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">confirmar cobrança</button>
            <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
        </div>
        </form>
        <br>
    </div>
</div>

@endsection
