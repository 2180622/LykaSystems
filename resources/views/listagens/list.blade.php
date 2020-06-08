@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem')

{{-- Estilos de CSS --}}
@section('styleLinks')
    <link href="{{asset('/css/providers.css')}}" rel="stylesheet">
@endsection


{{-- Conteudo da Página --}}
@section('content')
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

        <br><br>

        <div class="cards-navigation">
            <div class="title">
                <h6>Listagem:</h6>
            </div>
            <br>
            <br>
        </div>

        <div class="lista">
            <table id="dataTable" class="table table-bordered table-hover text-black" style="width:100%">
                <thead>
                    <tr>
                        {{--<th class="text-center align-content-center ">Foto</th> --}}
                        <th>Nome</th>
                        <th>N.º Passaporte</th>
                        <th>País</th>
                        <th>Estado</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>

                {{-- Corpo da tabela --}}
                <tbody class="table-body">
                    
                    <tr id="clonar">
                        {{-- Só mostras os clientes ativos ou proponentes --}}


                        {{-- Nome e Apelido --}}
                        <td class="align-middle">
                            <a class="routa-show name_link" href="#"></a>
                        </td>

                        {{-- numPassaporte --}}
                        <td class="numPassaporte align-middle"></td>

                        {{-- País de origem --}}
                        <td class="paiisNaturalidade align-middle"></td>

                        {{-- Estado de cliente --}}
                        <td class="align-middle">
                            <span class="span-estado"></span>
                        </td>


                        {{-- OPÇÔES --}}
                        <td class="text-center align-middle">

                            {{-- Opção: Ver detalhes --}}
                            <a class="butao-show" href="#" class="btn btn-sm btn-outline-primary"
                                title="Ver ficha completa"><i class="far fa-eye"></i></a>

                            {{-- Permissões para editar --}}
                            <a class="butao-editar" href="#" class="btn btn-sm btn-outline-warning"
                                title="Editar"><i class="fas fa-pencil-alt"></i>
                            </a>

                            {{-- Opção APAGAR --}}
                            <form method="POST" role="form" id=""
                                action="#"
                                data="" class="d-inline-block form_client_id butao-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar estudante"
                                    data-toggle="modal" data-target="#deleteModal"><i
                                        class="fas fa-trash-alt"></i></button>
                            </form>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    @section('scripts')
        <script type="text/javascript">
            var clone = $('#clonar').clone();
            $('#clonar').remove();

        </script>
    @endsection
@endsection