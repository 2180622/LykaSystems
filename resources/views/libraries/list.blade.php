@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Biblioteca')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

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
        @if (Auth::user()->tipo == "admin")
        <a href="{{route('libraries.create')}}" class="top-button">Adicionar Ficheiro</a>
        @endif
    </div>

    <br><br>


    <div class="cards-navigation">
  <div class="row">
            <div class="col">
                <div class="title">
                    <h6>Biblioteca
                    </h6>
                </div>
            </div>

            @if (Auth::user()->tipo == "admin")
            {{-- Espaço oucupado em armazenamento --}}
                <div class="col text-right">
                <div class="text-muted"><small><strong>Espaço ocupado: {{$size}}</strong></small></div>
                </div>
            @endif

        </div>
        <br>


        <div class="bg-white shadow-sm mb-4 p-4 " style="border-radius:10px">
            @if($files)

            <div class="row mx-1">
                <div class="col col-2" style="max-width: 120px">
                    <i class="fas fa-download active" style="font-size:80px"></i>
                </div>
                <div class="col">
                    <div class="text-secondary"><strong>Existe {{count($files)}} ficheiro(s) disponíveis no sistema</strong></div>
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
                <table id="dataTable" class="table table-bordered table-hover " style="width:100%">

                {{-- Cabeçalho da tabela --}}
                <thead>
                    <tr>
                        <th class="align-content-center ">Descrição do ficheiro</th>
                        <th class="align-content-center">Tamanho</th>
                        <th class="align-content-center">Tipo</th>
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

                    {{-- tipo de ficheiro --}}
                    <td>{{ $library->tipo }} </td>


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
</div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/library.js')}}"></script>

@endsection
