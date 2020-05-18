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

                    <form class="form-group">


                        <div class="row mx-1 p-3 border rounded bg-light">

                            <div class="col col-3 p-2 mr-2" style="width:220px!important; min-width:220px">
                                <div class="mb-2">Pesquisar aluno por:</div>
                                <select id="search_options" name="search_options" class="custom-select">
                                    <option value="0" selected>País de origem</option>
                                    <option value="0">Cidade de origem</option>
                                    <option value="0">Instituição de origem</option>
                                    <option value="0">Agente</option>
                                    <option value="0">Subagente</option>
                                    <option value="0">Universidade</option>
                                </select>
                            </div>


                            {{-- A pesquisa por filtro só esta disponivel para os admins --}}

                            <div class="col p-2">

                                {{-- Pesquisa por País de origem --}}
                                <div id="divPaisOrigem">
                                    <div class="mb-2">Selecione o País de Origem:</div>
                                    <select id="paisNaturalidade" name="paisNaturalidade" class="custom-select" style="width:100%">
                                        @include('clients.partials.countries');
                                    </select>
                                </div>


                                {{-- Pesquisa por cidade de origem --}}
                                <div id="divCidade" {{-- style="display: none" --}}>
                                    <span class="mb-2">Selecione a Cidade de Origem:</span>
                                    <select id="cidade" name="cidade" class="custom-select" style="width:100%">
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
                                    <span class="mb-2">Selecione a Instituição de Origem:</span>
                                    <select id="nomeInstituicaoOrigem" name="nomeInstituicaoOrigem" class="custom-select" style="width:100%">
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
                                <div id="divAgents" {{-- style="display: none" --}}>
                                    <span class="mb-2">Selecione o Agente:</span>
                                    <select id="agente" name="agente" class="custom-select" style="width:100%">
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


                                {{-- Pesquisa por Subagente --}}
                                <div id="divSubAgents" {{-- style="display: none" --}}>
                                    <span class="mb-2">Selecione o Subagente:</span>
                                    <select id="subagente" name="subagente" class="custom-select" style="width:100%">
                                        @if( $subagents )
                                            <option selected hidden>Selecione o Subagente</option>
                                            @foreach ($subagents as $subagent)
                                                <option value="{{$agent->idAgente}}">{{$subagent->nome}} {{$subagent->apelido}} ({{$subagent->pais}})</option>
                                            @endforeach
                                        @else
                                            <option selected hidden value="0">Sem registos</option>
                                        @endif
                                    </select>
                                </div>


                                {{-- Pesquisa por Universidades --}}
                                <div id="divuniversidades" {{-- style="display: none" --}}>
                                    <span class="mb-2">Selecione a Universidade:</span>
                                    <select id="universidades" name="universidades" class="custom-select" style="width:100%">
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


                                <a id="test_link">TESTEEEEEEEEEE</a>





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

{{-- Scripts --}}
@section('scripts')

{{-- script contem: datatable configs, input configs, validações --}}
<script src="{{asset('/js/client_search.js')}}"></script>

{{-- script permite definir se um input recebe só numeros OU so letras --}}

@endsection
