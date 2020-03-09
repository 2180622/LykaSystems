@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Estudantes')


{{-- Estilos de CSS --}}
@section('styleLinks')
    <link href="{{asset('css/student.css')}}" rel="stylesheet">
@endsection





{{-- Conteudo da Página --}}
@section('content')
    <div class="container-fluid">
        <h5>Lista de estudantes</h5>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="dataTableUser" class="table" style="width:100%; text-align:center">
                        <thead>
                        <tr>
                            <th style="width:10%; padding-top: 20px;">
                                <div class="fotoPerfil">
                                    <div class="check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1"></label>
                                    </div>
                                </div>
                            </th>
                            <th style="width:10%; text-align: left">Nome de Utilizador</th>
                            <th>Endereço Eletrónico</th>
                            <th>Naturalidade</th>
                            <th>Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="fotoPerfilImagem"></div>
                            </td>
                            <td style="width:20%; text-align: left; padding-top:20px">Sebastian Sion</td>
                            <td style="padding-top:20px">sebastian@gmail.com</td>
                            <td style="padding-top:20px">México</td>
                            <td style="padding-top:20px;  cursor: pointer">
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

@endsection







{{-- Utilização de scripts: --}}
@section('scripts')

    <script src="{{asset('/js/user-list.js')}}"></script>

@endsection
