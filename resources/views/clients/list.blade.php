@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Estudantes')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

@endsection


{{-- Conteudo da Página --}}
@section('content')
@include('clients.partials.modal')
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
        <a href="{{route('clients.create')}}" class="top-button">Adicionar Estudante</a>
        @endif

    </div>

    <br><br>


    <div class="cards-navigation">
        <div class="title">
            <h6>Listagem de Estudantes</h6>
        </div>

        <br>



        {{-- Menu de navegação --}}
        <div class="row nav nav-fill w-100 text-center mx-auto p-3 ">

            <a class="nav-item nav-link active border p-3 m-1 bg-white rounded shadow-sm name_link" id="allcontacts-tab"
                data-toggle="tab" href="#allcontacts" role="tab" aria-controls="allcontacts" aria-selected="true">
                <div class="col"><i class="fas fa-users mr-2"></i>Lista de estudantes</div>
            </a>


            @if (Auth::user()->tipo == "admin")
                <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="pesquisaContactos-tab" href="{{route('clients.searchIndex')}}" >
                    <div class="col"><i class="fas fa-search mr-2"></i>Pesquisar Base de Dados</div>
                </a>
            @endif

        </div>




        <div class="bg-white shadow-sm mb-4 p-4 " style="border-radius:10px; margin-top:-30px">



            <div class="tab-content p-2 mt-3 " id="myTabContent">


                {{-- Conteudo: Todos os contactos --}}
                <div class="tab-pane fade show active text-secondary" id="allcontacts" role="tabpanel" aria-labelledby="agent-type-tab">
                    @if($clients==null)
                        <div class="border rounded bg-light p-3">
                            <div class="text-muted"><small>(sem registos)</small></div>
                        </div>
                        <br>
                    @else

                    <div class="row mt-3 mb-3">
                        <div class="col">
                            <div class="text-center"><small>Existem <strong>{{count($clients)}}</strong> registo(s) no sistema</small></div>
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
                                    <th>N.º Passaporte</th>
                                    <th>Estado</th>
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
                                            href="{{route('clients.show',$client)}}">{{ $client->nome }} {{ $client->apelido }}</a>
                                    </td>

                                    {{-- numPassaporte --}}
                                    <td class="align-middle">{{ $client->numPassaporte }}</td>

                                    {{-- Estado de cliente --}}
                                    <td class="align-middle">

                                        @if ( $client->estado == "Ativo")
                                        <span class="text-success">Ativo</span>
                                        @elseif( $client->estado == "Inativo")
                                        <span class="text-danger">Inativo</span>
                                        @else
                                        <span class="text-info">Proponente</span>
                                        @endif

                                    </td>


                                    {{-- OPÇÔES --}}
                                    <td class="text-center align-middle">
                                        <a href="{{route('clients.show',$client)}}" class="btn_list_opt "
                                            title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>


                                        {{-- Permissões para editar --}}
                                        @if (Auth::user()->tipo == "admin" || Auth::user()->tipo == "agente" && $client->editavel ==
                                        1)
                                        <a href="{{route('clients.edit',$client)}}" class="btn_list_opt btn_list_opt_edit"
                                            title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>
                                        @endif


                                        @if (Auth::user()->tipo == "admin")
                                        <form method="POST" role="form" id="{{ $client->idCliente }}"
                                            action="{{route('clients.destroy',$client)}}"
                                            data="{{ $client->nome }} {{ $client->apelido }}" class="d-inline-block form_client_id">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn_delete" title="Eliminar estudante" data-toggle="modal"
                                                data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                        @endif

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

    </div>
</div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/clients.js')}}"></script>

@endsection
