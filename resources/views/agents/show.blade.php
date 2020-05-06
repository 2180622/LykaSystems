@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de agente')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">

<link href="{{asset('css/agents.css')}}" rel="stylesheet">

@endsection
{{-- Page Content --}}
@section('content')

@php

$tipo_agent_atual=$agent->tipo;

@endphp

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
        @if ( Auth::user()->tipo == "admin")
        <a href="{{route('agents.edit',$agent)}}" class="top-button mr-2">Editar informação</a>
        <a href="{{route('agents.print',$agent)}}" target="_blank" class="top-button">Imprimir</a>
        @endif
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
            <div class="row font-weight-bold p-2" style="color:#6A74C9">
                <div class="col col-md-12 text-center my-auto "
                    style="min-width:195px; max-width:290px; max-height:295px; overflow:hidden">

                    @if($agent->fotografia)
                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                        src="{{Storage::disk('public')->url('agent-documents/'.$agent->idAgente.'/').$agent->fotografia}}"
                        style="width:100%; ">
                    @elseif($agent->genero == 'F')
                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                        src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" style="width:100%">
                    @else
                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                        src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:100%">
                    @endif

                </div>

                <div class="col p-2" style="min-width:280px !important">

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
                        {{ date('d-M-y', strtotime($agent->dataNasc)) }}</div><br>

                    @if ($agent->tipo=="Subagente")
                    <br>
                    <div class="text-muted">Subagente de: <a class="agent_link"
                            href="{{route('agents.show',$mainAgent)}}">{{$mainAgent->nome}} {{$mainAgent->apelido}}</a>
                    </div>
                    <br>
                    @endif

                </div>

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


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link {{ $tipo_agent_atual == "Subagente" ? 'active' : '' }}" id="clients-tab"
                data-toggle="tab" href="#clients" role="tab" aria-controls="clients" aria-selected="false">
                <div class="col"><ion-icon name="person-circle-outline" class="mr-2" style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px; right: 0px;"></ion-icon>Estudantes
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


                @if ( Auth::user()->tipo == "admin" || Auth::user()->agente->tipo == "Agente" )
                    @if ($agent->tipo == "Agente")
                    {{-- SUB AGENTES --}}
                    <div class="tab-pane fade show active" id="subagentes-type" role="tabpanel" aria-labelledby="subagentes-type-tab">

                                @if($listagents==null)
                                    <div class="border rounded bg-light p-3">
                                        <div class="text-muted"><small>(sem registos)</small></div>
                                    </div>
                                    <br>
                                @else
                                    <div class="row">
                                        @foreach ($listagents as $agent)
                                            <a class="name_link text-center m-2" href="{{route('agents.show',$agent)}}">
                                                <div class="col">
                                                    <div style="width: 200px; height:210px; overflow:hidden">
                                                        @if($agent->fotografia)
                                                            <img class="align-middle p-1 rounded bg-white shadow-sm border"
                                                                src="{{Storage::disk('public')->url('agent-documents/'.$agent->idAgente.'/').$agent->fotografia}}"
                                                                style="width:100%; height:100%">
                                                            @elseif($agent->genero == 'F')
                                                            <img class="align-middle p-1 rounded bg-white shadow-sm border"
                                                                src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" style="width:100%">
                                                            @else
                                                            <img class="align-middle p-1 rounded bg-white shadow-sm border"
                                                                src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:100%">
                                                        @endif
                                                    </div>
                                                    <div class="mt-2">{{$agent->nome}} {{$agent->apelido}}</div>
                                                    <div ><small>({{$agent->pais}})</small></div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                    </div>
                    @endif
                @endif




            {{-- Clientes --}}
            <div class="tab-pane fade {{ $tipo_agent_atual == 'Subagente' ? 'show active' : '' }}" id="clients" role="tabpanel" aria-labelledby="clients-tab">

                <div class="row">

                    <div class="col">

                        @if($clients==null)
                                <div class="border rounded bg-light p-3">
                                    <div class="text-muted"><small>(sem registos)</small></div>
                                </div>
                                <br>
                            @else
                                <div class="row">
                                    @foreach ($clients as $client)
                                        <a class="name_link text-center m-2" href="{{route('clients.show',$client)}}">
                                            <div class="col">
                                                <div style="width: 200px; height:210px; overflow:hidden">
                                                    @if($client->fotografia)
                                                        <img class="align-middle p-1 rounded bg-white shadow-sm border"
                                                            src="{{Storage::disk('public')->url('client-documents/'.$client->idCliente.'/').$client->fotografia}}"
                                                            style="width:100%; height:100% ">
                                                        @elseif($client->genero == 'F')
                                                        <img class="align-middle p-1 rounded bg-white shadow-sm border"
                                                            src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" style="width:100%">
                                                        @else
                                                        <img class="align-middle p-1 rounded bg-white shadow-sm border"
                                                            src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:100%">
                                                    @endif
                                                </div>
                                                <div class="mt-2">{{$client->nome}} {{$client->apelido}}</div>
                                                <div ><small>({{$client->paisNaturalidade}})</small></div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                    </div>

                </div>
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

                    </div>

                    {{-- Documento de identificação --}}
                    <div class="col text-center" style="min-width: 240px">
                        @if (Auth::user()->tipo == "admin")
                            <div class="card rounded shadow-sm m-2 p-3 h-100">
                                @if ($agent->img_doc)
                                    <a class="name_link my-auto" target="_blank" href="{{Storage::disk('public')->url('agent-documents/'.$agent->idAgente.'/').$agent->img_doc}}">

                                            <i class="far fa-id-card" style="font-size:40px"></i><br>
                                            <div>Ver documento de identificação</div>
                                    </a>
                                @else
                                    <a href="{{route('agents.edit',$agent)}}" class="mt-2 agent_link my-auto"><small class="text-danger mt-2">
                                            <i class="far fa-id-card" style="font-size:40px"></i><br>
                                            <strong>Sem documento de identificação</strong></small>
                                    </a>
                                @endif
                            </div>
                        @endif
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
{{-- <script src="{{asset('/js/agent.js')}}"></script> --}}
@endsection
