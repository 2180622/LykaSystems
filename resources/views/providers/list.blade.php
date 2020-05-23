@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem de fornecedores')

{{-- Estilos de CSS --}}
@section('styleLinks')
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
        <a href="{{route('provider.create')}}" class="top-button">Adicionar fornecedor</a>
    </div>

    <br><br>

    <div class="cards-navigation">
        <div class="title row">
            <div class="col-md-6">
                <h6>Listagem de fornecedores</h6>
            </div>
        </div>

            <br>


            <div class="bg-white shadow-sm mb-4 p-4 " style="border-radius:10px;">
                <div class="row mx-1">
                    <div class="col col-2" style="max-width: 120px">
                        <i class="fas fa-cogs active" style="font-size:80px"></i>
                    </div>
                    <div class="col">
                        @if (count($providers) == 1)
                            <div>Está registado <strong>{{count($providers)}}</strong> pagamento pendente.</div>
                        @else
                            <div>Estão registados <strong>{{count($providers)}}</strong> pagamentos pendentes.</div>
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
                                <th>Nome</th>
                                <th>Morada</th>
                                <th>Contacto</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($providers as $provider)
                            <tr>
                                <td class="align-middle">{{$provider->nome}}</td>
                                <td class="align-middle">{{$provider->morada}}</td>
                                <td class="align-middle text-truncate">{{$provider->contacto}}</td>

                                <td class="text-center align-middle" style="min-width: 120px;">
                                    <a href="{{route('provider.show', $provider)}}" class="btn_list_opt "
                                        title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                                    <a href="{{route('provider.edit', $provider)}}" class="btn_list_opt btn_list_opt_edit"
                                        title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>
                                    <button type="button" class="btn_delete" title="Eliminar fornecedor" data-toggle="modal"
                                        data-target="#deleteModal" data-name="{{$provider->nome}}"
                                        data-descricao="{{post_slug($provider->descricao)}}"><i
                                            class="fas fa-trash-alt"></i></button>
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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar fornecedor</h5>
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
                        <p style="font-weight:500;">Ao clicar "Sim, eliminar fornecedor", irá eliminar a conta
                            definitivamente e perder todos os dados associados.</p>
                        <input type="hidden" id="provider-delete-descricao" name="id">
                </div>
                <div class="modal-footer">
                    <button class="top-button btn_submit bg-danger" type="submit"><i
                            class="far fa-trash-alt mr-2"></i>Sim, eliminar fornecedor</button>
                    <button type="button" class="top-button bg-secondary mr-2" data-dismiss="modal">Cancelar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
    <script src="{{asset('/js/providers_list.js')}}"></script>

    @endsection

