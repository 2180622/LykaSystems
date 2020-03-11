@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Universidades')


{{-- Estilos de CSS --}}
@section('styleLinks')
    <link href="{{asset('css/university.css')}}" rel="stylesheet">
@endsection


{{-- Conteudo da Página --}}
@section('content')
    @include('universities.partials.modal')
    <div class="container mt-2">
        <div class="float-right">
            <a href="{{route('universities.create')}}" class="top-button">Adicionar Universidade</a>
        </div>
        <br>
        <div class="cards-navigation">
            <div class="title">
                <h6>Listagem de Universidade</h6>
            </div>
            <br>
            <div class="row cards-group">
                <div class="col-12">
                    @if (count($universidades))
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
                                @foreach($universidades as $universidade)
                                    <tr class="bg-hover-row">
                                        <td>
                                            <div class="fotoPerfil check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1"></label>
                                            </div>
                                        </td>

                                        <td style="text-align: left; padding-top:20px">{{$universidade->nome}}</td>
                                        <td style="text-align: left; padding-top:20px">{{$universidade->email}}</td>
                                        <td style="text-align: center; padding-top:20px">

                                            <a class="btn btn-sm btnOption" href="#" title="Outros">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>

                                            <a class="btn btn-sm btnOption" href=""
                                               title="Editar">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <form method="POST" action=""
                                                  role="form" class="btnOption" title='Eliminar'>
                                                @csrf
                                                @method("DELETE")
                                                <button type="button" class="btn btn-sm btnOption"
                                                        data-toggle="modal" data-target="#eliminarUniversidade"
                                                        data-title="{{$universidade->nome}}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h6 style="text-align: center">Sem Universidades Disponíveis</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

    <script src="{{asset('/js/university.js')}}"></script>

@endsection
