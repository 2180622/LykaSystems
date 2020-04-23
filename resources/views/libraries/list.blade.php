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
        <div class="float-left buttons">
            <a href="javascript:history.go(-1)" title="Voltar">
                <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
            </a>
            <a href="javascript:window.history.forward();" title="Avançar">
                <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
            </a>
        </div>

        <div class="float-right">
            <a href="{{route('report')}}" class="top-button mr-2">reportar problema</a>
            @if (Auth::user()->tipo == "admin")
                <a href="{{route('libraries.create')}}" class="top-button">Adicionar Ficheiro</a>
            @endif
        </div>

        <br><br>


        <div class="cards-navigation">
            <div class="title">
                <h6>Biblioteca</h6>
            </div>
            <br>



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
                    <div class="input-group pl-0 float-right search-section" style="width:250px">
                        <input class="shadow-sm" type="text" id="customSearchBox" placeholder="Secção de procura" aria-label="Procurar">
                        <div class="search-button input-group-append">
                            <ion-icon name="search-outline" class="search-icon"></ion-icon>
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
                            <th class="align-content-center ">Descrição</th>
                            <th class="align-content-center ">Criado em</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>

                    {{-- Corpo da tabela --}}
                    <tbody>

                        @foreach ($files as $file)
                        <td class=""><a href="#" class="name_link">{{$file->descricao}}</a></td>

                        <td class="">{{ date('d-M-y', strtotime($file->created_at)) }} </td>

                            {{-- OPÇÔES --}}
                            <td class="text-center align-middle">

                                {{-- Ver ficheiro --}}
                                 <a href="#" class="btn_list_opt " title="Download"><i class="far fa-eye mr-2"></i></a>

                                 {{-- Admins: Apagar ficheiro --}}
                                 @if (Auth::user()->tipo == "admin")
                                    <form method="POST" role="form" id="#########" action="#" data="ID_DO_FICHEIRO++++++" class="d-inline-block form_client_id">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn_delete" title="Eliminar ficheiro" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                @endif

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

<script src="{{asset('/js/liraby.js')}}"></script>

@endsection
