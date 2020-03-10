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
            <button type="button" name="button" class="report-problem">Adicionar Estudante</button>
        </div>
        <br>
        <div class="cards-navigation">
            <div class="title">
                <h6>Listagem de estudantes</h6>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-6">
                    <div class="table-responsive">
                        <table id="dataTable" class="table" style="width:100%; text-align: center;">
                            <thead>
                            <tr>
                                <th style="">
                                    <div class="fotoPerfil">
                                        <div class="check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1"></label>
                                        </div>
                                    </div>
                                </th>
                                <th style="text-align: left; padding-bottom: 20px">Nome de Utilizador</th>
                                <th style="text-align: left; padding-bottom: 20px">Endereço Eletrónico</th>
                                <th style="text-align: center; padding-bottom: 20px">Naturalidade</th>
                                <th style="text-align: center; padding-bottom: 20px">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-hover-row">
                                <td>
                                    <div class="fotoPerfilImagem"></div>
                                </td>
                                <td style="text-align: left; padding-top:20px">Sebastian Sion</td>
                                <td style="text-align: left; padding-top:20px">sebastian@gmail.com</td>
                                <td style="text-align: center; padding-top:20px">México</td>
                                <td style="text-align: center; padding-top:20px">
                                    <i class="fas fa-ellipsis-h mr-3" title="Outros"></i>
                                    <i class="fas fa-pencil-alt mr-3" title="Editar"></i>
                                    <i class="far fa-trash-alt" title="Eliminar"></i>
                                </td>
                            </tr>
                            <tr class="bg-hover-row">
                                <td>
                                    <div class="fotoPerfilImagem"></div>
                                </td>
                                <td style="text-align: left; padding-top:20px">Sebastian Sion</td>
                                <td style="text-align: left; padding-top:20px">sebastian@gmail.com</td>
                                <td style="text-align: center; padding-top:20px">México</td>
                                <td style="text-align: center; padding-top:20px">
                                    <i class="fas fa-ellipsis-h mr-3" title="Outros"></i>
                                    <i class="fas fa-pencil-alt mr-3" title="Editar"></i>
                                    <i class="far fa-trash-alt" title="Eliminar"></i>
                                </td>
                            </tr>
                            <tr class="bg-hover-row">
                                <td>
                                    <div class="fotoPerfilImagem"></div>
                                </td>
                                <td style="text-align: left; padding-top:20px">Sebastian Sion</td>
                                <td style="text-align: left; padding-top:20px">sebastian@gmail.com</td>
                                <td style="text-align: center; padding-top:20px">México</td>
                                <td style="text-align: center; padding-top:20px">
                                    <i class="fas fa-ellipsis-h mr-3" title="Outros"></i>
                                    <i class="fas fa-pencil-alt mr-3" title="Editar"></i>
                                    <i class="far fa-trash-alt" title="Eliminar"></i>
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

    <script src="{{asset('/js/student-list.js')}}"></script>

@endsection
