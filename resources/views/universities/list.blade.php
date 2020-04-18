@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Universidades')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">

@endsection


{{-- Conteudo da Página --}}
@section('content')
@include('universities.partials.modal')
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
                Existem <strong>{{$totaluniversidades}}</strong> registo(s) no sistema
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

                        <th>Nome da universidade</th>
                        <th>E-mail</th>
                        {{-- <th>Morada</th> --}}
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>

                {{-- Corpo da tabela --}}
                <tbody>

                    @foreach ($universities as $university)
                    <tr>
                        <td>
                            <div class="align-middle mx-auto shadow-sm rounded"
                                style="overflow:hidden; width:50px; height:50px">
                                <a class="name_link" href="{{route('universities.show',$university)}}">
                                    <img src="{{Storage::disk('public')->url('default-photos/university.png')}}"
                                    width="100%" class="mx-auto">
                                </a>
                            </div>

                        </td>

                        {{-- Nome --}}
                        <td class="align-middle"><a class="name_link" href="{{route('universities.show',$university)}}">{{ $university->nome }}</td>

                        {{-- E-Mail --}}
                        <td class="align-middle">{{ $university->email }}</td>

                        {{-- Morada --}}
                        {{-- <td class="align-middle">{{ $university->morada }}</td> --}}


                        {{-- OPÇÔES --}}
                        <td class="text-center align-middle">
                            <a href="{{route('universities.show',$university)}}" class="btn_list_opt "
                                title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                            <a href="{{route('universities.edit',$university)}}" class="btn_list_opt btn_list_opt_edit"
                                title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                            <form method="POST" role="form" id="{{ $university->idUniversidade }}"
                                action="{{route('universities.destroy',$university)}}"
                                class="d-inline-block form_university_id" data="{{ $university->nome }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn_delete" title="Eliminar Universidade"
                                    data-toggle="modal" data-target="#eliminarUniversidade"
                                    data-title="{{$university->nome}}"><i class="fas fa-trash-alt"></i></button>
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

<script src="{{asset('/js/university.js')}}"></script>

@endsection
