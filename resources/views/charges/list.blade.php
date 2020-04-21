@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem de cobranças')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/charges.css')}}" rel="stylesheet">
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
                <h6>Listagem de cobranças de clientes</h6>
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
        <div class="row cards-group mt-3">
            <div class="col-md-4">
                <div class="card-navigation">
                    <div class="help-button" id="tooltipClient" data-toggle="tooltip" data-placement="top" title="O número apresentado neste cartão representa o número total de fases pendentes registados no sistema.">
                        <span>
                            ?
                        </span>
                    </div>
                    <div class="info">
                        <p class="number">{{count($fasesPendentes)}}</p>
                        <p class="word">fases pendentes</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-navigation">
                    <div class="help-button" id="tooltipUni" data-toggle="tooltip" data-placement="top" title="O número apresentado neste cartão representa o número total de fases pagas registadas no sistema.">
                        <span>
                            ?
                        </span>
                    </div>
                    <div class="info">
                        <p class="number" style="color:#47BC00;">{{count($fasesPagas)}}</p>
                        <p class="word">fases pagas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-navigation">
                    <div class="help-button" id="tooltipAgent" data-toggle="tooltip" data-placement="top" title="O número apresentado neste cartão representa o número de fases em dívida registados no sistema.">
                        <span>
                            ?
                        </span>
                    </div>
                    <div class="info">
                        <p class="number" style="color:#FF3D00;">{{count($fasesDivida)}}</p>
                        <p class="word">fases em dívida</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            @if (count($products))
            @foreach ($products as $product)
            <a href="{{route('charges.show', $product)}}">
                <div class="row charge-div">
                    <div class="col-md-1 align-self-center">
                        <div class="white-circle">
                            @if($product->cliente->fotografia)
                                <img src="{{Storage::disk('public')->url('client-documents/'.$product->cliente->idCliente.$product->cliente->nome.'/').$product->cliente->fotografia}}" width="100%" class="mx-auto">
                                @elseif($product->cliente->genero == 'F')
                                    <img src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" width="100%" class="mx-auto">
                                    @else
                                    <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                                    @endif
                        </div>
                    </div>
                    <div class="col-md-3 text-truncate align-self-center ml-4">
                        <p class="text-truncate" title="{{$product->cliente->nome.' '.$product->cliente->apelido}}">{{$product->cliente->nome.' '.$product->cliente->apelido}}</p>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <p class="text-truncate" title="{{$product->descricao}}">{{$product->descricao}}</p>
                    </div>
                    <div class="col-md-2 text-truncate align-self-center ml-auto">
                        <?php
                          $valorPago = 0;
                          foreach ($product->fase as $fase) {
                            if (count($fase->DocTransacao)) {
                              foreach ($fase->DocTransacao as $document) {
                                $valorPago = $valorPago + $document->valorRecebido;
                              }
                            }
                          }

                          $valorDivida = 0;
                          foreach ($product->fase as $fase) {
                            if (count($fase->DocTransacao)) {
                              foreach ($fase->DocTransacao as $document) {
                                if ($document->valorRecebido < $fase->valorFase) {
                                  $valorDivida = $valorDivida + ($fase->valorFase - $document->valorRecebido);
                                }
                              }
                            }
                          }

                      ?>
                        @if ($valorPago != 0)
                        <p class="text-truncate" style="color:#47BC00;">{{number_format((float)$valorPago, 2, ',', '')}}€</p>
                        @endif
                        @if ($valorDivida != 0)
                        <p class="text-truncate" style="color:#FF3D00;">{{number_format((float)$valorDivida, 2, ',', '')}}€</p>
                        @endif
                        <p class="text-truncate">{{number_format((float)$product->valorTotal, 2, ',', '')}}€</p>
                    </div>
                    <div class="col-md-2 text-truncate align-self-center ml-auto">
                        <p class="text-truncate">
                            @php
                            switch ($product->estado) {
                            case 'Pendente':
                            printf('Pendente');
                            break;

                            case 'Pago':
                            printf('Pago');
                            break;

                            case 'Dívida':
                            printf('Dívida');
                            break;

                            case 'Crédito':
                            printf('Crédito');
                            break;
                            }
                            @endphp
                        </p>
                    </div>
                </div>
            </a>
            @endforeach
            @endif
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
@endsection
