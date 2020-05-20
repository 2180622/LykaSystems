<div class="cards-navigation">
    <div class="title">
        <h6>Secção de pagamento: {{$cliente->nome.' '.$cliente->apelido.' ('.$fase->descricao.')'}}</h6>
    </div>
    <br>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p style="font-weight:500;">
            Este pagamento está associado à fase <strong>{{$fase->descricao}}</strong> do produto <strong>{{$fase->produto->descricao}}</strong>, que têm como agente
            <strong>{{$fase->produto->agente->nome.' '.$fase->produto->agente->apelido}}</strong> e universidade <strong>{{$fase->produto->universidade1->nome}}</strong>.
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="payment-card shadow-sm">
        <p style="margin-left: 0px !important; font-weight:600;">valor a pagar:</p>
        <p style="margin-left: 0px !important;">{{number_format((float)$responsabilidade->valorCliente, 2, ',', '').'€'}}</p>
        <hr>
        <form id="registar-pagamento-form" class="mt-4">
            <input type="text" id="idResp" name="idResp" value="{{$responsabilidade->idResponsabilidade}}" hidden="true">
            <div class="row">
                <div class="col-md-4">
                    <label for="valorPagoCliente">Valor pago ao cliente</label>
                    <br>
                    <input type="text" name="valorPagoCliente" id="valorPagoCliente" required="required" value="{{number_format((float)$responsabilidade->valorCliente, 2, ',', '').'€'}}">
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
                    <input name="dataCliente" id="dataCliente" type="date">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label for="contaCliente">Associar conta bancária</label>
                    <br>
                    <select name="contaCliente" id="contaCliente">
                        @foreach ($contas as $conta)
                        <option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
                        @endforeach
                        <option selected disabled hidden>Escolher conta bancária</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="A descrição que inserir será colocada na nota de pagamento como descrição do mesmo.">
                        <span>
                            ?
                        </span>
                    </div>
                    <label for="descricaoCliente">Descrição do pagamento</label>
                    <br>
                    <input type="text" name="descricaoCliente" id="descricaoCliente" required="required" placeholder="Adicionar uma descrição" maxlength="150">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label for="observacoes">Observações</label>
                    <br>
                    <textarea name="observacoes" rows="3" placeholder="Adicionar uma observação"></textarea>
                </div>
            </div>
            <br>
    </div>
    <div class="form-group text-right">
        <br>
        <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">registar pagamento</button>
        <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
    </div>
    </form>
    <br>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <ion-icon id="checkmark-icon" name="checkmark" size="large"></ion-icon>
                {{-- <ion-icon name="checkmark-circle-outline"></ion-icon> --}}
            </div>
            <div class="modal-body text-center">
                <p id="title-modal">Registo feito com sucesso!</p>
                <p id="text-info-modal" class="mt-3">Pretende transferir a nota de pagamento que comprova o pagamento registado?</p>
            </div>
            <div class="modal-footer mt-2">
                <div class="row text-center">
                    <div class="col-6">
                        <a id="cancel-button" href="{{route("payments.index")}}">Voltar</a>
                    </div>
                    <div class="col-6">
                        <a id="anchor-stream" target="_blank">Transferir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
