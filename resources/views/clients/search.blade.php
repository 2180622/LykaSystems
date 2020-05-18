@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Pesquisar Base de Dados')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
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
        <a href="#" class="top-button">reportar problema</a>
    </div>

    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Pesquisar Base de Dados</h6>
        </div>

        <br>


        {{-- Menu de navegação --}}

        <div class="row nav nav-fill w-100 text-center mx-auto p-3 ">

            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="allcontacts-tab"
                href="{{route('clients.index')}}">
                <div class="col"><i class="fas fa-users mr-2"></i>Lista de estudantes</div>
            </a>


            <a class="nav-item nav-link active border p-3 m-1 bg-white rounded shadow-sm active "
                id="pesquisaContactos-tab" data-toggle="tab" href="#" role="tab" aria-controls="pesquisaContactos"
                aria-selected="true">
                <div class="col"><i class="fas fa-search mr-2"></i>Pesquisar Base de Dados</div>
            </a>

        </div>




        <div class="bg-white shadow-sm mb-4 p-4 " style="border-radius:10px; margin-top:-30px">

            <div class="tab-content p-2 mt-3 " id="myTabContent">

                {{-- Conteudo: Pesquisa --}}
                <div class="tab-pane fade text-secondary show active" id="pesquisaContactos" role="tabpanel"
                    aria-labelledby="pesquisaContactos-tab">
                    {{-- Formulário de pesquisa --}}

                    <form method="POST" class="form-group" >


                        <div class="row mx-1 p-3 border rounded bg-light ">

                            <div class="col col-3 p-2 mr-2" style="width:220px!important; min-width:220px">
                                <div>Pesquisar aluno por:</div>
                                <select id="search_options" name="search_options" class="custom-select mt-2">
                                    <option value="País de origem" selected>País de origem</option>
                                    <option value="Cidade de origem">Cidade de origem</option>
                                    <option value="Instituição de origem">Instituição de origem</option>
                                    <option value="Agente">Agente</option>
                                    <option value="Universidade">Universidade</option>
                                    <option value="Nível de estudos">Nível de estudos</option>
                                    <option value="Estado de cliente">Estado de cliente</option>
                                </select>
                            </div>





                            {{-- A pesquisa por filtro só esta disponivel para os admins --}}

                            <div class="col p-2" id="searchfields">

                                {{-- Pesquisa por País de origem --}}
                                <div id="divPaisOrigem">
                                    <span>Selecione o País de Origem:</span>
                                    <select id="paisNaturalidade" name="paisNaturalidade" class="custom-select mt-2" style="width:100%">
                                        @include('clients.partials.countries');
                                    </select>
                                </div>


                                {{-- Pesquisa por cidade de origem --}}
                                <div id="divCidade" style="display: none">
                                    <span >Selecione a Cidade de Origem:</span>
                                    <select id="cidade" name="cidade" class="custom-select mt-2" style="width:100%">
                                        @if(!empty($cidadesOrigem) )
                                            <option selected hidden>Selecione a cidade de origem</option>
                                            @foreach ($cidadesOrigem as $cidade)
                                                <option value="{{$cidade}}">{{$cidade}}</option>
                                            @endforeach
                                        @else
                                            <option selected hidden value="0">Sem registos</option>
                                        @endif
                                    </select>
                                </div>


                                {{-- Pesquisa por Instituição de origem --}}
                                <div id="divInstituicaoOrigem"{{--  style="display: none" --}}>
                                    <span>Selecione a Instituição de Origem:</span>
                                    <select id="nomeInstituicaoOrigem" name="nomeInstituicaoOrigem" class="custom-select mt-2" style="width:100%">
                                        @if(!empty($cidadesOrigem) )
                                            <option selected hidden>Selecione a Instituição de origem</option>
                                            @foreach ($instituicoesOrigem as $instituição)
                                                <option value={{$instituição}}>{{$instituição}}</option>
                                            @endforeach
                                        @else
                                            <option selected hidden value="0">Sem registos</option>
                                        @endif
                                    </select>
                                </div>


                                {{-- Pesquisa por Agente --}}
                                <div id="divAgents" style="display: none">
                                    <span>Selecione o Agente:</span>
                                    <select id="agente" name="agente" class="custom-select mt-2" style="width:100%">
                                        @if( $agents )
                                            <option selected hidden>Selecione o Agente</option>
                                            @foreach ($agents as $agent)
                                                <option value="{{$agent->idAgente}}">{{$agent->nome}} {{$agent->apelido}} ({{$agent->pais}})</option>
                                            @endforeach
                                        @else
                                            <option selected hidden value="0">Sem registos</option>
                                        @endif
                                    </select>
                                </div>

                                {{-- Pesquisa por Universidades --}}
                                <div id="divUniversidades" style="display: none">
                                    <span >Selecione a Universidade:</span>
                                    <select id="universidades" name="universidades" class="custom-select mt-2" style="width:100%">
                                        @if( $universidades )
                                            <option selected hidden>Selecione a Universidade</option>
                                            @foreach ($universidades as $universidade)
                                                <option value="{{$universidade->idUniversidade}}">{{$universidade->nome}}</option>
                                            @endforeach
                                        @else
                                            <option selected hidden value="0">Sem registos</option>
                                        @endif
                                    </select>
                                </div>


                                {{-- Pesquisa por Nivel de estudos --}}
                                <div id="divNivelEstudos" style="display: none">
                                    <span >Selecione a Universidade:</span>
                                    <select id="nivelEstudos" name="nivelEstudos" class="custom-select mt-2" style="width:100%">
                                        <option value="0" value="0" selected hidden>Selecione Nível de Estudos</option>
                                        <option value="1">Secundário Incompleto</option>
                                        <option value="2">Secundário completo</option>
                                        <option value="3">Curso tecnologico</option>
                                        <option value="4">Estuda na universidade</option>
                                        <option value="5">Licenciado</option>
                                        <option value="6">Mestrado</option>
                                    </select>
                                </div>




                                {{-- Pesquisa Estado de cliente --}}
                                <div id="divEstadoCliente" style="display: none">
                                    <span >Selecione o estado do cliente:</span>
                                    <select id="estado" name="estado" class="custom-select mt-2" style="width:100%">
                                        <option hidden value="0" >Selecione o Estado do Cliente</option>
                                        <option value="Ativo">Ativo</option>
                                        <option value="Inativo">Inativo</option>
                                        <option value="Proponente">Proponente</option>
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






        @if(isset($resultados) && $resultados !=null)


        <div class="col">Existem <strong>{{count($clients)}}</strong> registo(s) no sistema</div>

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


        @else

            <div class="border rounded bg-light p-3 mx-2">
                <div class="text-muted"><small>(sem registos)</small></div>
            </div>
            <br>

        @endif
















        </div>




    </div>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')

{{-- script contem: datatable configs, input configs, validações --}}
<script src="{{asset('/js/client_search.js')}}"></script>

{{-- script permite definir se um input recebe só numeros OU so letras --}}

@endsection
