@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Pesquisar Base de Dados')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')
@include('clients.partials.modal')


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

    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Pesquisar Base de Dados</h6>
        </div>

        <br>


        <div class="bg-white shadow-sm  mb-4 p-4 " style="border-radius:10px">


            {{-- Formulário de pesquisa --}}

            <form method="POST" id="searchForm" action="{{route('clients.searchResults')}}" class="form-group"
                enctype="multipart/form-data">
                @csrf

                <div class="row mx-1">

                    <div class="col" style="max-width: 120px">
                        <i class="fas fa-search active pt-4" style="font-size:80px"></i>
                    </div>

                    <div class="col text-secondary font-weight-bold" style="min-width:220px">
                        <div>Pesquisar estudante por:</div>
                        <select id="search_options" name="search_options" class="custom-select select_style mt-2">
                            <option value="País de origem" selected>País de origem</option>
                            <option value="Cidade de origem">Cidade de origem</option>
                            <option value="Instituição de origem">Instituição de origem</option>
                            <option value="Agente">Agente</option>
                            <option value="Universidade">Universidade</option>
                            <option value="Nível de estudos">Nível de estudos</option>
                            <option value="Estado de cliente">Estado de cliente</option>
                        </select>

                        <br><br>



                        <div id="searchfields" style="min-width: 295px">

                            {{-- Pesquisa por País de origem --}}
                            <div id="divPaisOrigem">
                                <span>Selecione o País de Origem:</span>
                                <select id="paisNaturalidade" name="paisNaturalidade"
                                    class="custom-select select_style mt-2" style="width:100%">
                                    @if(!empty($paises) )
                                    <option selected hidden>Selecione o País de Origem</option>
                                    @foreach ($paises as $pais)
                                    <option value="{{$pais}}">{{$pais}}</option>
                                    @endforeach
                                    @else
                                    <option selected hidden value="0">Sem registos</option>
                                    @endif
                                </select>
                            </div>


                            {{-- Pesquisa por cidade de origem --}}
                            <div id="divCidade" style="display: none">
                                <span>Selecione a Cidade de Origem:</span>
                                <select id="cidade" name="cidade" class="custom-select select_style mt-2"
                                    style="width:100%">
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
                            <div id="divInstituicaoOrigem" {{--  style="display: none" --}}>
                                <span>Selecione a Instituição de Origem:</span>
                                <select id="nomeInstituicaoOrigem" name="nomeInstituicaoOrigem"
                                    class="custom-select select_style mt-2 " style="width:100%">
                                    @if(!empty($instituicoesOrigem) )
                                    <option selected hidden>Selecione a Instituição de origem</option>
                                    @foreach ($instituicoesOrigem as $instituição)
                                    <option value="{{$instituição}}">{{$instituição}}</option>
                                    @endforeach
                                    @else
                                    <option selected hidden value="0">Sem registos</option>
                                    @endif
                                </select>
                            </div>


                            {{-- Pesquisa por Agente --}}
                            <div id="divAgents" style="display: none">
                                <span>Selecione o Agente:</span>
                                <select id="agente" name="agente" class="custom-select select_style mt-2"
                                    style="width:100%">
                                    @if( $agents )
                                    <option selected hidden>Selecione o Agente</option>
                                    @foreach ($agents as $agent)
                                    <option value="{{$agent->idAgente}}">{{$agent->nome}} {{$agent->apelido}}
                                        ({{$agent->pais}})</option>
                                    @endforeach
                                    @else
                                    <option selected hidden value="0">Sem registos</option>
                                    @endif
                                </select>
                            </div>

                            {{-- Pesquisa por Universidades --}}
                            <div id="divUniversidades" style="display: none">
                                <span>Selecione a Universidade:</span>
                                <select id="universidade" name="universidade" class="custom-select select_style mt-2"
                                    style="width:100%">
                                    @if( $universidades )
                                    <option selected hidden>Selecione a Universidade</option>
                                    @foreach ($universidades as $universidade)
                                    <option value="{{$universidade->idUniversidade}}">{{$universidade->nome}}
                                    </option>
                                    @endforeach
                                    @else
                                    <option selected hidden value="0">Sem registos</option>
                                    @endif
                                </select>
                            </div>


                            {{-- Pesquisa por Nivel de estudos --}}
                            <div id="divNivelEstudos" style="display: none">
                                <span>Selecione o Nível de Estudos:</span>
                                <select id="nivelEstudos" name="nivelEstudos" class="custom-select select_style mt-2"
                                    style="width:100%">
                                    <option value="0" value="0" selected hidden>Selecione Nível de Estudos</option>
                                    <option value="Secundário Incompleto">Secundário Incompleto</option>
                                    <option value="Secundário Completo">Secundário Completo</option>
                                    <option value="Curso Tecnológico">Curso Tecnológico</option>
                                    <option value="Estuda na Universidade">Estuda na Universidade</option>
                                    <option value="Licenciado">Licenciado</option>
                                    <option value="Mestrado">Mestrado</option>
                                </select>
                            </div>




                            {{-- Pesquisa Estado de cliente --}}
                            <div id="divEstadoCliente" style="display: none">
                                <span>Selecione o estado do cliente:</span>
                                <select id="estado" name="estado" class="custom-select select_style mt-2"
                                    style="width:100%">
                                    <option hidden value="0">Selecione o Estado do Cliente</option>
                                    <option value="Ativo">Ativo</option>
                                    <option value="Inativo">Inativo</option>
                                    <option value="Proponente">Proponente</option>
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col text-right"><input type="submit" value="Pesquisar" class="top-button mt-4 "
                                    style="width: 150px; min-width:150px"></div>
                        </div>
                    </div>


                </div>


            </form>


        </div>

    </div>



    @if ( isset($clients) )

    <div class="bg-white shadow-sm mb-4 p-4 " style="border-radius:10px">


        @if ( !$clients )
        <div class="row px-3">
            <div class="col border rounded bg-light p-3 mx-4">
                <div class="text-muted text-center">
                    A pesquisa de estudantes por " <strong>{{$valor}}</strong> " no campo " <strong> {{$nomeCampo}}
                    </strong>" não encontrou nenhum registo no sistema
                </div>
            </div>
        </div>
        @else
        <div class="row">

            <div class="col text-center">
                <div class="text-secondary"><strong>A pesquisa de estudantes por " {{$valor}} " no campo "
                        {{$nomeCampo}} " encontrou {{count($clients)}} registo(s) no sistema</strong></div>
                <div class="mx-auto" style="width: 60%; border-radius:10px;"><br>
                    {{-- procura nos resultados --}}
                    <input type="text" class="shadow-sm" id="customSearchBox" placeholder="Procurar nos resultados..."
                        aria-label="Procurar">
                </div>


                {{-- CheckBox: campos disponiveis --}}
                <div id="grpChkBox"class="border rounded bg-light mt-4 pt-3 pb-2 ">
                    {{-- numPassaporte paisNaturalidade cidade nomeInstituicaoOrigem nivEstudoAtual estado --}}
                        <label class="checkbox-inline mx-2"><input type="checkbox" checked name="check_numPassaporte" class="mr-1">N.º Passaporte</label>
                        <label class="checkbox-inline mx-2"><input type="checkbox" checked name="check_paisNaturalidade" class="mr-1">País</label>
                        <label class="checkbox-inline mx-2"><input type="checkbox" name="check_cidade" class="mr-1">Cidade</label>
                        <label class="checkbox-inline mx-2"><input type="checkbox" name="check_nomeInstituicaoOrigem" class="mr-1">Instituicão de Origem</label>
                        <label class="checkbox-inline mx-2"><input type="checkbox" name="check_nivEstudoAtual" class="mr-1">Nível de Estudos</label>
                        <label class="checkbox-inline mx-2"><input type="checkbox" checked name="check_Estado" class="mr-1">Estado</label>
                </div>

            </div>
        </div>

        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-hover " style="width:100%">

                {{-- Cabeçalho da tabela --}}
                <thead>
                    <tr>
                        {{-- numPassaporte paisNaturalidade cidade nomeInstituicaoOrigem nivEstudoAtual estado --}}
                        <th class="text-center align-content-center ">Foto</th>
                        <th>Nome</th>
                        <th class="check_numPassaporte">N.º Passaporte</th>
                        <th class="check_paisNaturalidade">País</th>
                        <th class="check_cidade" style="display: none">Cidade</th>
                        <th class="check_nomeInstituicaoOrigem" style="display: none">Instituição</th>
                        <th class="check_nivEstudoAtual" style="display: none">Nív.Estudos</th>
                        <th class="check_Estado">Estado</th>
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
                                href="{{route('clients.show',$client)}}">{{ $client->nome }}
                                {{ $client->apelido }}</a>
                        </td>

                        {{-- numPassaporte --}}
                        <td class="align-middle check_numPassaporte">{{ $client->numPassaporte }}</td>

                        {{-- paisNaturalidade --}}
                        <td class="align-middle check_paisNaturalidade">{{ $client->paisNaturalidade }}</td>

                        {{-- cidade --}}
                        <td class="align-middle check_cidade" style="display: none">{{ $client->cidade }}</td>

                        {{-- nomeInstituicaoOrigem --}}
                        <td class="align-middle check_nomeInstituicaoOrigem" style="display: none">{{ $client->nomeInstituicaoOrigem }}</td>

                        {{-- nivEstudoAtual --}}
                        <td class="align-middle check_nivEstudoAtual" style="display: none">{{ $client->nivEstudoAtual }}</td>

                        {{-- Estado de cliente --}}
                        <td class="align-middle check_Estado">

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

                            <a href="{{route('clients.edit',$client)}}" class="btn_list_opt btn_list_opt_edit"
                                title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                            <form method="POST" role="form" id="{{ $client->idCliente }}"
                                action="{{route('clients.destroy',$client)}}"
                                data="{{ $client->nome }} {{ $client->apelido }}" class="d-inline-block form_client_id">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn_delete" title="Eliminar estudante" data-toggle="modal"
                                    data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
                            </form>


                        </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>
        @endif


    </div>

    @endif {{-- ( if isset clientes ) --}}

</div>

@endsection

{{-- Scripts --}}
@section('scripts')

{{-- script contem: datatable configs, input configs, validações --}}
<script src="{{asset('/js/client_search.js')}}"></script>

{{-- script permite definir se um input recebe só numeros OU so letras --}}

@endsection
