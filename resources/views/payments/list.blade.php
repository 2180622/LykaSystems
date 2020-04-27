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
                                            <label for="dataInicio">Data de início</label>
                                            <br>
                                            <input type="date" name="dataInicio">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="dataFim">Data de fim</label>
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

        <div class="container">
            @if (count($responsabilidades))
            @foreach ($responsabilidades as $responsabilidade)
            <?php
              if ($responsabilidade->valorCliente == '0.00') {
                $valorCliente = 'N/A';
              }else {
                $valorCliente = number_format((float)$responsabilidade->valorCliente, 2, ',', '').'€';
              }

              if ($responsabilidade->valorAgente == '0.00') {
                $valorAgente = 'N/A';
              }else {
                $valorAgente = number_format((float)$responsabilidade->valorAgente, 2, ',', '').'€';
              }

              if ($responsabilidade->valorSubAgente == null) {
                $valorSubAgente = 'N/A';
              }else {
                $valorSubAgente = number_format((float)$responsabilidade->valorSubAgente, 2, ',', '').'€';
              }

              if ($responsabilidade->valorUniversidade1 == '0.00') {
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


            <a href="#" data-toggle="modal" data-target="#exampleModal" data-id="{{$responsabilidade->idResponsabilidade}}" data-fase="{{$responsabilidade->fase->descricao}}" data-valorcliente="{{$valorCliente}}" data-valoragente="{{$valorAgente}}" data-valorsubagente="{{$valorSubAgente}}"
              data-valoruni1="{{$valorUniversidade1}}" data-valoruni2="{{$valorUniversidade2}}" data-nome="{{$responsabilidade->fase->produto->cliente->nome.' '.$responsabilidade->fase->produto->cliente->apelido}}">
                <div class="row charge-div">
                    <div class="col-md-1 align-self-center">
                        <div class="white-circle">
                            <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                        </div>
                    </div>
                    <div class="col-md-3 text-truncate align-self-center ml-4">
                        <p class="text-truncate" title="{{$responsabilidade->fase->produto->cliente->nome.' '.$responsabilidade->fase->produto->cliente->apelido}}">
                            {{$responsabilidade->fase->produto->cliente->nome.' '.$responsabilidade->fase->produto->cliente->apelido}}</p>
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
                        <p class="text-truncate">
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
            @endif
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-around">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Valor cliente:</label>
                        <input type="text" disabled class="form-control" id="valor-cliente">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Valor agente:</label>
                        <input type="text" disabled class="form-control" id="valor-agente">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Valor subagente:</label>
                        <input type="text" disabled class="form-control" id="valor-subagente">
                    </div>
                </div>
                <div class="row d-flex justify-content-around">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Valor universidade principal:</label>
                        <input type="text" disabled class="form-control" id="valor-uni1">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Valor universidade secundária:</label>
                        <input type="text" disabled class="form-control" id="valor-uni2">
                    </div>
                    <div class="form-group" style="opacity:0;">
                        <label class="col-form-label"></label>
                        <input type="text" disabled class="form-control">
                    </div>
                </div>
            </div>
            <form action="" method="post">
              @csrf
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Registar pagamento</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script src="{{asset('/js/payments.js')}}"></script>
@endsection
@endsection
