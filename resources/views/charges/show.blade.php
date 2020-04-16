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
            <h6>Secção de cobrança - {{$product->cliente->nome.' '.$product->cliente->apelido}}</h6>
        </div>
        <br>
        @foreach ($fases as $fase)
        <div class="container">
            @if (count($fase->DocTransacao))
            @foreach ($fase->DocTransacao as $paymentProof)
            @if ($paymentProof->valorRecebido != null)
            <a href="/charges/{{$product->idProduto}}/{{$fase->idFase}}/{{$paymentProof->idDocTransacao}}/edit">
                @else
                <a href="/charges/{{$product->idProduto}}/{{$fase->idFase}}">
                    @endif
                    @endforeach
                    @else
                    <a href="/charges/{{$product->idProduto}}/{{$fase->idFase}}">
                        @endif
                        <div class="row charge-div">
                            <div class="col-md-1 align-self-center">
                                <div class="white-circle">
                                    <ion-icon name="{{$fase->icon}}" id="icon"></ion-icon>
                                </div>
                            </div>
                            <div class="col-md-3 text-truncate align-self-center ml-4">
                                <p>{{$fase->descricao}}</p>
                            </div>
                            <div class="col-md-2 text-truncate align-self-center">
                                <p @if (count($fase->DocTransacao))
                                @foreach ($fase->DocTransacao as $paymentProof)
                                @if ($fase->valorFase > $paymentProof->valorRecebido)
                                style="color:#FF3D00;"
                                @elseif ($fase->valorFase == $paymentProof->valorRecebido)
                                style="color:#47BC00;"
                                @else
                                style="color:#FF3D00;"
                                @endif
                                @endforeach
                                @endif
                                >
                                @if (count($fase->DocTransacao))
                                  @foreach ($fase->DocTransacao as $paymentProof)
                                    @if ($paymentProof->valorRecebido != null && $fase->verificacaoPago == 0)
                                      {{number_format((float) $valorTotal = $paymentProof->valorRecebido - $fase->valorFase, 2, ',', '')}}€
                                    @else
                                      {{number_format((float)$fase->valorFase, 2, ',', '')}}€
                                    @endif
                                  @endforeach
                                @else
                                  {{number_format((float)$fase->valorFase, 2, ',', '')}}€
                                @endif
                                </p>
                            </div>
                            <div class="col-md-2 text-truncate align-self-center ml-auto">
                              <?php
                                $currentdate = date_create(date('d-m-Y'));
                                $paymentdate = date_create(date('d-m-Y', strtotime($fase->dataVencimento)));
                                $datediff = (date_diff($currentdate,$paymentdate))->days;
                              ?>
                                <p @if ($datediff <= 7 && $fase->verificacaoPago == 0) style="color:#FF3D00;" @endif>
                                  <?=date('d/m/Y', strtotime($fase->dataVencimento))?>
                                </p>
                            </div>
                            <div class="col-md-2 text-truncate align-self-center ml-auto">
                                <p>
                                    @if (count($fase->DocTransacao))
                                    @foreach ($fase->DocTransacao as $paymentProof)
                                    @if ($fase->valorFase > $paymentProof->valorRecebido)
                                    Dívida
                                    @elseif ($fase->valorFase < $paymentProof->valorRecebido)
                                        Crédito
                                        @else
                                        Pago
                                        @endif
                                        @endforeach
                                        @else
                                        Pendente
                                        @endif
                                </p>
                            </div>
                        </div>
                    </a>
        </div>
        @endforeach
    </div>
</div>
@section('scripts')
<script src="{{asset('/js/charges.js')}}"></script>
@endsection
@endsection
