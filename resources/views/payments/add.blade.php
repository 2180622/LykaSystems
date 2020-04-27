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

    <div class="cards-navigation">
        <div class="title">
            <h6>Secção de pagamento - {{$responsabilidade->fase->produto->cliente->nome.' '.$responsabilidade->fase->produto->cliente->apelido.' ('.$responsabilidade->fase->descricao.')'}}</h6>
        </div>
        <br>
        <div class="payment-card shadow-sm">
            <p style="margin-left: 0px !important; font-weight:600;">Valor total:</p>
            <?php
              $valorTotal = $responsabilidade->valorCliente + $responsabilidade->valorAgente + $responsabilidade->valorSubAgente + $responsabilidade->valorUniversidade1 + $responsabilidade->valorUniversidade2;
              $valorTotal = number_format((float)$valorTotal, 2, ',', '').'€'
            ?>
            <p style="margin-left: 0px !important;">&nbsp;{{$valorTotal}}</p>
            <hr>
            <form action="{{route('payments.store', $responsabilidade)}}" method="post" class="mt-4" enctype="multipart/form-data">
                @csrf
                @if ($responsabilidade->valorCliente != '0.00')
                <div class="row">
                    <div class="col-md-4">
                        <label for="valorPagoCliente">Valor pago ao cliente</label>
                        <br>
                        <input type="text" name="valorPagoCliente" value="{{number_format((float)$responsabilidade->valorCliente, 2, ',', '').'€'}}">
                    </div>
                    <div class="col-md-4" oncontextmenu="return showContextMenu();">
                        <label for="comprovativoPagamentoCliente">Comp. de pagamento</label>
                        <br>
                        <input type="file" name="comprovativoPagamentoCliente" id="upfileCliente" onchange="sub(this)">
                        <div class="input-file-div text-truncate" id="addFileButtonCliente" onclick="getFileCliente()">Adicionar um ficheiro</div>
                    </div>
                    <div class="col-md-4">
                        <label for="dataCliente">Data de pagamento</label>
                        <br>
                        <input name="dataCliente" placeholder="Selecionar data" type="text" onfocus="(this.type='date')" id="date" style="cursor:pointer;">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="contaCliente">Associar conta bancária</label>
                        <br>
                        <select name="contaCliente">
                            @foreach ($contas as $conta)
                            <option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
                            @endforeach
                            <option selected disabled hidden>Escolher conta bancária</option>
                        </select>
                    </div>
                </div>
                <br><br>
                @endif
                @if ($responsabilidade->valorAgente != "0.00")
                <div class="row">
                    <div class="col-md-4">
                        <label for="valorPagoAgente">Valor pago ao agente</label>
                        <br>
                        <input type="text" name="valorPagoAgente" value="{{number_format((float)$responsabilidade->valorAgente, 2, ',', '').'€'}}">
                    </div>
                    <div class="col-md-4" oncontextmenu="return showContextMenu();">
                        <label for="comprovativoPagamentoAgente">Comp. de pagamento</label>
                        <br>
                        <input type="file" name="comprovativoPagamentoAgente" id="upfileAgente" onchange="sub(this)">
                        <div class="input-file-div text-truncate" id="addFileButtonAgente" onclick="getFileAgente()">Adicionar um ficheiro</div>
                    </div>
                    <div class="col-md-4">
                        <label for="dataAgente">Data de pagamento</label>
                        <br>
                        <input name="dataAgente" placeholder="Selecionar data" type="text" onfocus="(this.type='date')" id="date" style="cursor:pointer;">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="contaAgente">Associar conta bancária</label>
                        <br>
                        <select name="contaAgente">
                            @foreach ($contas as $conta)
                            <option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
                            @endforeach
                            <option selected disabled hidden>Escolher conta bancária</option>
                        </select>
                    </div>
                </div>
                <br><br>
                @endif
                @if ($responsabilidade->valorSubAgente != null)
                <div class="row">
                    <div class="col-md-4">
                        <label for="valorPagoSubAgente">Valor pago ao subagente</label>
                        <br>
                        <input type="text" name="valorPagoSubAgente" value="{{number_format((float)$responsabilidade->valorSubAgente, 2, ',', '').'€'}}">
                    </div>
                    <div class="col-md-4" oncontextmenu="return showContextMenu();">
                        <label for="comprovativoPagamentoSubAgente">Comp. de pagamento</label>
                        <br>
                        <input type="file" name="comprovativoPagamentoSubAgente" id="upfileSubAgente" onchange="sub(this)">
                        <div class="input-file-div text-truncate" id="addFileButtonSubAgente" onclick="getFileSubAgente()">Adicionar um ficheiro</div>
                    </div>
                    <div class="col-md-4">
                        <label for="dataSubAgente">Data de pagamento</label>
                        <br>
                        <input name="dataSubAgente" placeholder="Selecionar data" type="text" onfocus="(this.type='date')" id="date" style="cursor:pointer;">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="contaSubAgente">Associar conta bancária</label>
                        <br>
                        <select name="contaSubAgente">
                            @foreach ($contas as $conta)
                            <option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
                            @endforeach
                            <option selected disabled hidden>Escolher conta bancária</option>
                        </select>
                    </div>
                </div>
                <br><br>
                @endif
                @if ($responsabilidade->valorUniversidade1 != '0.00')
                <div class="row">
                    <div class="col-md-4">
                        <label for="valorPagoUni1">Valor pago à universidade</label>
                        <br>
                        <input type="text" name="valorPagoUni1" value="{{number_format((float)$responsabilidade->valorUniversidade1, 2, ',', '').'€'}}">
                    </div>
                    <div class="col-md-4" oncontextmenu="return showContextMenu();">
                        <label for="comprovativoPagamentoUni1">Comp. de pagamento</label>
                        <br>
                        <input type="file" name="comprovativoPagamentoUni1" id="upfileUni1" onchange="sub(this)">
                        <div class="input-file-div text-truncate" id="addFileButtonUni1" onclick="getFileUni1()">Adicionar um ficheiro</div>
                    </div>
                    <div class="col-md-4">
                        <label for="dataUni1">Data de pagamento</label>
                        <br>
                        <input name="dataUni1" placeholder="Selecionar data" type="text" onfocus="(this.type='date')" id="date" style="cursor:pointer;">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="contaUni1">Associar conta bancária</label>
                        <br>
                        <select name="contaUni1">
                            @foreach ($contas as $conta)
                            <option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
                            @endforeach
                            <option selected disabled hidden>Escolher conta bancária</option>
                        </select>
                    </div>
                </div>
                <br><br>
                @endif
                @if ($responsabilidade->valorUniversidade2 != null)
                <div class="row">
                    <div class="col-md-4">
                        <label for="valorPagoUni2">Valor pago à universidade</label>
                        <br>
                        <input type="text" name="valorPagoUni2" value="{{number_format((float)$responsabilidade->valorUniversidade2, 2, ',', '').'€'}}">
                    </div>
                    <div class="col-md-4" oncontextmenu="return showContextMenu();">
                        <label for="comprovativoPagamentoUni2">Comp. de pagamento</label>
                        <br>
                        <input type="file" name="comprovativoPagamentoUni2" id="upfileUni2" onchange="sub(this)">
                        <div class="input-file-div text-truncate" id="addFileButtonUni2" onclick="getFileUni2()">Adicionar um ficheiro</div>
                    </div>
                    <div class="col-md-4">
                        <label for="dataUni2">Data de pagamento</label>
                        <br>
                        <input name="dataUni2" placeholder="Selecionar data" type="text" onfocus="(this.type='date')" id="date" style="cursor:pointer;">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="contaUni2">Associar conta bancária</label>
                        <br>
                        <select name="contaUni2">
                            @foreach ($contas as $conta)
                            <option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
                            @endforeach
                            <option selected disabled hidden>Escolher conta bancária</option>
                        </select>
                    </div>
                </div>
                <br><br>
                @endif
        </div>
        <div class="form-group text-right">
            <br>
            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">confirmar pagamento</button>
            <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
        </div>
        </form>
        <br>
    </div>
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
