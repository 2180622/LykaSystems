<div class="container-fluid " style="font-size:14px; height:70%">

    <div class="text-center" style="margin-top:26px;">
        <a href="#" data-toggle="modal" data-target="#modalContacts" class="top-button-contact">procurar contacto</a>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalContacts" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="modalLabel">Procura de contactos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-contact" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="user-type">Tipo de utilizador:</label>
                                <br>
                                <select id="user-type">
                                    <option disabled hidden selected>Escolher tipo de utilizador</option>
                                    <option value="clientes">Clientes</option>
                                    <option value="agentes">Agentes</option>
                                    <option value="universidades">Universidades</option>
                                    <option value="fornecedores">Fornecedores</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="name">Nome do utilizador:</label>
                                <br>
                                <input id="name" type="text" name="name" placeholder="Inserir nome do utilizador">
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

                    // Procura de contactos - AJAX

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}"
                        }
                    });

                    $('#form-contact').submit(function(event) {
                        event.preventDefault();
                        info = {
                            users: $("#user-type").find(":selected").val(),
                            name: $("#name").val()
                        };
                        $.ajax({
                            type: "post",
                            url: "{{route('search.contact')}}",
                            context: this,
                            data: info,
                            success: function(data) {
                                console.log('OK');
                            },
                            error: function(){
                                console.log('NOK');
                            }
                        });
                    });
                </script>
              @endsection
