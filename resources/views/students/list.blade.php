@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Estudantes')


{{-- Estilos de CSS --}}
@section('styleLinks')
    <link href="{{asset('css/student.css')}}" rel="stylesheet">
@endsection





{{-- Conteudo da Página --}}
@section('content')



    <h3>Lista de estudantes</h3>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="dataTableUser" class="table" style="width:100%; text-align:center">
                        <thead>
                        <tr>
                            <th style="width:10%">
                                <div class="custom-control custom-checkbox checkbox-lg">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-2"
                                           checked="">
                                    <label class="custom-control-label" for="checkbox-2"></label>
                                </div>
                            </th>
                            <th style="width:20%; text-align: left">Nome de Utilizador</th>
                            <th>Endereço Eletrónico</th>
                            <th>Naturalidade</th>
                            <th>Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><div class="fotoPerfil"></div></td>
                            <td style="width:20%; text-align: left; padding-top:20px">Sebastian Sion</td>
                            <td style="padding-top:20px">sebastian@gmail.com</td>
                            <td style="padding-top:20px">México</td>
                            <td style="padding-top:20px">
                                <i class="fas fa-ellipsis-h mr-3"></i>
                                <i class="fas fa-pencil-alt mr-3"></i>
                                <i class="far fa-trash-alt"></i>
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
