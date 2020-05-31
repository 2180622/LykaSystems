@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Universidades')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

@endsection


{{-- Conteudo da Página --}}
@section('content')
@include('universities.partials.modal')
<!-- MODAL DE INFORMAÇÔES -->



<div class="container-fluid mt-2 ">

    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">

        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Listagem de Universidades</strong>
                        <h4>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                <a href="{{route('universities.create')}}" class="btn btn-sm btn-success px-2"><i
                        class="fas fa-plus mr-2"></i>Adicionar Universidade</a>
            </div>

        </div>

        @if($universities)

        <div class="row">
            <div class="col">
                {{-- Contagem dos clientes ativos ou proponentes --}}
                <div class="text-muted my-2">
                    <strong>Existe {{count($universities)}} registo(s) no sistema</strong>
                </div>
                <div>
                    {{-- Input de procura nos resultados da dataTable --}}
                    <input type="text" class="shadow-sm" id="customSearchBox" placeholder="Procurar nos resultados..."
                        aria-label="Procurar" style="width:100%;">
                </div>
            </div>

        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover " style="width:100%">

                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>


                                <th class="text-center align-content-center ">Foto
                                    {{-- <input class="table-check" type="checkbox" value="" id="check_all"> --}}
                                </th>

                                <th>Nome da universidade</th>
                                <th>E-mail</th>
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
                                <td class="align-middle"><a class="name_link"
                                        href="{{route('universities.show',$university)}}">{{ $university->nome }}</td>

                                {{-- E-Mail --}}
                                <td class="align-middle">{{ $university->email }}</td>


                                {{-- OPÇÔES --}}
                                <td class="text-center align-middle">
                                    <a href="{{route('universities.show',$university)}}" class="btn_list_opt "
                                        title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                                    <a href="{{route('universities.edit',$university)}}"
                                        class="btn_list_opt btn_list_opt_edit" title="Editar"><i
                                            class="fas fa-pencil-alt mr-2"></i></a>

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
        
        @else

        <div class="border rounded bg-light p-2 mt-4" >
                <span class="text-muted"><small>(sem dados para mostrar)</small></span>
        </div>

        @endif


    </div>
</div>

@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/university.js')}}"></script>

@endsection
