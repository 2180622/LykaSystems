@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Estudantes')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
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

        <div class="bg-white shadow-sm mb-4 p-4 " style="border-radius:10px">

            @if($clients)


            <div class="row mx-1">
                <div class="col col-2" style="max-width: 120px">
                    <div class="menu-icon">
                        <ion-icon name="person-circle-outline" style="font-size: 90px; --ionicon-stroke-width: 40px; position: relative; top: 5px; right: 3px;"></ion-icon>
                    </div>
                </div>
                <div class="col">
                    <div class="text-secondary"><strong>Existe {{count($clients)}} registo(s) no sistema</strong></div>
                    <br>
                    {{-- Input de procura nos resultados da dataTable --}}

                    <div style="width: 100%; border-radius:10px;">
                        <input type="text" class="shadow-sm" id="customSearchBox"
                            placeholder="Procurar nos resultados..." aria-label="Procurar">

                    </div>
                </div>
                @if (Auth::user()->tipo == "admin")
                <div class="col col-2 text-center" style="max-width: 130px">
                    <a class="name_link " href="{{route('clients.searchIndex')}}">
                        <div class="bg-light border shadow-sm p-2">
                            <div><i class="fas fa-search" style="font-size:30px"></i></div>
                            <div>Pesquisa avançada</div>
                        </div>
                    </a>
                </div>
                @endif
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
                                    href="{{route('clients.show',$client)}}">{{ $client->nome }}
                                    {{ $client->apelido }}</a>
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
                                @if (Auth::user()->tipo == "admin" || Auth::user()->tipo == "agente" &&
                                $client->editavel ==
                                1)
                                <a href="{{route('clients.edit',$client)}}" class="btn_list_opt btn_list_opt_edit"
                                    title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>
                                @endif


                                @if (Auth::user()->tipo == "admin")
                                <form method="POST" role="form" id="{{ $client->idCliente }}"
                                    action="{{route('clients.destroy',$client)}}"
                                    data="{{ $client->nome }} {{ $client->apelido }}"
                                    class="d-inline-block form_client_id">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn_delete" title="Eliminar estudante"
                                        data-toggle="modal" data-target="#deleteModal"><i
                                            class="fas fa-trash-alt"></i></button>
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

@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/clients.js')}}"></script>

@endsection
