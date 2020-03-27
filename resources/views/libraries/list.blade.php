@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Biblioteca')


{{-- Estilos de CSS --}}
@section('styleLinks')

    <link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">

@endsection


{{-- Conteudo da Página --}}
@section('content')
    @include('libraries.partials.modal')
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
            <a href="#" class="top-button">Reportar Probema</a>
        </div>

        <br><br>


        <div class="cards-navigation">
            <div class="title">
                <h6>Biblioteca</h6>
            </div>
            <br>

            <div class="row mt-3 mb-4">
                <div class="col">
                    Estão registados no sistema <strong>{{--$totalestudantes--}}</strong> itens
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


            <div class="table-responsive " style="overflow:hidden">


                <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0"
                       style="overflow:hidden;">

                    {{-- Cabeçalho da tabela --}}
                    <thead>
                    <tr>
                        <th>Nome do Documento</th>
                        <th class="text-center">Opções</th>
                    </tr>
                    </thead>

                    {{-- Corpo da tabela --}}
                    <tbody>

                    @foreach ($libraries as $library)
                        <tr>
                            <td>
                                <div class="align-middle mx-auto shadow-sm rounded"
                                     style="overflow:hidden; width:50px; height:50px">
                                </div>
                                {{-- <input class="table-check" type="checkbox" value="" id="check_{{ $client->idCliente }}">
                                --}}
                            </td>

                            {{-- Nome e Apelido --}}
                            <td class="align-middle"><a class="name_link" href="{{route('libraries.show',$library)}}">{{ $library->nome }}</a></td>

                            {{-- OPÇÔES --}}
                            <td class="text-center align-middle">
                                <a href="#" class="btn_list_opt "
                                   title="Ver ficha completa"><i class="fas fa-download mr-2"></i></a>
                                <a href="{{route('libraries.edit',$library)}}" class="btn_list_opt btn_list_opt_edit"
                                   title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                                <form method="POST" role="form" id=""
                                      action="{{route('libraries.destroy',$library)}}" class="d-inline-block form_client_id">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn_delete" title="Eliminar Item" data-toggle="modal"
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
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

    {{-- <script src="{{asset('/js/)}}"></script>--}}

@endsection
