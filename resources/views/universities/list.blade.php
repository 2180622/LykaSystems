@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Universidades')


{{-- Estilos de CSS --}}
@section('styleLinks')

    <link href="{{asset('css/datatables_general_style.css')}}" rel="stylesheet">
    {{--    <link href="{{asset('css/university.css')}}" rel="stylesheet">--}}

@endsection


{{-- Conteudo da Página --}}
@section('content')
    @include('universities.partials.modal')
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
            <a href="{{route('universities.create')}}" class="top-button">Adicionar Universidade</a>
        </div>

        <br><br>


        <div class="cards-navigation">
            <div class="title">
                <h6>Listagem de Universidades</h6>
            </div>
            <br>

            <div class="row mt-3 mb-4">
                <div class="col">
                    Estão registados no sistema <strong>{{$totaluniversidades}}</strong> universidades
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


                        <th class="text-center align-content-center ">Foto
                            {{-- <input class="table-check" type="checkbox" value="" id="check_all"> --}}
                        </th>

                        <th>Nome Universidade</th>
                        <th>E-mail</th>
                        <th>Morada</th>
                        <th class="text-center">Opções</th>
                    </tr>
                    </thead>

                    {{-- Corpo da tabela --}}
                    <tbody>

                    @foreach ($universities as $university)
                        <tr>
                            <th class="">
                                <div class="align-middle mx-auto shadow-sm rounded"
                                     style="overflow:hidden; width:50px; height:50px">
                                    <img src="{{Storage::disk('public')->url('client-photos/').$university->fotografia}}"
                                         width="100%" class="mx-auto">
                                </div>
                                {{-- <input class="table-check" type="checkbox" value="" id="check_{{ $client->idCliente }}">
                                --}}
                            </th>

                            {{-- Nome --}}
                            <th class="align-middle">{{ $university->nome }}</th>

                            {{-- E-Mail --}}
                            <th class="align-middle">{{ $university->email }}</th>

                            {{-- Morada --}}
                            <th class="align-middle">{{ $university->morada }}</th>


                            {{-- OPÇÔES --}}
                            <th class="text-center align-middle">
                                <a href="{{route('universities.show',$university)}}" class="btn_list_opt "
                                   title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                                <a href="{{route('universities.edit',$university)}}" class="btn_list_opt btn_list_opt_edit"
                                   title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                                <form method="POST" role="form" id="{{ $university->idUniversidade }}"
                                      action="{{route('universities.destroy',$university)}}"
                                      class="d-inline-block form_university_id">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn_delete" title="Eliminar Universidade"
                                            data-toggle="modal"
                                            data-target="#eliminarUniversidade" data-title="{{$university->nome}}"><i class="fas fa-trash-alt"></i></button>
                                </form>

                            </th>
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

    <script src="{{asset('/js/university.js')}}"></script>

@endsection
