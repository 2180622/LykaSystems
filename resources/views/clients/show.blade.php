@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de estudante')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">
@endsection



{{-- Page Content --}}
@section('content')

<div class="container mt-2">
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
        <a href="{{route('report')}}" class="top-button mr-2">reportar problema</a>
        @if (Auth::user()->tipo == "admin")
            <a href="{{route('clients.edit',$client)}}" class="top-button mr-2">Editar informação</a>
        @endif

        <a href="{{route('clients.print',$client)}}" target="_blank" class="top-button">Imprimir</a>

    </div>

    <br><br>

    <div class="cards-navigation">

        <div class="row">
            <div class="col">
                <div class="title">
                    <h6>Ficha de estudante</h6>
                </div>
            </div>
            <div class="col text-right">
                <div class="text-muted"><small>Adicionado em: {{ date('d-M-y', strtotime($client->created_at)) }}</small></div>

                <div class="text-muted"><small>Ultima atualização:
                        {{ date('d-M-y', strtotime($client->updated_at)) }}</small></div>
            </div>
        </div>

        <br>

        <div class="row font-weight-bold border p-2 pt-3 pb-3" style="color:#6A74C9">
            <div class="col p-0 text-center" style="flex: 0 0 20%; -ms-flex: 0 0 20%; min-width:195px">

                @if($client->fotografia)
                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('client-documents/'.$client->idCliente.$client->nome.'/').$client->fotografia}}" style="width:90%">
                @elseif($client->genero == 'F')
                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" style="width:90%">
                @else
                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:90%">
                @endif

            </div>

            <div class="col p-2" style="min-width:280px !important">

                {{-- Informações Pessoais --}}
                <div><span class="text-secondary ">Nome:</span> {{$client->nome}} {{$client->apelido}}</div><br>

                <div><span class="text-secondary ">Género: </span>
                    @if ($client->genero == 'M')
                    Masculino
                    @else
                    Feminino
                    @endif
                </div><br>

                <div><span class="text-secondary">Naturalidade:</span> {{$client->paisNaturalidade}}</div><br>

                <div><span class="text-secondary ">Data de nascimento: </span>
                    {{ date('d-M-y', strtotime($client->dataNasc)) }}</div><br>

                <div><span class="text-secondary">Telefone (principal):</span> {{$client->telefone1}}</div><br>

                <div><span class="text-secondary">E-mail:</span> {{$client->email}}</div>

            </div>

            <div class="col p-2" style="min-width:230px !important">
                <div><span class="text-secondary">Estado financeiro: </span><span
                        class="text-success">Regularizado</span></div><br>

                <div><span class="text-secondary">Observações pessoais:</span><br>
                    @if ($client->obsPessoais==null)
                    <span class="text-muted"><small>(sem dados para mostrar)</small></span>
                    @else
                    {{ $client->obsPessoais }}
                    @endif
                </div><br>



                @if (Auth::user()->tipo == "admin")

                    <div>
                        @if ($agents!=null )
                        <div class="text-secondary mb-2">Agente(s) associados:</div>
                            @foreach ($agents as $agent)
                            <i class="fas fa-user-tie mr-2"></i><a href="{{route('agents.show',$agent)}}" class="name_link">{{$agent->nome}} {{$agent->apelido}}</a><br>
                            @endforeach

                            @if ($subagents!=null )
                            @foreach ($subagents as $subagent)
                            <i class="fas fa-user-tie mr-2"></i><a href="{{route('agents.show',$subagent)}}" class="name_link">{{$subagent->nome}} {{$subagent->apelido}}</a><br>
                            @endforeach
                            @endif
                        @endif
                    </div>

                    {{-- Adicionar produto --}}
                    <div class="mt-4"><a href="{{route('produtos.create',$client)}}" class="top-button"><i class="fas fa-plus mr-2"></i>Adicionar produto</a></div>

                @endif

            </div>

        </div>

        <ul class="nav nav-tabs mt-5 mb-4" id="myTab" role="tablist">

            {{-- MENU: Produtos --}}
            <li class="nav-item " style="width:20%; min-width:110px">
                <a class="nav-link active" id="produtos-tab" data-toggle="tab" href="#produtos" role="tab"
                    aria-controls="produto" aria-selected="false">Produtos</a>
            </li>

            {{-- MENU: Documentação --}}
            <li class="nav-item text-center" style="width:20%; min-width:144px">
                <a class="nav-link" id="documentation-tab" data-toggle="tab" href="#documentation" role="tab"
                    aria-controls="documentation" aria-selected="false">Documentação pessoal</a>
            </li>

            {{-- MENU: Informação académica --}}
            <li class="nav-item text-center" style="width:20%; min-width:144px">
                <a class="nav-link" id="academicos-tab" data-toggle="tab" href="#academicos" role="tab"
                    aria-controls="contacts" aria-selected="true">Dados académicos</a>
            </li>

            {{-- MENU: Contactos --}}
            <li class="nav-item text-center" style="width:20%; min-width:110px">
                <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab"
                    aria-controls="contacts" aria-selected="false">Contactos</a>
            </li>

            {{-- MENU: Moradas --}}
            <li class="nav-item text-center" style="width:20%; min-width:114px">
                <a class="nav-link" id="adresses-tab" data-toggle="tab" href="#adresses" role="tab"
                    aria-controls="adresses" aria-selected="false">Financeiro</a>
            </li>

        </ul>






        <div class="tab-content p-2 " id="myTabContent">
            {{-- Conteudo: Produtos --}}
            <div class="tab-pane fade active show text-muted" id="produtos" role="tabpanel"
                aria-labelledby="produtos-tab">

                @if($produtos)
                    <table nowarp class="table table-borderless text-muted" id="dataTable" width="100%" row-border="0"
                        style="overflow:hidden;">

                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Descrição</th>
                                <th>Ano Academico</th>
                                <th>Valor</th>
                            </tr>



                        </thead>

                        {{-- Corpo da tabela --}}
                        <tbody>

                            @foreach ($produtos as $produto)
                            <tr>
                                {{-- Tipo --}}
                                <td class="align-middle"><a class="name_link"
                                        href="{{route('produtos.show',$produto)}}">{{$produto->tipo}}</a></td>

                                {{-- Descrição --}}
                                <td class="align-middle"><a class="name_link"
                                        href="{{route('produtos.show',$produto)}}">{{$produto->descricao}}</a></td>

                                {{-- Ano Academico --}}
                                <td class="align-middle">{{$produto->anoAcademico}}</td>

                                {{-- Total --}}
                                <td class="align-middle">{{$produto->valorTotal.'€'}}</td>


                                {{-- OPÇÔES --}}
                                {{-- <th class="text-center align-middle">
                                    <a href="{{route('produtos.show',$produto)}}" class="btn_list_opt "
                                title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                                <a href="{{route('produtos.edit',$produto)}}" class="btn_list_opt btn_list_opt_edit"
                                    title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                                <form method="POST" role="form" id="{{$produto->idProduto}}"
                                    action="{{route('produtos.destroy',$produto)}}" class="d-inline-block form_produto_id">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn_delete" title="Eliminar produto" data-toggle="modal"
                                        data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
                                </form>

                                </th> --}}
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <hr>

                    <div class="row border-dark p-2 pl-4 text-right">Total dos protudos: {{$totalprodutos}}€</div>

                @else
                    <div><span class="text-secondary">Sem Produtos</div>
                @endif

            </div>


            {{-- Conteudo: Documentação --}}
            <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">

                {{-- DADOS DE PASSAPORTE --}}
                <div class="row">

                    <div class="col mr-3">
                        {{-- numPassaport --}}
                        <div><span class="text-secondary">Número do passaporte:</span> {{$infosPassaport->numPassaport ?? ''}}</div>
                        <br>

                        {{-- dataValidPP --}}
                        <div><span class="text-secondary">Data de validade do passaporte:</span>
                            {{$infosPassaport->dataValidPP }}</div><br>

                        {{-- passaportPaisEmi --}}
                        <div><span class="text-secondary">Pais emissor do passaporte:</span>
                            {{$infosPassaport->passaportPaisEmi ?? ''}}</div><br>

                        {{-- localEmissaoPP --}}
                        <div><span class="text-secondary">Local de emissão do passaporte:</span>
                            {{$infosPassaport->localEmissaoPP ?? ''}}</div>

                        <br><br>
                        {{-- CC IDENTIFICAÇÃO --}}
                        <div><span class="text-secondary">Número de identificação pessoal:</span> {{$client->num_docOficial}}</div>
                        <br>
                        <div><span class="text-secondary">Número de identificação fiscal:</span> {{$client->NIF}}</div>
                        <br>
                        <div><span class="text-secondary">Data de validade:</span> {{$client->info_docOficial}}</div>



                    </div>


                    <div class="col" style="min-width:225px">
                        <div class="text-secondary mb-2">Ficheiros carregados:</div>

                        <ul style="list-style-type:none;margin:0px;padding:0">

                            {{-- Verifica se existe imagem para cartão de documento de id pessoal --}}
                            @if ($client->img_docOficial)
                            <li class="my-3">
                                <i class="far fa-address-card mr-2"></i>
                                <a class="name_link" target="_blank" href="{{Storage::disk('public')->url('client-documents/'.$client->idCliente.$client->nome.'/'.$client->img_docOficial)}}">Documento de identificação pessoal</a>
                            </li>
                            @endif

                            {{-- Verifica se existe imagem para passaporte --}}
                            @if ($client->img_Passaport)
                            <li class="my-3">
                                <i class="far fa-address-card mr-2"></i>
                                <a class="name_link" target="_blank" href="{{Storage::disk('public')->url('client-documents/'.$client->idCliente.$client->nome.'/'.$client->img_Passaport)}}">Passaporte</a>
                            </li>
                            @endif

                        </ul>

                    {{-- Carregar novos documentos --}}
                    <div class="mt-4"><a href="{{route('produtos.create',$client)}}" class="top-button"><i class="fas fa-plus mr-2"></i>Carregar Documentos</a></div>

                    </div>

                </div>

            </div>





            {{-- Conteudo: DADOS ACADÉMICOS --}}
            <div class="tab-pane fade" id="academicos" role="tabpanel" aria-labelledby="academicos-tab">
                <div class="row">
                    <div class="col">

                        {{-- Informações Escolares --}}
                        <div><span class="text-secondary">Nivel de estudos(atual):</span> {{$client->nivEstudoAtual}}
                        </div><br>

                        <div><span class="text-secondary">Nome da instituição de origem:</span>
                            {{$client->nomeInstituicaoOrigem}}</div><br>

                        <div><span class="text-secondary">Local da instituição:</span>
                            {{$client->cidadeInstituicaoOrigem}}</div><br>

                        <div><span class="text-secondary">Observações académicas:</span>

                            @if ($client->obsAcademicas==null)
                            <span class="text-muted"><small>(sem dados para mostrar)</small></span>
                            @else
                            {{$client->obsAcademicas}}
                            @endif

                        </div>

                    </div>

                    <div class="col" style="min-width:225px">
                        <div class="text-secondary mb-2">Documentos académicos:</div>

                        <ul style="list-style-type:none;margin:0px;padding:0">
                            @if($docsAcademicos)

                            @foreach($docsAcademicos as $docAcademico)
                                <li class="my-3">
                                    <i class="fas fa-file-alt mr-2"></i>
                                    <a href="" class="name_link" target="_blank" href="#">{{$docAcademico->tipo}}</a>
                                </li>
                            @endforeach

                            @else
                            <li class="text-muted"><small>Sem documentos</small></li>
                            @endif


                            {{-- Carregar novos documentos --}}
                            <div class="mt-4"><a href="{{route('produtos.create',$client)}}" class="top-button"><i class="fas fa-plus mr-2"></i>Carregar Documentos</a></div>



                        </ul>

                    </div>

                </div>

            </div>


            {{-- Conteudo: Contactos --}}
            <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">

                <div class="row">
                    <div class="col">

                        {{-- Contactos --}}
                        <div><span class="text-secondary">Telefone (principal):</span> {{$client->telefone1}}</div><br>

                        <div><span class="text-secondary">Telefone (secundário):</span> {{$client->telefone2}}</div><br>

                        <div><span class="text-secondary">E-mail:</span> {{$client->email}}</div><br>
                    </div>


                    <div class="col">

                        {{-- Contactos --}}
                        <div><span class="text-secondary">Morada de residência (Portugal):</span></div>
                        <div>{{$client->moradaResidencia}}</div><br>

                    </div>
                </div>

                <hr><br>

                <div class="row">
                    <div class="col">
                        {{-- Morada de residência no pais de origem --}}
                        <div><span class="text-secondary">Morada (origem):</span> {{$client->morada}}</div><br>
                        <div><span class="text-secondary">Cidade (origem):</span> {{$client->cidade}}</div><br>
                        <hr>
                    </div>
                </div>

                {{-- Contactos dos PAIS --}}
                <div class="row mt-4">
                    <div class="col ">
                        <div><span class="text-secondary">Nome do pai:</span> {{$client->nomePai}}</div><br>
                        <div><span class="text-secondary">Telefone do pai:</span> {{$client->telefonePai}}</div><br>
                        <div><span class="text-secondary">E-mail do pai:</span> {{$client->emailPai}}</div><br>
                    </div>

                    <div class="col ">
                        <div><span class="text-secondary">Nome da mãe:</span> {{$client->nomeMae}}</div><br>
                        <div><span class="text-secondary">Telefone da mãe:</span> {{$client->telefoneMae}}</div><br>
                        <div><span class="text-secondary">E-mail da mãe:</span> {{$client->emailMae}}</div><br>
                    </div>

                </div>

            </div>





            {{-- DADOS FINANCEIROS --}}
            <div class="tab-pane fade" id="adresses" role="tabpanel" aria-labelledby="adresses-tab">

                <div class="row ">
                    <div class="col">

                        <div><span class="text-secondary">IBAN:</span> {{$client->IBAN}}</div>
                        <hr><br>
                        <div><span class="text-secondary">Estado financeiro: </span><span
                                class="text-success">Regularizado</span></div><br>

                        <div><span class="text-secondary">Observações Financeiras:</span><br>

                            @if ($client->obsFinanceiras==null)
                            <span class="text-muted"><small>(sem dados para mostrar)</small></span>
                            @else
                            {{$client->obsFinanceiras}}
                            @endif

                        </div><br>




                    </div>

                </div>
            </div>



        </div>





    </div>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')
<script src="{{asset('/js/show_client_details.js')}}"></script>
@endsection
