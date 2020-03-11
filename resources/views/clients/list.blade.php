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
            <div class="row cards-group">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="table" style="width:100%; text-align: center;">
                            <thead>
                            <tr>
                                <th>
                                    <div class="fotoPerfil check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1"></label>
                                    </div>
                                </th>
                                <th style="text-align: left; padding-bottom: 20px">Nome de Utilizador</th>
                                <th style="text-align: left; padding-bottom: 20px">Endereço Eletrónico</th>
                                <th style="text-align: center; padding-bottom: 20px">Naturalidade</th>
                                <th style="text-align: center; padding-bottom: 20px">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                              @foreach ($clientes as $cliente)
                                <tr class="bg-hover-row">
                                    <td>
                                        <div class="fotoPerfilImagem"></div>
                                    </td>
                                    <td style="text-align: left; padding-top:20px">{{$cliente->nome}}</td>
                                    <td style="text-align: left; padding-top:20px">{{$cliente->email}}</td>
                                    <td style="text-align: center; padding-top:20px">{{$cliente->paisNaturalidade}}</td>
                                    <td style="text-align: center; padding-top:20px">
                                        <a class="btnOption" href="#" title="Outros"> <i class="fas fa-ellipsis-h mr-3"></i>
                                        </a>
                                        <a class="btnOption" href="#" title="Editar"> <i class="fas fa-pencil-alt mr-3"></i>
                                        </a>
                                        <a class="btnOption" href="#" title="Eliminar"> <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

    <script src="{{asset('/js/student-list.js')}}"></script>

@endsection
