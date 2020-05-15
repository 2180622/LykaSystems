<div class="cards-navigation">
    <div class="title">
        <h6>Secção de pagamento - {{$fornecedor->nome.' ('.$fase->descricao.')'}}</h6>
    </div>
    <br>
    <div class="payment-card shadow-sm">
        <p style="margin-left: 0px !important; font-weight:600;">Valor total:</p>
        <p style="margin-left: 0px !important;">&nbsp;{{$relacao->valor}}</p>
        <hr>
        <form action="" method="post" class="mt-4" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="valorPagoCliente">Valor pago ao cliente</label>
                    <br>
                    <input type="text" name="valorPagoCliente" value="{{number_format((float)$relacao->valor, 2, ',', '').'€'}}">
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
                    <input name="dataCliente" type="date">
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
    </div>
    <div class="form-group text-right">
        <br>
        <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">confirmar pagamento</button>
        <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
    </div>
    </form>
    <br>
</div>
