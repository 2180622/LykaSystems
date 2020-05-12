<style media="screen">
    select,
    input {
        width: 100%;
        border: none;
        color: #747474;
        font-weight: 600;
        appearance: none;
        padding: 7px 12px;
        border-radius: 5px;
        -moz-appearance: none;
        -webkit-appearance: none;
        background-color: #EAEAEA;
        transition: 0.3s ease-in-out;
    }

    select {
        cursor: pointer;
    }

    select:focus,
    input:focus {
        outline: 0;
        color: #495057;
        border-color: #80bdff;
        background-color: #fff;
        box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
    }

    #error {
        color: #e3342f;
        font-size: 10pt;
        display: inherit;
        margin-bottom: 10px;
    }

    p {
        font-weight: 700;
        margin-bottom: 0;
    }

    .charge-div {
        margin-top: 20px;
        padding: 12px 10px;
        border-radius: 10px;
        background-color: #fff;
        transition: 0.1s ease-in-out;
    }

    .charge-div:hover {
        background-color: rgb(235, 235, 235);
    }

    .white-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: white;
    }

    .white-circle img {
        border-radius: 50%;
    }

    a {
        color: #747474;
    }

    a:hover {
        color: #747474;
        text-decoration: none;
    }
</style>

<div class="container-fluid " style="font-size:14px; height:70%">

    <div class="text-center" style="margin-top:26px;">
        <a href="#" class="top-button-contact">procurar contacto</a>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalContacts" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding-bottom:0px;">
                    <h5 class="modal-title text-center" id="modalLabel">Procura de contactos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-contact" method="POST" class="mt-2">
                    <div class="modal-body" id="modal-body-contact">
                        <div class="row" id="contact-row">
                            <div class="col-md-4">
                                <label for="user-type">Tipo de utilizador:</label>
                                <br>
                                <select id="user-type" name="usertype">
                                    <option disabled hidden selected>Escolher tipo de utilizador</option>
                                    <option value="clientes">Clientes</option>
                                    <option value="agentes">Agentes</option>
                                    <option value="universidades">Universidades</option>
                                    <option value="fornecedores">Fornecedores</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a id="a-close-modal" class="mr-4" data-dismiss="modal">Fechar</a>
                        <button id="submit-button" type="submit" class="btn">Procurar contacto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-4 mx-auto mb-4 pt-3 font-weight-bold" style="font-size:18px; padding-left:5px;">
        Notificações
    </div>
    @if($Notificacoes)
    <div class="text-muted text-center m-2" style="font-size:12px"> {{(new DateTime())->format('d/m/Y')}} </div>
    @php
    $data = $Notificacoes[0]->data['dataComeco'];
    @endphp
    @foreach($Notificacoes as $Notificacao)
    @if($Notificacao->data['dataComeco']
        < $data) @php
        $data = (new DateTime($Notificacao->data['dataComeco']))->format('d/m/Y');
        @endphp
        <div class="text-muted text-center m-2" style="font-size:12px"> {{(new DateTime($Notificacao->data['dataComeco']))->format('d/m/Y')}} </div>
        @endif
        @if($Notificacao->data['dataComeco'] <= (new DateTime())) @if($Notificacao->type == 'App\Notifications\Aniversario')
                <div class="alert-dismissible row p-1 mx-1 alert alert-info fade show">
                    @elseif($Notificacao->type == 'App\Notifications\Abertura')
                        <div class="alert-dismissible row p-1 mx-1 alert alert-success fade show">
                            @elseif(($Notificacao->type == 'App\Notifications\Atraso' || $Notificacao->type == 'App\Notifications\AtrasoCliente') && $Notificacao->data['urgencia'])
                                <div class="alert-dismissible row p-1 mx-1 alert alert-danger fade show">
                                    @elseif(($Notificacao->type == 'App\Notifications\Atraso' || $Notificacao->type == 'App\Notifications\AtrasoCliente') && !$Notificacao->data['urgencia'])
                                        <div class="alert-dismissible row p-1 mx-1 alert alert-warning fade show">
                                            @else
                                            <div class="alert-dismissible row p-1 mx-1 alert alert-secondary fade show">
                                                @endif
                                                <div class="close_btn text-center" style="font-size:14px;"><a href="#" data-dismiss="alert"><i title="Marcar como lido" class="far fa-check-circle"></i></a></div>

                                                <div class="col col-2 text-center mr-1 p-2 align-self-center" style="font-size:16px">
                                                    @if($Notificacao->type == 'App\Notifications\Aniversario')
                                                        <i class="fas fa-birthday-cake"></i>
                                                        @elseif($Notificacao->type == 'App\Notifications\Abertura')
                                                            <i class="fas fa-university"></i>
                                                            @elseif($Notificacao->type == 'App\Notifications\Atraso' || $Notificacao->type == 'App\Notifications\AtrasoCliente')
                                                                <i class="fas fa-exclamation-triangle"></i>
                                                                @else
                                                                <i class="fas fa-info-circle"></i>
                                                                @endif

                                                </div>
                                                <div class="info-not">
                                                    <div class="col p-2 assunto">
                                                        <b>{{$Notificacao->data['assunto']}}</b>
                                                        <br>
                                                        <a class="mostra" href="#" onClick="show($(this).closest('.info-not'))">Ler Tudo</a>
                                                    </div>
                                                    <div class="col p-2 descricao" style="display: none;">
                                                        @php
                                                        $descricoes = explode('*',str_replace(array("\\r\\n", "\\r", "\\n"), "*", $Notificacao->data['descricao']));
                                                        @endphp
                                                        @foreach($descricoes as $descricao)
                                                        {{$descricao}}
                                                        <br>
                                                        @endforeach
                                                        <a href="#" onClick="hide($(this).closest('.info-not'))">Diminuir</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            @else
                                            <div class="text-muted text-center m-2" style="font-size:12px"> Não tem notificações </div>
                                            @endif

                                            {{-- FIM DAS NOTIFICAÇÕES --}}

                                            <!-- <div class="mx-auto mb-3 pt-3 font-weight-bold text-center" style="color:#6A74C9;font-size:18px">
        <div class="text-muted" style="font-size:12px"><a href="#">Ver tudo</a></div>
    </div> -->
                                        </div>
                                </div>
                        </div>
                </div>

                @section('scripts')
                <script type="text/javascript">
                    function show(div) {
                        div.find('.descricao').first().css({
                            "display": "block"
                        });
                        div.find('.mostra').first().css({
                            "display": "none"
                        });
                    }

                    function hide(div) {
                        div.find('.descricao').first().css({
                            "display": "none"
                        });
                        div.find('.mostra').first().css({
                            "display": "block"
                        });
                    }
                </script>
                @endsection
