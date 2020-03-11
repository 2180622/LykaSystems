@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Estudantes')


{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('css/client.css')}}" rel="stylesheet">
@endsection


{{-- Conteudo da Página --}}
@section('content')
<div class="container mt-2">
    <div class="float-right">
        <a href="{{route('clients.create')}}" class="top-button">Adicionar Estudante</a>
    </div>
    <br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Listagem de estudantes</h6>
        </div>
        <br>


        <div class="table-responsive" style="overflow:hidden">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="overflow:hidden">

                {{-- Cabeçalho da tabela --}}
                <thead>
                    <tr>
                        <th class="text-center">CHECK</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Naturalidade</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>

                {{-- Corpo da tabela --}}
                <tbody>

                    @foreach ($clients as $client)
                        <tr class="big-hover-row">
                            <th class="text-center">CHECK</th>
                            <th style="text-align: left;padding-top: 20px">{{ $client->nome }}</th>
                            <th style="text-align: left;padding-top: 20px">{{ $client->email }}</th>
                            <th style="text-align: center;padding-top: 20px">{{ $client->paisNaturalidade }}</th>
                            <th class="text-center">
                                <a href="#" title="Outros"> <i class="fas fa-ellipsis-h mr-3"></i>
                                </a>
                                <a href="#" title="Editar"> <i class="fas fa-pencil-alt mr-3"></i>
                                </a>
                                <a href="#" title="Eliminar"> <i class="far fa-trash-alt"></i>
                                </a>
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

<script src="{{asset('/js/clients-list.js')}}"></script>

@endsection
