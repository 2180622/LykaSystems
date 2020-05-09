@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de estudante')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">

<style>
    .active {
        color: #6A74C9
    }

</style>
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
                <div class="text-muted"><small>Adicionado em:
                        {{ date('d-M-y', strtotime($client->created_at)) }}</small></div>

                <div class="text-muted"><small>Ultima atualização:
                        {{ date('d-M-y', strtotime($client->updated_at)) }}</small></div>
            </div>
        </div>

        <br>

        <div class="card shadow-sm p-3" style="border-radius:10px">
            <div class="row font-weight-bold p-2" style="color:#6A74C9">
                <div class="col col-md-12 text-center my-auto "
                    style="min-width:195px; max-width:230px; max-height:295px; overflow:hidden">

                    @if($client->fotografia)
                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                        src="{{Storage::disk('public')->url('client-documents/'.$client->idCliente.'/').$client->fotografia}}"
                        style="width:100%; ">
                    @elseif($client->genero == 'F')
                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                        src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" style="width:100%">
                    @else
                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                        src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:100%">
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
                        <i class="fas fa-user-tie mr-2"></i><a href="{{route('agents.show',$agent)}}"
                            class="name_link">{{$agent->nome}} {{$agent->apelido}}</a><br>
                        @endforeach

                        @if ($subagents!=null )
                        @foreach ($subagents as $subagent)
                        <i class="fas fa-user-tie mr-2"></i><a href="{{route('agents.show',$subagent)}}"
                            class="name_link">{{$subagent->nome}} {{$subagent->apelido}}</a><br>
                        @endforeach
                        @endif
                        @endif
                    </div>

                    {{-- Adicionar produto --}}
                    <div class="mt-4"><a href="{{route('produtos.create',$client)}}" class="top-button"><i
                                class="fas fa-plus mr-2"></i>Adicionar produto</a></div>
                    @endif

                </div>

            </div>
        </div>


        <div class="row nav nav-fill w-100 text-center mt-2 mx-auto p-3">


            <a class="nav-item nav-link active border p-3 m-1 bg-white rounded shadow-sm name_link" id="produtos-tab"
                data-toggle="tab" href="#produtos" role="tab" aria-controls="produto" aria-selected="true">
                <div class="col"><i class="fas fa-th-large mr-2"></i>Produtos</div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="documentation-tab"
                data-toggle="tab" href="#documentation" role="tab" aria-controls="documentation" aria-selected="false">
                <div class="col"><i class="far fa-id-card mr-2"></i>Documentos</div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="academicos-tab"
                data-toggle="tab" href="#academicos" role="tab" aria-controls="contacts" aria-selected="false">
                <div class="col" style="min-width: 197px"><i class="fas fa-graduation-cap mr-2"></i>Dados académicos
                </div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="contacts-tab"
                data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">
                <div class="col"><i class="fas fa-comments mr-2"></i>Contactos</div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="adresses-tab"
                data-toggle="tab" href="#adresses" role="tab" aria-controls="adresses" aria-selected="false">
                <div class="col"><i class="fas fa-chart-pie mr-2"></i>Financeiro</div>
            </a>


        </div>


        <div class="bg-white shadow-sm mb-4 p-4" style="margin-top:-30px">

            <div class="tab-content" id="myTabContent">
                {{-- Conteudo: Produtos --}}
                <div class="tab-pane fade active show text-muted" id="produtos" role="tabpanel"
                    aria-labelledby="produtos-tab">

                    @if($produtos)

                    <div class="row mt-2 pl-2">

                        @foreach ($produtos as $produto)

                        <a class="name_link text-center m-2" href="{{route('produtos.show',$produto)}}">
                            <div class="col bg-light border rounded shadow-sm p-4" style="min-width: 160px">
                                <div class="text-secondary"><i class="fas fa-database p-2 " style="font-size: 25px"></i>
                                </div>
                                <div>{{$produto->tipo}}</div>
                                {{-- <div>{{$produto->descricao}} em desenvolvimento Web & Multimédia
                            </div> --}}
                            <div class="mt-1">{{$produto->valorTotal.'€'}}</div>
                    </div>
                    </a>

                    @endforeach

                </div>

                <div class="row ">
                    <div class="col border rounded bg-light p-3 m-3">
                        Total dos protudos: <span class="active">{{$totalprodutos}}€</span>
                    </div>
                </div>

                @else

                <div class="row ">
                    <div class="col border rounded bg-light p-3 m-3">
                        <div class="text-muted"><small>(sem registos)</small></div>
                    </div>
                </div>

                @endif

            </div>


            {{-- Conteudo: Documentação --}}
            <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">

                {{-- DADOS DE Passaporte --}}
                <div class="row mt-2 pl-2 ">

                    <div class="col mr-3">

                        <div class="text-secondary mb-2">Passaporte:</div>

                        <div class="border rounded bg-light p-3">
                            {{-- numPassaporte --}}
                            <div><span class="text-secondary my-3">Número do passaporte:</span>
                                {{$client->num_passaporte}}</div>
                            <br>

                            {{-- dataValidPP --}}
                            <div><span class="text-secondary my-3">Data de validade do passaporte:</span>
                                {{-- {{$infosPassaporte->dataValidPP }} --}}</div><br>

                            {{-- passaportePaisEmi --}}
                            <div><span class="text-secondary my-3">Pais emissor do passaporte:</span>
                                {{-- {{$infosPassaporte->passaportePaisEmi ?? ''}} --}}</div><br>

                            {{-- localEmissaoPP --}}
                            <div><span class="text-secondary my-3">Local de emissão do passaporte:</span>
                                {{-- {{$infosPassaporte->localEmissaoPP ?? ''}} --}}</div>

                        </div>

                        <br><br>

                        <div class="text-secondary mb-2">Documento de identificação pessoal:</div>

                        <div class="border rounded bg-light p-3">
                            {{-- CC IDENTIFICAÇÃO --}}
                            <div><span class="text-secondary">Número de identificação pessoal:</span>
                                {{$client->num_docOficial}}
                            </div>
                            <br>
                            <div><span class="text-secondary">Número de identificação fiscal:</span> {{$client->NIF}}
                            </div>
                            <br>
                            <div><span class="text-secondary">Data de validade:</span> {{$client->validade_docOficial}}
                            </div>
                        </div>

                        <br>


                    </div>

                    {{-- DOCUMENTOS PESSOAIS --}}
                    <div class="col" style="min-width:250px">
                        <div class="text-secondary mb-2">Ficheiros carregados:</div>
                        @if ($documentosPessoais!=null)
                            <ul class="border rounded bg-light pl-3" style="list-style-type:none;margin:0px;padding:0">
                                @foreach ($documentosPessoais as $docpessoal)
                                    <li class="my-3">
                                        <i class="far fa-address-card mr-2"></i>
                                        <a class="name_link" target="_blank"
                                    href="{{Storage::disk('public')->url('client-documents/'.$client->idCliente.'/'.$docpessoal->imagem)}}">{{$docpessoal->tipo}}</a>
                                    </li>
                                @endforeach

                            </ul>
                        @else
                        <div class="border rounded bg-light p-3">
                            <div class="text-muted"><small>(sem registos)</small></div>
                        </div>
                        @endif

                        {{-- Adicionar Documento PESSOAL--}}
                        @if($novosDocumentos)
                            <div class="dropdown mt-4">
                                <button class="top-button dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-plus mr-2"></i>Adicionar documento
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        @foreach($novosDocumentos as $docPessoal)
                                            @if($docPessoal->tipo=="Pessoal")
                                                <a class="dropdown-item" href="{{route('documento-pessoal.create',["matricula",$docPessoal->idDocNecessario])}}">{{$docPessoal->tipoDocumento}}</a>
                                            @endif
                                        @endforeach
                                </div>

                            </div>
                        @endif

                    </div>

                </div>

            </div>





            {{-- Conteudo: DADOS ACADÉMICOS --}}
            <div class="tab-pane fade" id="academicos" role="tabpanel" aria-labelledby="academicos-tab">
                <div class="row mt-2 pl-2">
                    <div class="col">

                        {{-- Informações Escolares --}}
                        <div class="text-secondary mb-2">Nível de estudos:</div>

                        <div class="border rounded bg-light p-3">
                            @switch($client->nivEstudoAtual)
                            @case(1)
                                Secundário Incompleto
                            @break

                            @case(2)
                                Secundário completo
                            @break

                            @case(3)
                                Curso tecnologico
                            @break

                            @case(4)
                                Estuda na universidade
                            @break

                            @case(5)
                                Licenciado
                            @break

                            @case(6)
                                Mestrado
                            @break

                            @default
                            <span class="text-secondary"><small>(Aguarda dados...)</small></span>

                        @endswitch

                        </div>

                        <br>

                        <div class="text-secondary mb-2">Instituição de origem</div>
                        <div class="border rounded bg-light p-3">
                            <div><span class="text-secondary">Nome: </span>{{$client->nomeInstituicaoOrigem}}</div><br>
                            <div><span class="text-secondary">Local: </span>{{$client->cidadeInstituicaoOrigem}}</div>
                        </div>

                        <br>



                        <div class="text-secondary mb-2">Observações académicas:</div>
                        <div class="border rounded bg-light p-3">
                            @if ($client->obsAcademicas==null)
                            <div class="text-muted "><small>(sem dados para mostrar)</small></div>
                            @else
                            <div> {{$client->obsAcademicas}}</div>
                            @endif
                        </div>


                    </div>

                    {{-- DOCUMENTOS Académicos --}}
                    <div class="col" style="min-width:250px">
                        <div class="text-secondary mb-2">Ficheiros carregados:</div>
                        @if ($documentosAcademicos!=null)
                            <ul class="border rounded bg-light pl-3" style="list-style-type:none;margin:0px;padding:0">
                                @foreach ($documentosAcademicos as $docpessoal)
                                    <li class="my-3">
                                        <i class="far fa-address-card mr-2"></i>
                                        <a class="name_link" target="_blank"
                                    href="{{Storage::disk('public')->url('client-documents/'.$client->idCliente.'/'.$docpessoal->imagem)}}">{{$docpessoal->tipo}}</a>
                                    </li>
                                @endforeach

                            </ul>
                        @else
                        <div class="border rounded bg-light p-3">
                            <div class="text-muted"><small>(sem registos)</small></div>
                        </div>
                        @endif

                        {{-- Adicionar Documento PESSOAL--}}
                        @if($novosDocumentos)
                            <div class="dropdown mt-4">
                                <button class="top-button dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-plus mr-2"></i>Adicionar documento
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        @foreach($novosDocumentos as $docAcademico)
                                            @if($docAcademico->tipo=="Academico")
                                                <a class="dropdown-item" href="{{route('documento-pessoal.create',["matricula",$docAcademico->idDocNecessario])}}">{{$docAcademico->tipoDocumento}}</a>
                                            @endif
                                        @endforeach
                                </div>

                            </div>
                        @endif

                    </div>

                </div>

                <br>

            </div>


            {{-- Conteudo: Contactos --}}
            <div class="tab-pane fade pl-2" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">

                <div class="row mt-2">
                    <div class="col">

                        {{-- Contactos --}}
                        <div class="text-secondary mb-2" style="min-width: 256px">Contactos:</div>

                        <div class="border rounded bg-light p-3">
                            <div><span class="text-secondary">Telefone (principal):</span> {{$client->telefone1}}</div>
                            <br>
                            @if ($client->telefone2!=null)
                            <div><span class="text-secondary">Telefone (secundário):</span> {{$client->telefone2}}</div>
                            <br>
                            @endif
                            <div><span class="text-secondary">E-mail:</span> {{$client->email}}</div>
                        </div>
                        <br>
                    </div>



                    <div class="col">

                        {{-- Morada PT --}}
                        <div class="text-secondary mb-2" style="min-width: 256px">Morada de residência em Portugal:
                        </div>
                        <div class="border rounded bg-light p-3">
                            <div>{{$client->moradaResidencia}}</div>
                        </div>
                        <br>
                    </div>

                </div>


                <div class="row">
                    <div class="col">
                        {{-- Morada de residência no pais de origem --}}
                        <div class="text-secondary mb-2">Morada de origem:</div>
                        <div class="border rounded bg-light p-3">
                            <div><span class="text-secondary">Cidade (origem):</span> {{$client->cidade}}</div><br>
                            <div><span class="text-secondary">Morada (origem):</span> {{$client->morada}}</div>
                        </div>
                    </div>
                    <br>
                </div>


                <br>

                {{-- Contactos dos PAIS --}}
                <div class="row">
                    <div class="col">
                        <div class="text-secondary mb-2">Identificação dos pais:</div>
                    </div>
                </div>

                <div class="border rounded bg-light p-3">
                    <div class="row">
                        <div class="col " style="min-width: 300px">
                            <div><span class="text-secondary">Nome do pai:</span> {{$client->nomePai}}</div><br>
                            <div><span class="text-secondary">Telefone do pai:</span> {{$client->telefonePai}}</div><br>
                            <div><span class="text-secondary">E-mail do pai:</span> {{$client->emailPai}}</div>
                            <br>
                        </div>
                        <div class="col" style="min-width: 300px">
                            <div><span class="text-secondary">Nome da mãe:</span> {{$client->nomeMae}}</div><br>
                            <div><span class="text-secondary">Telefone da mãe:</span> {{$client->telefoneMae}}</div><br>
                            <div><span class="text-secondary">E-mail da mãe:</span> {{$client->emailMae}}</div>
                        </div>
                    </div>
                </div>

            </div>





            {{-- DADOS FINANCEIROS --}}
            <div class="tab-pane fade" id="adresses" role="tabpanel" aria-labelledby="adresses-tab">

                <div class="row mt-2 pl-2">
                    <div class="col">

                        <div class="text-secondary mb-2">IBAN:</div>
                        <div class="border rounded bg-light p-3">
                            {{$client->IBAN}}
                        </div>

                        <br>

                        <div class="text-secondary mb-2">Estado financeiro:</div>
                        <div class="border rounded bg-light p-3">
                            {{-- +++++++++ Falta a lógica  ++++++++++++--}}
                            <span class="text-success">Regularizado</span>
                        </div>

                        <br>

                        <div class="text-secondary mb-2">Observações Financeiras:</div>
                        <div class="border rounded bg-light p-3">
                            @if ($client->obsFinanceiras==null)
                            <span class="text-muted"><small>(sem dados para mostrar)</small></span>
                            @else
                            {{$client->obsFinanceiras}}
                            @endif
                        </div>


                    </div>

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
