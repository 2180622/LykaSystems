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




        <div class="row nav nav-fill w-100 text-center mx-auto p-3 ">

            <a class="nav-item nav-link active border p-3 m-1 bg-white rounded shadow-sm name_link" id="allcontacts-tab"
                data-toggle="tab" href="#allcontacts" role="tab" aria-controls="allcontacts" aria-selected="true">
                <div class="col"><i class="fas fa-users mr-2"></i>Listagem completa</div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="pesquisaContactos-tab" data-toggle="tab"
                href="#pesquisaContactos" role="tab" aria-controls="pesquisaContactos" aria-selected="false">
                <div class="col"><i class="fas fa-search mr-2"></i>Pesquisar base de dados</div>
            </a>

        </div>




        <div class="bg-white shadow-sm mb-4 p-4 " style="border-radius:10px; margin-top:-30px">



            <div class="tab-content p-2 mt-3 " id="myTabContent">


                {{-- Conteudo: Todos os contactos --}}
                <div class="tab-pane fade show active text-secondary" id="allcontacts" role="tabpanel" aria-labelledby="agent-type-tab">
                    <div class="row">
                        <div class="col">Existem <strong>{{count($clients)}}</strong> registo(s) no sistema</div>
                    </div>

                    @if($clients==null)
                    <div class="border rounded bg-light p-3">
                        <div class="text-muted"><small>(sem registos)</small></div>
                    </div>
                    <br>
                    @else

                    <div class="row mt-3 mb-4 row mx-1 p-3 border rounded bg-light">
                        <div class="col">
                            <span class="mr-2">Mostrar</span>
                            <select class="custom-select" id="records_per_page" style="width:80px">
                                <option selected>10</option>
                                <option>25</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                            <span class="ml-2">por página</span>
                        </div>
                        <div class="col ">
                            <div class="input-group pl-0 float-right search-section" style="width:250px">
                                <input class="shadow-sm" type="text" id="customSearchBox" placeholder="Secção de procura"
                                    aria-label="Procurar">
                                <div class="search-button input-group-append">
                                    <ion-icon name="search-outline" class="search-icon"></ion-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>


                    <div class="table-responsive " style="overflow:hidden">


                        <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0"
                            style="overflow:hidden;">

                            {{-- Cabeçalho da tabela --}}
                            <thead>
                                <tr>
                                    <th class="text-center align-content-center ">Foto</th>
                                    <th>Nome</th>
                                    <th>Naturalidade</th>
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

                                    {{-- paisNaturalidade --}}
                                    <td class="align-middle">{{ $client->paisNaturalidade }}</td>

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



                {{-- Conteudo: Pesquisa --}}
                <div class="tab-pane fade text-secondary" id="pesquisaContactos" role="tabpanel" aria-labelledby="pesquisaContactos-tab">
            {{-- Formulário de pesquisa --}}
            <form class="form-group">
                <div class="row mx-1 p-3 border rounded bg-light">

                        <div class="col col-3 p-2 mr-2" style="width:220px!important; min-width:220px">
                            <div class="mb-2">Pesquisar aluno por:</div>
                            <select id="search_options" name="search_options" class="custom-select">
                                <option value="0" selected>País de origem</option>
                                <option value="0" >Cidade de origem</option>
                                <option value="0" >Instituição de origem</option>
                                <option value="0" >Agente</option>
                                <option value="0" >Universidade</option>
                            </select>
                        </div>


                        <div class="col p-2">

                            {{-- Pesquisa por País de origem --}}
                            <div id="divPaisOrigem">
                                <div class="mb-2">Selecione:</div>
                                <select id="paisNaturalidade" name="paisNaturalidade" class="custom-select"
                                    style="width:100%">
                                    @include('clients.partials.countries');
                                </select>
                            </div>

                            {{-- Pesquisa por cidade de origem --}}
                            <div id="divCidade" style="display: none">
                                <span>Selecione:</span>
                                <select id="cidade" name="cidade" class="select_style custom-select ml-2"
                                    style="width:350px">
                                    @include('clients.partials.countries');
                                </select>
                            </div>

                            {{-- Pesquisa por Instituição de origem --}}
                            <div id="divInstituicaoOrigem" style="display: none">
                                <span>Selecione:</span>
                                <select id="nomeInstituicaoOrigem" name="nomeInstituicaoOrigem" class="select_style custom-select ml-2"
                                    style="width:350px">
                                    @include('clients.partials.countries');
                                </select>
                            </div>

                            {{-- Pesquisa por Instituição de origem --}}
                            <div id="divInstituicaoOrigem" style="display: none">
                                <span>Selecione:</span>
                                <select id="nomeInstituicaoOrigem" name="nomeInstituicaoOrigem" class="select_style custom-select ml-2"
                                    style="width:350px">
                                    @include('clients.partials.countries');
                                </select>
                            </div>

                            {{-- Pesquisa por Instituição de origem --}}
                            <div id="divInstituicaoOrigem" style="display: none">
                                <span>Selecione:</span>
                                <select id="nomeInstituicaoOrigem" name="nomeInstituicaoOrigem" class="select_style custom-select ml-2"
                                    style="width:350px">
                                    @include('clients.partials.countries');
                                </select>
                            </div>


                        </div>

                        <div class="col col-2 text-center align-self-center " style="width: 80px; min-width: 80px;">

                                <a href="#" class="top-button px-4 ">Pesquisar</a>

                        </div>

                </div>
            </form>
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
