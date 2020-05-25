@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Agentes')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

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
        <a href="{{route('agents.create')}}" class="top-button">Adicionar Agente</a>
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

        <div class="bg-white shadow-sm mb-4 p-4 " style="border-radius:10px;">

            @if($agents==null)

            <div class="border rounded bg-light p-3 text-muted"><small>(sem registos)</small></div>


            @else

            <div class="row mx-1">
                <div class="col col-2" style="max-width: 120px">
                    <i class="fas fa-user-tie active" style="font-size:80px"></i>
                </div>
                <div class="col">
                    <div class="text-secondary"><strong>Existe {{$totalagents}} registo(s) no sistema</strong></div>
                    <br>
                    {{-- Input de procura nos resultados da dataTable --}}

                    <div style="width: 100%; border-radius:10px;">
                        <input type="text" class="shadow-sm" id="customSearchBox"
                            placeholder="Procurar nos resultados..." aria-label="Procurar">

                    </div>
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
                                    href="{{route('agents.show',$agent)}}">{{ $agent->nome }}
                                    {{ $agent->apelido }}</a>
                            </td>

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
                                    data="{{ $agent->nome }} {{ $agent->apelido }}"
                                    class="d-inline-block form_agent_id">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn_list_opt btn_delete" title="Eliminar agente"
                                        data-toggle="modal" data-target="#deleteModal"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>


            @endif


        </div>

    </div>
</div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/agent.js')}}"></script>

@endsection
