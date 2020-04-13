@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Pagamento')

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
            <form action="/charges/{{$product->idProduto}}/{{$fase->idFase}}" method="post" enctype="multipart/form-data" name="chargeForm">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="O valor recebido não deve conter nenhum símbolo.">
                            <span>
                                ?
                            </span>
                        </div>
                        <label for="valorRecebido">Valor recebido</label>
                        <br>
                        <input type="text" name="valorRecebido" placeholder="Inserir o valor recebido" value="{{old('valorRecebido', $docTrasancao[0]->valorRecebido)}}€">
                    </div>
                    <div class="col-md-4">
                        <label for="tipoPagamento">Tipo de pagamento</label>
                        <br>
                        <select name="tipoPagamento">
                            <option value="Multibanco">Multibanco</option>
                            <option value="Paypal">Paypal</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="comprovativoPagamento">Comprovativo de pagamento</label>
                        <br>
                        <input type="file" name="comprovativoPagamento" id="upfile" onchange="sub(this)">
                        <div class="input-file-div text-truncate" id="addFileButton" onclick="getFile()">Adicionar um ficheiro</div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="dataOperacao">Data de pagamento</label>
                        <br>
                        <input type="date" name="dataOperacao" value="{{old('dataOperacao', $docTrasancao[0]->dataOperacao)}}">
                    </div>
                    <div class="col-md-4">
                        <label for="dataRecebido">Data de receção</label>
                        <br>
                        <input type="date" name="dataRecebido" value="{{old('dataRecebido', $docTrasancao[0]->dataRecebido)}}">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col">
                        <label for="observacoes">Observações</label>
                        <br>
                        <textarea name="observacoes" rows="5" value="{{old('observacoes', $docTrasancao[0]->observacoes)}}"></textarea>
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

@section('scripts')
<script src="{{asset('/js/charges.js')}}"></script>
@endsection

@endsection
