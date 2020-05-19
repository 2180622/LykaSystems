@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Agentes')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">

@endsection


{{-- Conteudo da Página --}}
@section('content')
@include('agents.partials.modal')
<!-- MODAL DE INFORMAÇÔES -->

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
        <a href="{{route('report')}}" class="top-button mr-2">reportar problema</a>
        @if (Auth::user()->tipo == "admin")
            <a href="{{route('agents.create')}}" class="top-button">Adicionar Agente</a>
        @endif
    </div>

    <br><br>


    <div class="cards-navigation">
        <div class="title">
            <h6>Listagem de @if (Auth::user()->tipo == "agente")
                {{-- se for agente --}}
                Sub agentes
                @else
                {{-- se for admin --}}
                Agentes
                @endif
            </h6>
        </div>
        <br>

        <div class="row mt-3 mb-3">
            <div class="col">
                <div class="text-center"><small>Existem <strong>{{$totalagents}}</strong> registo(s) no sistema</small></div>
            </div>
        </div>


        <div class="row p-3 ">
            {{--                              <div class="col">
                                        <span class="mr-2">Mostrar</span>
                                        <select class="custom-select" id="records_per_page" style="width:80px">
                                            <option selected>10</option>
                                            <option>25</option>
                                            <option>50</option>
                                            <option>100</option>
                                        </select>
                                        <span class="ml-2">por página</span>
                                    </div> --}}
                                    <div class="col text-center mb-3">
                                        <div class="input-group pl-0  search-section mx-auto" style="width:50%">
                                            <input class="shadow-sm" type="text" id="customSearchBox" placeholder="Secção de procura"
                                                aria-label="Procurar">
                                            <div class="search-button input-group-append">
                                                <ion-icon name="search-outline" class="search-icon"></ion-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        <br>
        <hr>


        <div class="table-responsive " style="overflow:hidden">


            <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0"
                style="overflow:hidden;">

                {{-- Cabeçalho da tabela --}}
                <thead>
                    <tr>
                        <th class="text-center align-content-center ">Foto</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        {{-- <th>E-mail</th> --}}
                        <th>País</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>

                {{-- Corpo da tabela --}}
                <tbody>

                    @foreach ($agents as $agent)
                    <tr>
                        <td>
                            <div class="align-middle mx-auto shadow-sm rounded  bg-white"
                                style="overflow:hidden; width:50px; height:50px">
                                <a class="name_link" href="{{route('agents.show',$agent)}}">
                                    @if($agent->fotografia)
                                    <img src="{{Storage::disk('public')->url('agent-documents/'.$agent->idAgente.'/').$agent->fotografia}}"
                                        width="100%" class="mx-auto">
                                    @elseif($agent->genero == 'F')
                                    <img src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" width="100%"
                                        class="mx-auto">
                                    @else
                                    <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%"
                                        class="mx-auto">
                                    @endif
                                </a>
                            </div>

                        </td>

                        {{-- Nome e Apelido --}}
                        <td class="align-middle"><a class="name_link"
                                href="{{route('agents.show',$agent)}}">{{ $agent->nome }} {{ $agent->apelido }}</a></td>

                        {{-- Tipo --}}
                        <td class="align-middle">{{ $agent->tipo }}</td>

                        {{-- e-mail --}}
                        {{-- <td class="align-middle">{{ $agent->email }}</td> --}}

                        {{-- País --}}
                        <td class="align-middle">{{ $agent->pais }}</td>


                        {{-- OPÇÔES --}}
                        <td class="text-center align-middle">
                            <a href="{{route('agents.show',$agent)}}" class="btn_list_opt "
                                title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                            <a href="{{route('agents.edit',$agent)}}" class="btn_list_opt btn_list_opt_edit"
                                title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                            <form method="POST" role="form" id="{{ $agent->idAgente }}"
                                action="{{route('agents.destroy',$agent)}}"
                                data="{{ $agent->nome }} {{ $agent->apelido }}" class="d-inline-block form_agent_id">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn_delete" title="Eliminar agente" data-toggle="modal"
                                    data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
                            </form>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>



    </div>
</div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/agent.js')}}"></script>

@endsection
