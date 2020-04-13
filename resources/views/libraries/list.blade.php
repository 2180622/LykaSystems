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
            <a href="#" class="top-button">Reportar Problema</a>
        </div>

        <br><br>


        <div class="cards-navigation">
            <div class="title">
                <h6>Biblioteca</h6>
            </div>
            <br>


            <div class="table-responsive " style="overflow:hidden">


                <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0" style="overflow:hidden;">

                    {{-- Cabeçalho da tabela --}}
                    <thead>
                        <tr>
                            <th class="align-content-center ">Descrição</th>
                            <th class="text-center align-content-center ">Criado em</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>

                    {{-- Corpo da tabela --}}
                    <tbody>

                        {{-- @foreach ($files as file) --}}
                        <tr>
                        <td class="">{{-- {{$file->descricao}} --}}</td>

                        <td class="">{{-- {{$file->created_at}} --}}</td>

                            {{-- OPÇÔES --}}
                            <td class="text-center align-middle">
                                <a href="#" class="btn_list_opt " title="Download"><i class="far fa-eye mr-2"></i></a>

                                <form method="POST" role="form" id="#########" action="#" data="ID_DO_FICHEIRO++++++" class="d-inline-block form_client_id">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn_delete" title="Eliminar ficheiro" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
                                </form>

                            </td>
                        </tr>
                        {{-- @endforeach --}}

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
