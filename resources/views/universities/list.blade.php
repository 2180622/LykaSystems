@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Universidades')


{{-- Estilos de CSS --}}
@section('styleLinks')
    <link href="{{asset('css/university.css')}}" rel="stylesheet">
@endsection


{{-- Conteudo da Página --}}
@section('content')
    <div class="container mt-2">
        <div class="float-right">
            <a href="#" class="top-button">Adicionar Licenciatura</a>
        </div>
        <br>
        <div class="cards-navigation">
            <div class="title">
                <h6>Listagem de Licenciaturas</h6>
            </div>
            <br>
            <div class="row cards-group">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="table" style="width:100%; text-align: center">
                            <thead>
                            <tr>
                                <th>
                                    <div class="fotoPerfil check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1"></label>
                                    </div>
                                </th>
                                <th style="text-align: left; padding-bottom: 20px">Nome da Licenciatura</th>
                                <th style="text-align: left; padding-bottom: 20px">Endereço Eletrónico</th>
                                <th style="text-align: center; padding-bottom: 20px">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-hover-row">
                                <td>
                                    <div class="fotoPerfil check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1"></label>
                                    </div>
                                </td>
                                <td style="text-align: left; padding-top:20px">Instituto Universitário de Lisboa</td>
                                <td style="text-align: left; padding-top:20px">iul@gmail.com</td>
                                <td style="text-align: center; padding-top:20px">
                                    <a class="btnOption" href="#" title="Outros"> <i class="fas fa-ellipsis-h mr-3"></i>
                                    </a>
                                    <a class="btnOption" href="#" title="Editar"> <i class="fas fa-pencil-alt mr-3"></i>
                                    </a>
                                    <a class="btnOption" href="#" title="Eliminar"> <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
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

    <script src="{{asset('/js/university-list.js')}}"></script>

@endsection
