<div class="cards-navigation">
    <div class="title">
        <h6>Secção de pagamento: {{$fornecedor->nome.' ('.$fase->descricao.')'}}</h6>
    </div>
    <br>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p style="font-weight:500;">
            Este pagamento está associado à fase <strong>{{$fase->descricao}}</strong> do produto <strong>{{$fase->produto->descricao}}</strong>, que têm como cliente <strong>{{$fase->produto->cliente->nome.' '.$fase->produto->cliente->apelido}}</strong>, agente <strong>{{$fase->produto->agente->nome.' '.$fase->produto->agente->apelido}}</strong> e universidade <strong>{{$fase->produto->universidade1->nome}}</strong>.
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="payment-card shadow-sm">
        <p style="margin-left: 0px !important; font-weight:600;">Valor a pagar:</p>
        <p style="margin-left: 0px !important;">{{number_format((float)$relacao->valor, 2, ',', '').'€'}}</p>
        <hr>
        <form action="{{route('payments.store', $relacao->responsabilidade)}}" method="post" class="mt-4" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="valorPagoFornecedor">Valor pago ao fornecedor</label>
                    <br>
                    <input type="text" name="valorPagoFornecedor" id="valorPagoFornecedor" value="{{number_format((float)$relacao->valor, 2, ',', '').'€'}}">
                </div>
                <div class="col-md-4" oncontextmenu="return showContextMenu();">
                    <label for="comprovativoPagamentoForn">Comp. de pagamento</label>
                    <br>
                    <input type="file" name="comprovativoPagamentoForn" id="upfileCliente" onchange="sub(this)">
                    <div class="input-file-div text-truncate" id="addFileButtonCliente" onclick="getFileCliente()">Adicionar um ficheiro</div>
                </div>
                <div class="col-md-4">
                    <label for="dataFornecedor">Data de pagamento</label>
                    <br>
                    <input name="dataFornecedor" id="dataFornecedor" type="date">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label for="contaFornecedor">Associar conta bancária</label>
                    <br>
                    <select name="contaFornecedor" id="contaFornecedor">
                        @foreach ($contas as $conta)
                        <option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
                        @endforeach
                        <option selected disabled hidden>Escolher conta bancária</option>
                    </select>
                </div>
            </div>
            <br>
            <input type="text" name="nomeFornecedor" value="{{$fornecedor->nome}}" hidden="true">
            <input type="text" name="relacaoFornecedor" value="{{$relacao->idRelacao}}" hidden="true">
    </div>
    <div class="form-group text-right">
        <br>
        <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">registar pagamento</button>
        <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
    </div>
    </form>
    <br>
</div>
