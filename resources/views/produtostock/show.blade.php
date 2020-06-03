@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de produto')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')


<div class="container-fluid my-4" style="color: black">

    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Ficha de Produto: <span class="active">{{ $produtostock->descricao }}</span></strong>
                    </h4>
                    <small>
                        <div>
                            <span>Ultima atualização:
                                <strong>{{ date('d-M-y', strtotime($produtostock->updated_at)) }}</strong></span>
                        </div>
                    </small>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">

            </div>

        </div>


        <hr class="my-3">


        {{-- LISTA DE FASES --}}
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive ">
                    <table nowarp class="table table-bordered table-hover " id="dataTable" style="width:100%">
                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th class="text-center" style="width: 130px">Opções</th>
                            </tr>
                        </thead>
                        {{-- Corpo da tabela --}}
                        <tbody>
                            @foreach ($faseStocks as $faseStock)
                            <tr>
                                {{-- Descrição --}}
                                <td class="align-middle">
                                    <a class="name_link"
                                        href="{{route('fasestock.show',$faseStock)}}">{{$faseStock->descricao}}</a>
                                </td>

                                {{-- OPÇÔES --}}
                                <td class="text-center align-middle" style="width: 130px">
                                    <a href="{{route('fasestock.edit', $faseStock)}}"
                                        class="btn btn-sm btn-outline-warning mr-1" title="Editar"><i
                                            class="fas fa-pencil-alt"></i></a>

                                    <form method="POST" role="form" id="{{ $faseStock->idFaseStock }}"
                                        action="{{route('fasestock.destroy',$faseStock)}}"
                                        class="d-inline-block form_client_id">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            title="Eliminar estudante" data-toggle="modal" data-target="#deleteModal"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>





        {{-- ADICIONAR FASE STOCK --}}
        <form class="form-group needs-validation" action="{{route('fasestock.store', $produtostock)}}" method="post" id="form_fase" enctype="multipart/form-data" novalidate>
            @csrf
        <div class="row mt-4 mx-1">


                {{-- INPUT descricao fasestock --}}
                <div class="col" style="min-width: 350px">
                    <label for="descricao" class="font-weight-bold">Descrição da Nova Fase Stock:</label><br>
                    <input type="text" class="form-control" name="descricao" id="descricaofase" style="width:100%" required><br>
                </div>


                {{-- Botão de submit --}}
                <div class="col text-right my-auto " style="min-width: 200px; max-width: 200px !important">
                        <button type="submit" class="btn btn-sm btn-success px-2 " name="ok" id="buttonSubmit"><i class="fas fa-plus mr-2 "></i>Adicionar Fase Stock</button>
                </div>

        </div>
    </form>


    </div>
</div>

</div>

@endsection

{{-- Scripts --}}
@section('scripts')
{{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
