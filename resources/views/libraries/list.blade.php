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


        @if($files==null)
            <div class="border rounded bg-light p-3 text-muted"><small>(sem ficheiros disponiveis)</small></div>
        @else

        <div class="row mb-3">
            <div class="col">
                <div class="text-center text-secondary"><small>Existem <strong>{{count($files)}} ficheiros(s)</strong> listados</small></div>
            </div>
        </div>

        <div class="row p-3 ">
            <div class="col text-center mb-3">
                <div class="input-group pl-0  search-section mx-auto" style="width:50%">
                    <input class="shadow-sm" type="text" id="customSearchBox"
                        placeholder="Secção de procura" aria-label="Procurar">
                    <div class="search-button input-group-append">
                        <ion-icon name="search-outline" class="search-icon"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr>


        <div class="table-responsive " style="overflow:hidden">


            <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0"
                style="overflow:hidden;">

                {{-- Cabeçalho da tabela --}}
                <thead>
                    <tr>
                        <th class="align-content-center ">Descrição do ficheiro</th>
                        <th class="align-content-center">Tamanho</th>
                        <th class="align-content-center">Data</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>

                {{-- Corpo da tabela --}}
                <tbody>

                    @foreach ($files as $library)
                    {{-- Descrição --}}
                    <td>
                        <i class="fas fa-file-alt"></i>
                        @if ($library->acesso =="Privado")
                            <small><i class="fas fa-lock text-warning ml-1" title="Ficheiro Privado"></i></small>
                        @endif
                        <a download href="{{Storage::disk('public')->url('library/'.$library->ficheiro)}}" class="name_link ml-2">{{ \Illuminate\Support\Str::limit($library->descricao, 50, $end=' (...)') }}</a>

                    </td>


                    {{-- Tamanho --}}
                    <td>{{ $library->tamanho }} </td>


                    {{-- Data de criação --}}
                    <td>{{ date('d-M-y', strtotime($library->updated_at)) }} </td>

                    {{-- OPÇÔES --}}
                    <td class="text-center align-middle align-content-center">

                        {{-- Download --}}
                        <a download href="{{Storage::disk('public')->url('library/'.$library->ficheiro)}}" class="btn_list_opt " title="Fazer download do ficheiro"><i class="fas fa-download mr-2"></i></a>


                        {{-- Editar --}}
                        @if (Auth()->user()->tipo == "admin")
                        <a href="{{route('libraries.edit',$library)}}" class="btn_list_opt btn_list_opt_edit"
                            title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>
                        @endif

                        {{-- Admins: Apagar ficheiro --}}
                        @if (Auth::user()->tipo == "admin")
                        <form method="POST" role="form" id="{{ $library->idBiblioteca }}" action="{{route('libraries.destroy',$library)}}" data="{{ $library->descricao }}"
                            class="d-inline-block form_file_id">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn_delete" title="Eliminar ficheiro" data-toggle="modal"
                                data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
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
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/library.js')}}"></script>

@endsection
