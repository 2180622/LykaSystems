@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem de contas bancárias')

{{-- Estilos de CSS --}}
@section('styleLinks')

{{-- <link href="{{asset('/css/conta.css')}}" rel="stylesheet"> --}}
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

@endsection

{{-- Conteúdo da Página --}}
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

    <div class="float-right">
        <a href="{{route('conta.create')}}" class="top-button">Adicionar conta bancária</a>
    </div>

    <br><br>

    <div class="cards-navigation">
        <div class="title row">
            <div class="col-md-6">
                <h6>Listagem de contas bancárias</h6>
            </div>
        </div>

        <br>


        <div class="bg-white shadow-sm mb-4 p-4 " style="border-radius:10px;">

            <div class="row mx-1">
                <div class="col col-2" style="max-width: 120px">
                    <i class="fas fa-piggy-bank active" style="font-size:80px"></i>
                </div>
                <div class="col">
                    @if (count($contas) == 1)
                        <div>Existe <strong>{{count($contas)}}</strong> conta registada no sistema.</div>
                    @else
                        <div>Existem <strong>{{count($contas)}}</strong> contas registadas no sistema.</div>
                    @endif
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
                <thead>
                    <tr style="border-bottom: 2px solid #dee2e6;">
                        <th>Descrição</th>
                        <th>Instituição</th>
                        <th>Contacto</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contas as $conta)
                    <tr>
                        <td class="align-middle">{{$conta->descricao}}</td>
                        <td class="align-middle">{{$conta->instituicao}}</td>
                        <td class="align-middle text-truncate">{{$conta->contacto}}</td>

                        <td class="text-center align-middle" style="min-width: 120px;">
                            <a href="{{route('conta.show', $conta)}}" class="btn_list_opt " title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                            <a href="{{route('conta.edit', $conta)}}" class="btn_list_opt btn_list_opt_edit" title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>
                            <button type="button" class="btn_delete" title="Eliminar conta bancária" data-toggle="modal" data-target="#deleteModal" data-name="{{$conta->descricao}}" data-slug="{{$conta->slug}}"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

        </div>




    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar conta bancária</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="POST">
                    @csrf
                    @method('DELETE')
                    <p id="text"></p>
                    <br>
                    <p style="font-weight:500;">Ao clicar "Sim, eliminar conta", irá eliminar a conta definitivamente e perder todos os dados associados.</p>
            </div>
            <div class="modal-footer">
                <button class="top-button btn_submit bg-danger" type="submit"><i class="far fa-trash-alt mr-2"></i>Sim, eliminar conta</button>
                <button type="button" class="top-button bg-secondary mr-2" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')

<script src="{{asset('/js/conta.js')}}"></script>

@endsection

@endsection
