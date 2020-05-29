@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Produtos Stock')


{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection


{{-- Conteudo da Página --}}
@section('content')


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
        <a href="{{route('produtostock.create')}}" class="top-button">Adicionar Produto Stock</a>
    </div>
    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Listagem de Produtos Stock</h6>
        </div>
        <br>
        <div class="bg-white shadow-sm mb-4 p-4 " style="border-radius:10px;">
            <div class="row mx-1">
                <div class="col col-2" style="max-width: 120px">
                    <i class="fas fa-sliders-h active" style="font-size:80px"></i>
                </div>
                <div class="col">
                    <div class="text-secondary font-weight-bold">Estão registados no sistema {{$totalprodutostock}} produtos stock, {{$totalfasestock}} fases stock e {{$totaldocstock}} documentos stock.</div>
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
                <table id="dataTable" class="table table-bordered table-hover" style="width:100%">

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
                            <td class="align-middle"><a class="name_link" href="{{route('produtostock.show',$produtoStock)}}">{{ $produtoStock->descricao }}</a></td>

                            {{-- Tipo --}}
                            <td class="align-middle">{{ $produtoStock->tipoProduto}}</td>

                            {{-- Ano Académico --}}
                            <td class="align-middle">{{ $produtoStock->anoAcademico }}</td>

                            {{-- OPÇÔES --}}
                            <td class="text-center align-middle">
                                <a href="{{route('produtostock.show',$produtoStock)}}" class="btn_list_opt " title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                                <a href="{{route('produtostock.edit', $produtoStock)}}" class="btn_list_opt btn_list_opt_edit" title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                                <form method="POST" role="form" id="{{ $produtoStock->idProdutoStock }}"
                                    action="{{route('produtostock.destroy',$produtoStock)}}" class="d-inline-block form_client_id">
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
        </div>

    </div>
</div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')



<script src="{{asset('/js/produtoStock.js')}}"></script>

@endsection
