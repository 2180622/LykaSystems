@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Lista de pagamentos')

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
        <div class="title row">
            <div class="col-md-6">
                <h6>Listagem de pagamentos gerais</h6>
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
                        <p class="number">{{$valorTotalPendente}}</p>
                        <p class="word">pagamentos pendentes</p>
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
                        <p class="number" style="color:#47BC00;">{{$valorTotalPago}}</p>
                        <p class="word">pagamentos efectuados</p>
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
                        <p class="number" style="color:#FF3D00;">{{$valorTotalDivida}}</p>
                        <p class="word">pagamentos em dívida</p>
                    </div>
                </div>
            </div>
        </div>
        <br>

        @if (count($responsabilidades))
        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="filter-icon-div" class="ml-auto" onclick="showCloseIcon()" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <ion-icon id="icon-funnel" name="funnel" title="Filtragem"></ion-icon>
                    </div>
                    <div id="close-icon-div" class="ml-auto" onclick="showFunnelIcon()" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <ion-icon id="icon-close" name="close" title="Filtragem"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="filters-div collapse" id="collapseExample">
                        <div class="payment-card shadow-sm">
                            <div id="div-options">
                                <div class="row">
                                    <p>Secção de filtragem &nbsp;</p>
                                    <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top"
                                      title="Nesta secção pode filtrar as suas pesquisas mediante a sua vontade e necessidade. Apenas pode fazer a pesquisa usando um elemento e a escolha de um intervalo de datas.">
                                        <span>
                                            ?
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <form action="{{route('payments.search')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="estudante">Estudantes</label>
                                            <br>
                                            <select name="estudante" id="estudantes" onchange="selected()">
                                                <option selected disabled hidden class="text-truncate" value="defeito">Selecionar estudante</option>
                                                <option class="text-truncate" value="todos">(Todos)</option>
                                                @foreach ($estudantes as $estudante)
                                                <option class="text-truncate" value="{{$estudante->idCliente}}">{{$estudante->nome.' '.$estudante->apelido}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="agente">Agentes</label>
                                            <br>
                                            <select name="agente" id="agentes" onchange="selected()">
                                                <option selected disabled hidden class="text-truncate" value="defeito">Selecionar agente</option>
                                                <option class="text-truncate" value="todos">(Todos)</option>
                                                @foreach ($agentes as $agente)
                                                <option class="text-truncate" value="{{$agente->idAgente}}">{{$agente->nome.' '.$agente->apelido}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="universidade">Universidades</label>
                                            <br>
                                            <select name="universidade" id="universidades" onchange="selected()">
                                                <option selected disabled hidden class="text-truncate" value="defeito">Selecionar universidade</option>
                                                <option class="text-truncate" value="todos">(Todas)</option>
                                                @foreach ($universidades as $universidade)
                                                <option class="text-truncate" value="{{$universidade->idUniversidade}}">{{$universidade->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="fornecedor">Fornecedores</label>
                                            <br>
                                            <select name="fornecedor" id="fornecedores" onchange="selected()">
                                                <option selected disabled hidden class="text-truncate" value="defeito">Selecionar fornecedor</option>
                                                <option class="text-truncate" value="todos">(Todos)</option>
                                                @foreach ($fornecedores as $fornecedor)
                                                <option class="text-truncate" value="{{$fornecedor->idFornecedor}}">{{$fornecedor->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="dataInicio">De (Data de início)</label>
                                            <br>
                                            <input type="date" name="dataInicio">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="dataFim">Até (Data de fim)</label>
                                            <br>
                                            <input type="date" name="dataFim">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row mt-3">
                                        <div class="col text-right">
                                            <button type="submit" name="button" id="searchButton">filtrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="container">
            @if (count($responsabilidades))
            @foreach ($responsabilidades as $responsabilidade)
            <?php
              if ($responsabilidade->valorCliente == null) {
                $infocliente = 'N/A';
              }else {
                $valorcliente = number_format((float)$responsabilidade->valorCliente, 2, ',', '').'€';
                $datacliente = date('d/m/Y', strtotime($responsabilidade->dataVencimentoCliente));
                $arraycliente = array("valor" => $valorcliente, "data" => $datacliente);
                $infocliente = json_encode($arraycliente);
              }
              if ($responsabilidade->valorAgente == null) {
                $valorAgente = 'N/A';
              }else {
                $valorAgente = number_format((float)$responsabilidade->valorAgente, 2, ',', '').'€';
              }

              if ($responsabilidade->valorSubAgente == null) {
                $valorSubAgente = 'N/A';
              }else {
                $valorSubAgente = number_format((float)$responsabilidade->valorSubAgente, 2, ',', '').'€';
              }

              if ($responsabilidade->valorUniversidade1 == null) {
                $valorUniversidade1 = 'N/A';
              }else {
                $valorUniversidade1 = number_format((float)$responsabilidade->valorUniversidade1, 2, ',', '').'€';
              }

              if ($responsabilidade->valorUniversidade2 == null) {
                $valorUniversidade2 = 'N/A';
              }else {
                $valorUniversidade2 = number_format((float)$responsabilidade->valorUniversidade2, 2, ',', '').'€';
              }
              ?>


            <a href="#" data-toggle="modal" data-target="#modal" data-id="{{$responsabilidade->idResponsabilidade}}" data-fase="{{$responsabilidade->fase->descricao}}" data-infocliente="{{$infocliente}}" data-valoragente="{{$valorAgente}}"
              data-valorsubagente="{{$valorSubAgente}}" data-valoruni1="{{$valorUniversidade1}}" data-valoruni2="{{$valorUniversidade2}}"
              data-nome="{{$responsabilidade->cliente->nome.' '.$responsabilidade->cliente->apelido}}">
                <div class="row charge-div">
                    <div class="col-md-1 align-self-center">
                        <div class="white-circle">
                            <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                        </div>
                    </div>
                    <div class="col-md-3 text-truncate align-self-center ml-4">
                        <p class="text-truncate" title="{{$responsabilidade->cliente->nome.' '.$responsabilidade->cliente->apelido}}">
                            {{$responsabilidade->cliente->nome.' '.$responsabilidade->cliente->apelido}}</p>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <p class="text-truncate" title="{{$responsabilidade->fase->descricao}}">{{$responsabilidade->fase->descricao}}</p>
                    </div>
                    <div class="col-md-2 text-truncate align-self-center ml-auto">
                        <p class="text-truncate"><?php
                          $valorTotal = $responsabilidade->valorCliente + $responsabilidade->valorAgente + $responsabilidade->valorSubAgente + $responsabilidade->valorUniversidade1 + $responsabilidade->valorUniversidade2;
                          echo $valorTotal = number_format((float) $valorTotal,2 ,',' ,'').'€';
                        ?></p>
                    </div>
                    <div class="col-md-2 text-truncate align-self-center ml-auto">
                        <p class="text-truncate" @if($responsabilidade->estado == 'Pago') style="color:#47BC00;" @elseif($responsabilidade->estado == 'Dívida') style="color:#FF3D00;" @endif>
                                    @php
                                    switch ($responsabilidade->estado) {
                                    case 'Pendente':
                                    printf('Pendente');
                                    break;

                                    case 'Pago':
                                    printf('Pago');
                                    break;

                                    case 'Dívida':
                                    printf('Dívida');
                                    break;
                                    }
                                    @endphp
                        </p>
                    </div>
                </div>
            </a>
            @endforeach
            @else
            <div class="row" style="padding: 0px 18px;">
                <div class="container no-data-div text-center mt-3">
                    <p style="color:#252525;">Não existem pagamentos registados.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <form method="post">
                @csrf
                <div class="modal-footer">
                    <a id="a-close-modal" class="mr-4" data-dismiss="modal">Fechar</a>
                    <button id="submit-button" type="submit" class="btn">Registar pagamento</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script src="{{asset('/js/payments.js')}}"></script>
@endsection
@endsection
