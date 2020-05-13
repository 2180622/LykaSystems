@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem de contas bancárias')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/conta.css')}}" rel="stylesheet">
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
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
            <div class="col-md-6" style="bottom:5px; height:32px;">
                <div class="input-group pl-0 float-right search-section" style="width:250px">
                    <input class="shadow-sm" type="text" id="customSearchBox" placeholder="Secção de procura" aria-label="Procurar">
                    <div class="search-button input-group-append">
                        <ion-icon name="search-outline" class="search-icon"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row mt-2 mb-4">
            <div class="col-md-6">
                @if (count($contas) == 1)
                Existe <strong>{{count($contas)}}</strong> conta registada no sistema.
                @else
                Existem <strong>{{count($contas)}}</strong> contas registadas no sistema.
                @endif
            </div>
        </div>
        <div class="table-responsive" style="overflow:hidden">
            <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0" style="overflow:hidden;">
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
<script type="text/javascript">
    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var name = button.data('name');
        var modal = $(this);
        modal.find('#text').text('Pretende eliminar a conta bancária ' + name + '?');
        modal.find("form").attr('action', '/conta-bancaria/' + button.data('slug'));
    });

    // Context Menu
    window.onclick = hideContextMenu;
    var contextMenu = document.getElementById("contextMenu");

    function showContextMenu() {
        contextMenu.style.display = "inline-block";
        contextMenu.style.left = event.clientX - '260' + 'px';
        contextMenu.style.top = event.clientY + 'px';
        return false;
    }

    function hideContextMenu() {
        contextMenu.style.display = "none";
    }
</script>
@endsection

@endsection
