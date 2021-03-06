@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Cobranças')

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


    <br><br>

    <div class="cards-navigation">
        <div class="title">
            <h6>Secção de cobrança - {{$product->cliente->nome.' '.$product->cliente->apelido}} ({{$fase->descricao}})</h6>
        </div>
        <br>
        <div class="payment-card shadow-sm">
            <p>VALOR A COBRAR:</p>
            <p>&nbsp;{{number_format((float)$fase->valorFase, 2, ',', '')}}€</p>
            <hr>
            <form class="mt-4" action="{{route('charges.store', [$product, $fase])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="O valor recebido não deve conter nenhum símbolo e deve ter o seguinte formato: 10,00 ou 10.000">
                            <span>
                                ?
                            </span>
                        </div>
                        <label for="valorRecebido">Valor recebido</label>
                        <br>
                        <input type="text" name="valorRecebido" placeholder="Inserir o valor recebido" autocomplete="off">
                    </div>
                    <div class="col-md-4">
                        <label for="tipoPagamento">Tipo de pagamento</label>
                        <br>
                        <select name="tipoPagamento">
                            <option selected disabled hidden class="text-truncate">Escolher tipo pagamento</option>
                            <option value="Multibanco">Multibanco</option>
                            <option value="Paypal">Paypal</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    <div class="col-md-4" oncontextmenu="return showContextMenu();">
                        <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="Se pretender mais opções, clique com o botão direito do seu rato sobre a secção do comprovativo de pagamento.">
                            <span>
                                ?
                            </span>
                        </div>
                        <label for="comprovativoPagamento" class="text-truncate" style="width:90%;">Comprovativo de pagamento</label>
                        <br>
                        <input type="file" name="comprovativoPagamento" id="upfile" onchange="sub(this)">
                        <div class="input-file-div text-truncate" id="addFileButton" onclick="getFile()">Adicionar um ficheiro</div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="Associar a cobrança à conta bancária pelo qual o pagamento foi recebido.">
                            <span>
                                ?
                            </span>
                        </div>
                        <label for="conta">Associar conta bancária</label>
                        <br>
                        <select name="conta">
                            @foreach ($contas as $conta)
                            <option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
                            @endforeach
                            <option selected disabled hidden>Escolher conta bancária</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="dataOperacao">Data de pagamento</label>
                        <br>
                        <input type="date" name="dataOperacao">
                    </div>
                    <div class="col-md-4">
                        <label for="dataRecebido">Data de receção</label>
                        <br>
                        <input type="date" name="dataRecebido">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col">
                        <label for="observacoes">Observações</label>
                        <br>
                        <textarea name="observacoes" rows="5"></textarea>
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
<script src="{{asset('/js/charges.js')}}"></script>
@endsection

@endsection
