@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Estudantes')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('css/datatables_general_style.css')}}" rel="stylesheet">

@endsection


{{-- Conteudo da Página --}}
@section('content')
@include('clients.partials.modal')
<!-- MODAL DE INFORMAÇÔES -->

<div class="container mt-2 ">

    {{-- Navegação --}}
    <div class="float-left">
        <a href="javascript:history.go(-1)" title="Voltar"><i
                class="fas fa-arrow-left rounded-circle p-2 nav_btns mr-3"></i></a>
        <a href="javascript:window.history.forward();" title="Avançar"><i
                class="fas fa-arrow-right rounded-circle p-2 nav_btns"></i></a>
    </div>

    <div class="float-right">
        <a href="{{route('produtostock.create')}}" class="top-button">Adicionar Produto Stock</a>
    </div>

    <br><br>


    <div class="cards-navigation">
        <div class="title">
            <h6>Listagem de Produtos Stock</h6>
        </div>
        <br>

        <div class="row mt-3 mb-4">
            <div class="col">
                Estão registados no sistema <strong>{{$totalprodutostock}}</strong> produtos stock
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
                    <input class="form-control my-0 py-1 red-border" type="text" id="customSearchBox"
                        placeholder="Procurar" aria-label="Procurar">
                    <div class="input-group-append">
                        <span class="input-group-text red lighten-3"><i class="fas fa-search text-grey"
                                aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <hr>

            <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0"
                style="overflow:hidden;">
                {{-- Cabeçalho da tabela --}}
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Tipo</th>
                        <th>Ano Académico</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>
                {{-- Corpo da tabela --}}
                <tbody>

                    @foreach ($produtoStocks as $produtoStock)
                    <tr>
                        {{-- Descrição --}}
                        <th class="align-middle"><a class="name_link" href="{{route('produtostock.show',$produtoStock)}}">{{ $produtoStock->descricao }}</a></th>

                        {{-- Tipo --}}
                        <th class="align-middle">{{ $produtoStock->tipo }}</th>

                        {{-- Ano Académico --}}
                        <th class="align-middle">{{ $produtoStock->anoAcademico }}</th>


                        {{-- OPÇÔES --}}
                        <th class="text-center align-middle">
                            <a href="{{route('produtostock.show',$produtoStock)}}" class="btn_list_opt "
                                title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                            <a href="{{route('produtostock.edit',$produtoStock)}}" class="btn_list_opt btn_list_opt_edit"
                                title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                            <form method="POST" role="form" id="{{ $produtoStock->idProdutoStock }}"
                                action="{{route('produtostock.destroy',$produtoStock)}}" class="d-inline-block form_client_id">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn_delete" title="Eliminar estudante" data-toggle="modal"
                                    data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
                            </form>

                        </th>
                    </tr>
                    @endforeach

                </tbody>
            </table>



    </div>
</div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/clients.js')}}"></script>

@endsection
