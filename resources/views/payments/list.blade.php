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
                        <div class="payment-card shadow-sm" style="height: 310px;">
                            <div id="div-options">
                                <div class="row">
                                    <p>Secção de filtragem &nbsp;</p>
                                    <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="Nesta secção pode filtrar as suas pesquisas mediante a sua vontade e necessidade.">
                                        <span>
                                            ?
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div id="estudantes" onclick="estudante()">
                                            <div class="box text-center">
                                                <p>Estudantes</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="agentes" onclick="agente()">
                                            <div class="box text-center">
                                                <p>Agentes</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="subagentes" onclick="subagente()">
                                            <div class="box text-center">
                                                <p>SubAgentes</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div id="universidades" onclick="universidade()">
                                            <div class="box text-center">
                                                <p>Universidades</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="fornecedores" onclick="fornecedor()">
                                            <div class="box text-center">
                                                <p>Fornecedores</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="datas" onclick="datas()">
                                            <div class="box text-center">
                                                <p>Datas</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>

                            {{-- Estudantes -> Secção de procura --}}
                            <div id="div-estudante" style="display:none;">
                                <div class="row">
                                    <p>Filtragem por Estudantes &nbsp;</p>
                                    <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="Nesta secção pode filtrar as suas pesquisas mediante a sua vontade e necessidade.">
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
                                            <select name="estudante">
                                                <option selected disabled hidden class="text-truncate" value="null">Selecionar estudante</option>
                                                <option value="all">Todos</option>
                                                @foreach ($estudantes as $estudante)
                                                <option value="{{$estudante->idCliente}}">{{$estudante->nome.' '.$estudante->apelido}}</option>
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
                                    <br><br>
                                    <div class="row">
                                        <div class="form-group text-right ml-auto" style="margin-right:15px;">
                                            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">pesquisar pagamento</button>
                                            <button type="button" class="cancel-button">Cancelar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- Agentes -> Secção de procura --}}
                            <div id="div-agente" style="display:none;">
                                <div class="row">
                                    <p>Filtragem por Agentes &nbsp;</p>
                                    <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="Nesta secção pode filtrar as suas pesquisas mediante a sua vontade e necessidade.">
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
                                            <label for="agente">Agentes</label>
                                            <br>
                                            <select name="agente">
                                                <option selected disabled hidden class="text-truncate" value="null">Selecionar agente</option>
                                                @foreach ($agentes as $agente)
                                                <option value="{{$agente->idAgente}}">{{$agente->nome.' '.$agente->apelido}}</option>
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
                                    <br><br>
                                    <div class="row">
                                        <div class="form-group text-right ml-auto" style="margin-right:15px;">
                                            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">pesquisar pagamento</button>
                                            <button type="button" class="cancel-button">Cancelar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- SubAgentes -> Secção de procura --}}
                            <div id="div-subagente" style="display:none;">
                                <div class="row">
                                    <p>Filtragem por SubAgentes &nbsp;</p>
                                    <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="Nesta secção pode filtrar as suas pesquisas mediante a sua vontade e necessidade.">
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
                                            <label for="subagente">SubAgentes</label>
                                            <br>
                                            <select name="subagente">
                                                <option selected disabled hidden class="text-truncate" value="null">Selecionar subagente</option>
                                                @foreach ($subagentes as $subagente)
                                                <option value="{{$subagente->idAgente}}">{{$subagente->nome.' '.$subagente->apelido}}</option>
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
                                    <br><br>
                                    <div class="row">
                                        <div class="form-group text-right ml-auto" style="margin-right:15px;">
                                            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">pesquisar pagamento</button>
                                            <button type="button" class="cancel-button">Cancelar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- Universidade -> Secção de procura --}}
                            <div id="div-universidade" style="display:none;">
                                <div class="row">
                                    <p>Filtragem por Universidades &nbsp;</p>
                                    <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="Nesta secção pode filtrar as suas pesquisas mediante a sua vontade e necessidade.">
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
                                            <label for="universidade">Universidades</label>
                                            <br>
                                            <select name="universidade">
                                                <option selected disabled hidden class="text-truncate" value="null">Selecionar universidade</option>
                                                @foreach ($universidades as $universidade)
                                                <option value="{{$universidade->idUniversidade}}">{{$universidade->nome}}</option>
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
                                    <br><br>
                                    <div class="row">
                                        <div class="form-group text-right ml-auto" style="margin-right:15px;">
                                            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">pesquisar pagamento</button>
                                            <button type="button" class="cancel-button">Cancelar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- Fornecedor -> Secção de procura --}}
                            <div id="div-fornecedor" style="display:none;">
                                <div class="row">
                                    <p>Filtragem por Fornecedor &nbsp;</p>
                                    <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="Nesta secção pode filtrar as suas pesquisas mediante a sua vontade e necessidade.">
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
                                            <label for="fornecedor">Fornecedores</label>
                                            <br>
                                            <select name="fornecedor">
                                                <option selected disabled hidden class="text-truncate" value="null">Selecionar fornecedor</option>
                                                @foreach ($fornecedores as $fornecedor)
                                                <option value="{{$fornecedor->idFornecedor}}">{{$fornecedor->nome}}</option>
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
                                    <br><br>
                                    <div class="row">
                                        <div class="form-group text-right ml-auto" style="margin-right:15px;">
                                            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">pesquisar pagamento</button>
                                            <button type="button" class="cancel-button">Cancelar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- Data -> Secção de procura --}}
                            <div id="div-data" style="display:none;">
                                <div class="row">
                                    <p>Filtragem por Data &nbsp;</p>
                                    <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="Nesta secção pode filtrar as suas pesquisas mediante a sua vontade e necessidade.">
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
                                            <label for="mes">Mês do ano</label>
                                            <br>
                                            <select name="mes">
                                                <option selected disabled hidden class="text-truncate" value="null">Selecionar mês</option>
                                                <option value="jan">Janeiro</option>
                                                <option value="fev">Fevereiro</option>
                                                <option value="mar">Março</option>
                                                <option value="abr">Abril</option>
                                                <option value="mai">Maio</option>
                                                <option value="jun">Junho</option>
                                                <option value="jul">Julho</option>
                                                <option value="ago">Agosto</option>
                                                <option value="set">Setembro</option>
                                                <option value="out">Outubro</option>
                                                <option value="nov">Novembro</option>
                                                <option value="dez">Dezembro</option>
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
                                    <br><br>
                                    <div class="row">
                                        <div class="form-group text-right ml-auto" style="margin-right:15px;">
                                            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">pesquisar pagamento</button>
                                            <button type="button" class="cancel-button">Cancelar</button>
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
            @if (count($products))
            @foreach ($products as $product)
            <a href="#">
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
<script src="{{asset('/js/payments.js')}}"></script>
@endsection
@endsection
