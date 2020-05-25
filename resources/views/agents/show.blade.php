@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de agente')

{{-- CSS Style Link --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

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
        <a href="{{route('agents.edit',$agent)}}" class="top-button mr-2">Editar informação</a>
        @endif

        <a href="{{route('agents.print',$agent)}}" target="_blank" class="top-button">Imprimir</a>

    </div>

    <br><br>

    <div class="cards-navigation">


        <div class="row">
            <div class="col">
                <div class="title">
                    <h6>
                        @if ($agent->tipo=="Agente")
                        Ficha de Agente
                        @else
                        Ficha de Subagente
                        @endif
                    </h6>
                </div>
            </div>
            <div class="col text-right">
                <div class="text-muted"><small>Adicionado em: {{ date('d-M-y', strtotime($agent->created_at)) }}</small>
                </div>

                <div class="text-muted"><small>Ultima atualização:
                        {{ date('d-M-y', strtotime($agent->updated_at)) }}</small></div>
            </div>
        </div>


        <br>


        <div class="card shadow-sm p-3" style="border-radius:10px">
            <div class="row p-2" style="color:#6A74C9">
                <div class="col col-md-12 text-center my-auto "
                    style="min-width:195px; max-width:230px; max-height:295px; overflow:hidden">

                    @if($agent->fotografia)
                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                        src="{{Storage::disk('public')->url('agent-documents/'.$agent->idAgente.'/').$agent->fotografia}}"
                        style="width:100%; height:auto ">
                    @elseif($agent->genero == 'F')
                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                        src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" style="width:100%">
                    @else
                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                        src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:100%">
                    @endif

                </div>

                <div class="col font-weight-bold p-2" style="min-width:280px !important">



                    {{-- Informações Pessoais --}}
                    <div><span class="text-secondary ">Nome: </span>{{$agent->nome}} {{$agent->apelido}}</div><br>

                    <div><span class="text-secondary ">Género: </span>
                        @if ($agent->genero == 'M')
                        Masculino
                        @else
                        Feminino
                        @endif
                    </div>

                    <br>

                    <div><span class="text-secondary">País:</span> {{$agent->pais}}</div>

                    <br>

                    <div><span class="text-secondary ">Data de nascimento: </span>
                        {{ date('d-M-y', strtotime($agent->dataNasc)) }}</div>

                    @if ($agent->tipo=="Subagente")
                    <br>
                    <div class="text-muted">Subagente de:
                        {{-- Apenas cria o link para o perfil do agente SE for o administrador a consultar --}}
                        @if (Auth::user()->tipo == "admin")
                        <a class="name_link" href="{{route('agents.show',$mainAgent)}}">{{$mainAgent->nome}}
                            {{$mainAgent->apelido}}</a>
                        @else
                        <span class="active">{{$mainAgent->nome}} {{$mainAgent->apelido}}</span>
                        @endif

                    </div>
                    <br>
                    @endif

                </div>

                @if (Auth::user()->tipo == "admin")
                    <div class="col" style="min-width: 320px">
                        <div class="font-weight-bold text-secondary">Observacões:</div>
                        <div class="border rounded bg-light p-2 mt-2 active" style="height:155px; width:100%; overflow: auto">
                            {{ $agent->observacoes}}
                        </div>

                    </div>
                @endif

            </div>
        </div>




        <div class="row nav nav-fill w-100 text-center mx-auto p-3 ">


            @if ( $agent->tipo == "Agente" )
            <a class="nav-item nav-link active border p-3 m-1 bg-white rounded shadow-sm name_link"
                id="subagentes-type-tab" data-toggle="tab" href="#subagentes-type" role="tab" aria-controls="agent_type"
                aria-selected="true">
                <div class="col"><i class="fas fa-share-alt mr-2"></i>Subagentes</div>
            </a>
            @endif


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link {{ $agent->tipo == "Subagente" ? 'active' : '' }}"
                id="clients-tab" data-toggle="tab" href="#clients" role="tab" aria-controls="clients"
                aria-selected="false">
                <div class="col">
                    <ion-icon name="person-circle-outline" class="mr-2"
                        style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px; right: 0px;">
                    </ion-icon>Estudantes
                </div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="documents-tab"
                data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">
                <div class="col"><i class="far fa-id-card mr-2"></i>Dados pessoais</div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="contacts-tab"
                data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">
                <div class="col"><i class="fas fa-comments mr-2"></i>Contactos</div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link border" id="financas-tab"
                data-toggle="tab" href="#financas" role="tab" aria-controls="financas" aria-selected="false">
                <div class="col"><i class="fas fa-chart-pie mr-2"></i>Financeiro</div>
            </a>


        </div>





        <div class="bg-white shadow-sm mb-4 p-4" style="margin-top:-30px">

            <div class="tab-content p-2 mt-3" id="myTabContent">



                @if ($agent->tipo == "Agente")
                {{-- SUB AGENTES --}}
                <div class="tab-pane fade show active" id="subagentes-type" role="tabpanel"
                    aria-labelledby="subagentes-type-tab">

                    @if($listagents==null)
                    <div class="border rounded bg-light p-3">
                        <div class="text-muted"><small>(sem registos)</small></div>
                    </div>
                    <br>
                    @else
                    <div class="row mx-auto" style="max-height:1000px; overflow:auto ">
                        @foreach ($listagents as $agentx)
                        <a class="name_link text-center m-2" href="{{route('agents.show',$agentx)}}">
                            <div class="col">
                                <div style="width: 200px; height:210px; overflow:hidden">
                                    @if($agentx->fotografia)
                                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                                        src="{{Storage::disk('public')->url('agent-documents/'.$agentx->idAgente.'/').$agentx->fotografia}}"
                                        style="width:100%; height:auto">
                                    @elseif($agentx->genero == 'F')
                                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                                        src="{{Storage::disk('public')->url('default-photos/F.jpg')}}"
                                        style="width:100%">
                                    @else
                                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                                        src="{{Storage::disk('public')->url('default-photos/M.jpg')}}"
                                        style="width:100%">
                                    @endif
                                </div>
                                <div class="mt-1">{{$agentx->nome}} {{$agentx->apelido}}</div>
                                <div style="margin-top:-7px"><small>({{$agentx->pais}})</small></div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endif




                {{-- Clientes --}}
                <div class="tab-pane fade {{ $agent->tipo == 'Subagente' ? 'show active' : '' }}" id="clients" role="tabpanel" aria-labelledby="clients-tab">

                    @if($clients)


                    <div class="row">

                        <div class="col">
                            <div class="text-secondary">Existe {{count($clients)}} estudante(s) associados a este agente</div>
                            <br>
                            {{-- Input de procura nos resultados da dataTable --}}
                            <input type="text" class="shadow-sm" id="customSearchBox" placeholder="Procurar nos resultados..." aria-label="Procurar">
                        </div>

                        <div class="col col-2 text-center" style="max-width: 130px">
                            <a class="name_link " href="{{route('clients.searchIndex')}}">
                                <div class="bg-light border shadow-sm p-2">
                                    <div><i class="fas fa-search" style="font-size:30px"></i></div>
                                    <div>Pesquisa avançada</div>
                                </div>
                            </a>
                        </div>

                    </div>


                    <br>


                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-hover " style="width:100%">

                            {{-- Cabeçalho da tabela --}}
                            <thead>
                                <tr>
                                    <th class="text-center align-content-center ">Foto</th>
                                    <th>Nome</th>
                                    <th>N.º Passaporte</th>
                                    <th>País</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                            </thead>

                            {{-- Corpo da tabela --}}
                            <tbody>

                                @foreach ($clients as $client)
                                <tr>
                                    <td>
                                        <div class="align-middle mx-auto shadow-sm rounded bg-white"
                                            style="overflow:hidden; width:50px; height:50px">
                                            <a class="name_link" href="{{route('clients.show',$client)}}">
                                                @if($client->fotografia)
                                                <img src="{{Storage::disk('public')->url('client-documents/'.$client->idCliente.'/').$client->fotografia}}"
                                                    width="100%" class="mx-auto">
                                                @elseif($client->genero == 'F')
                                                <img src="{{Storage::disk('public')->url('default-photos/F.jpg')}}"
                                                    width="100%" class="mx-auto">
                                                @else
                                                <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}"
                                                    width="100%" class="mx-auto">
                                                @endif
                                            </a>
                                        </div>

                                    </td>

                                    {{-- Nome e Apelido --}}
                                    <td class="align-middle"><a class="name_link"
                                            href="{{route('clients.show',$client)}}">{{ $client->nome }}
                                            {{ $client->apelido }}</a></td>

                                   {{-- numPassaporte --}}
                                    <td class="align-middle">{{ $client->numPassaporte }}</td>

                                    {{-- paisNaturalidade --}}
                                    <td class="align-middle">{{ $client->paisNaturalidade }}</td>


                                    {{-- OPÇÔES --}}
                                    <td class="text-center align-middle">
                                        <a href="{{route('clients.show',$client)}}" class="btn_list_opt "
                                            title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                                        <a href="{{route('clients.edit',$client)}}"
                                            class="btn_list_opt btn_list_opt_edit" title="Editar"><i
                                                class="fas fa-pencil-alt mr-2"></i></a>
                                        {{--
                                    <form method="POST" role="form" id="{{ $client->idCliente }}"
                                        action="{{route('clients.destroy',$client)}}" data="{{ $client->nome }}
                                        {{ $client->apelido }}" class="d-inline-block form_client_id">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn_delete" title="Eliminar estudante"
                                            data-toggle="modal" data-target="#deleteModal"><i
                                                class="fas fa-trash-alt"></i></button>
                                        </form> --}}

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="border rounded bg-light p-3">
                        <div class="text-muted"><small>(sem registos)</small></div>
                    </div>
                    <br>
                    @endif
                </div>





                {{-- Dados pessoais --}}
                <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">

                    <div class="row">

                        <div class="col">


                            <div class="text-secondary mb-2">Número de identificação pessoal:</div>

                            <div class="border rounded bg-light p-3">
                                <div>{{$agent->num_doc}}</div>
                            </div>

                            <br>

                            <div class="text-secondary mb-2">Número de identificação fiscal:</div>

                            <div class="border rounded bg-light p-3">
                                <div>{{$agent->NIF}}</div>
                            </div>

                            <br>

                        </div>

                        {{-- Documento de identificação --}}
                        <div class="col text-center" style="min-width: 240px">
                            <div class="card rounded shadow-sm m-2 p-3 h-100">
                                @if ($agent->img_doc)
                                <a class="name_link my-auto" target="_blank"
                                    href="{{Storage::disk('public')->url('agent-documents/'.$agent->idAgente.'/').$agent->img_doc}}">

                                    <i class="far fa-id-card" style="font-size:40px"></i><br>
                                    <div>Ver documento de identificação</div>
                                </a>
                                @else
                                <a href="{{route('agents.edit',$agent)}}" class="mt-2 name_link my-auto"><small
                                        class="text-danger mt-2">
                                        <i class="far fa-id-card" style="font-size:40px"></i><br>
                                        <strong>Sem documento de identificação</strong></small>
                                </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>






                {{-- Contactos --}}
                <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="documents-tab">
                    <div class="row">

                        <div class="col">
                            <div class="text-secondary mb-2">E-mail:</div>

                            <div class="border rounded bg-light p-3">
                                <div>{{$agent->email}}</div>
                            </div>

                        </div>
                    </div>

                    <br>


                    <div class="row">

                        <div class="col">

                            <div class="text-secondary mb-2">País:</div>

                            <div class="border rounded bg-light p-3">
                                <div>{{$agent->pais}}</div>
                            </div>

                            <br>

                            <div class="text-secondary mb-2">Morada:</div>

                            <div class="border rounded bg-light p-3">
                                <div>{{$agent->morada}}</div>

                            </div>


                        </div>


                        <div class="col">

                            <div class="text-secondary mb-2">Telefone principal:</div>

                            <div class="border rounded bg-light p-3">
                                <div>{{$agent->telefone1}}</div>
                            </div>

                            <br>

                            @if ($telefone2)
                            <div class="text-secondary mb-2">Telefone alternativo:</div>

                            <div class="border rounded bg-light p-3">
                                <div>{{$telefone2}}</div>
                            </div>
                            <br>
                            @endif

                        </div>

                    </div>
                </div>



                {{-- Finaneiro --}}
                <div class="tab-pane fade" id="financas" role="tabpanel" aria-labelledby="financas-tab">
                    <div class="row">

                        <div class="col">

                            <div class="text-secondary mb-2">IBAN:</div>

                            <div class="border rounded bg-light p-3">
                                <div>
                                    @if ($IBAN)
                                    {{$IBAN}}
                                    @else
                                    <div class="text-muted"><small>(sem dados para mostrar)</small></div>
                                    @endif
                                </div>
                            </div>

                            <br>




                            <div class="text-secondary mb-2">Total de comissões:</div>

                            <div class="border rounded bg-light p-3">
                                <div>
                                    @if ($comissoes)
                                    {{$comissoes}}€
                                    @else
                                    <div class="text-muted"><small>(sem dados para mostrar)</small></div>
                                    @endif
                                </div>
                            </div>



                        </div>

                    </div>
                </div>





            </div>

        </div>


    </div>

    <br><br>

</div>

@endsection

{{-- Scripts --}}
@section('scripts')
<script src="{{asset('/js/agent_show.js')}}"></script>
@endsection
