@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem de contas bancárias')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
@endsection

{{-- Conteúdo da Página --}}
@section('content')

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
        <a href="{{route('conta.create')}}" class="top-button">Adicionar conta bancária</a>
    </div>

    <br><br>

    <div class="cards-navigation">
        <div class="title">
            <h6>de contas bancárias</h6>
        </div>
        <br>

        <div class="row mt-3 mb-4">
            <div class="col">
                @if (count($contums) == 1)
                  Existe <strong>{{count($contums)}}</strong> conta registada no sistema.
                @else
                  Existem <strong>{{count($contums)}}</strong> contas registadas no sistema.
                @endif
            </div>
        </div>


        <div class="row mt-3 mb-4">
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
                <div class="input-group pl-0 float-right" style="width:250px">
                    <input class="form-control my-0 py-1 red-border" type="text" id="customSearchBox" placeholder="Procurar" aria-label="Procurar">
                    <div class="input-group-append">
                        <span class="input-group-text red lighten-3"><i class="fas fa-search text-grey" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <hr>


        <div class="table-responsive " style="overflow:hidden">
            <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0" style="overflow:hidden;">
                {{-- Cabeçalho da tabela --}}
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Instituição</th>
                        <th>Contacto</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>

                {{-- Corpo da tabela --}}
                <tbody>
                    @foreach ($contums as $contum)
                    <tr>
                        {{-- Nome e Apelido --}}
                        <td class="align-middle"><a class="name_link" href="{{route('conta.show', $contum)}}">{{$contum->descricao}}</a></td>

                        {{-- Tipo --}}
                        <td class="align-middle">{{$contum->instituicao}}</td>

                        {{-- País --}}
                        <td class="align-middle">{{$contum->contacto}}</td>

                        {{-- Opções --}}
                        <td class="text-center align-middle">
                            <a href="{{route('conta.show', $contum)}}" class="btn_list_opt " title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                            <a href="{{route('conta.edit', $contum)}}" class="btn_list_opt btn_list_opt_edit" title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                            <form method="POST" role="form" id="{{$contum->idConta}}" action="{{route('conta.destroy', $contum)}}" data="{{$contum->descricao}}" class="d-inline-block form_agent_id">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn_delete" title="Eliminar agente" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
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

{{-- Utilização de scripts --}}
@section('scripts')

@endsection
