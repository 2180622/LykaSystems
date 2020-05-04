@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Lista de Utilizadores')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')

<div class="container mt-2">
    <div class="float-left buttons">
    <a href="javascript:history.go(-1)" title="Voltar">
        <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
    </a>
    <a href="javascript:window.history.forward();" title="Avançar">
        <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
    </a>
</div>
    <div class="float-right">
        <a href="{{route('users.create')}}" class="top-button">Adicionar Administrador</a>
    </div>

    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Listagem de administradores</h6>
        </div>
        <br>

        <div class="row mt-3 mb-4">
            <div class="col">
                Estão registados no sistema <strong>{{$users->count()}}</strong> administradores
            </div>
        </div>

        <div class="row mt-3 mb-4">
            <div class="col">
                <span class="mr-2">Mostrar</span>
                <select class="custom-select" id="records_per_page" style="width:80px">
                    <option selected>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
                <span class="ml-2">por página</span>
            </div>
            <div class="col ">
                <div class="input-group pl-0 float-right" style="width:250px">
                    <input class="form-control my-0 py-1 red-border" type="text" id="customSearchBox" placeholder="Procurar" aria-label="Procurar">
                    <div class="input-group-append">
                        <span class="input-group-text red lighten-3"><i class="fas fa-search text-grey" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="table-responsive " style="overflow:hidden">
            <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0" style="overflow:hidden;">
                {{-- Cabeçalho da tabela --}}
                <thead>
                    <tr>
                        <th class="text-center align-content-center">Foto</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>

                {{-- Corpo da tabela --}}
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="align-middle mx-auto shadow-sm rounded" style="overflow:hidden; width:50px; height:50px">
                                @if($user->admin->fotografia)
                                    <img src="{{Storage::disk('public')->url('admin-photos/').$user->admin->fotografia}}" width="100%" class="mx-auto">
                                @elseif($user->admin->genero == 'F')
                                    <img src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" width="100%" class="mx-auto">
                                @else
                                    <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                                @endif
                            </div>
                        </td>
                        <td class="align-middle">{{ $user->admin->nome }}</td>
                        <td class="align-middle">{{ $user->email }}</td>

                        {{-- OPÇÔES --}}
                        <td class="text-center align-middle">
                            <a href="{{route('users.show', $user)}}" class="btn_list_opt " title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                            <a href="{{route('users.edit', $user)}}" class="btn_list_opt btn_list_opt_edit" title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                            <form method="POST" role="form" id=""
                              action="{{route('users.destroy', $user->admin)}}" class="d-inline-block form_university_id">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn_delete" title="Eliminar Utilizador" data-toggle="modal" data-target="#eliminarUtilizador" data-title="{{$user->nome}}"><i class="fas fa-trash-alt"></i></button>
                            </form>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
