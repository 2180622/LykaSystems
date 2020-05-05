@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem de contas bancárias')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/conta.css')}}" rel="stylesheet">
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
        <div class="title">
            <h6>Listagem de contas bancárias</h6>
        </div>
        <br>
        <div class="row mt-2">
            <div class="col">
                @if (count($contums) == 1)
                Existe <strong>{{count($contums)}}</strong> conta registada no sistema.
                @else
                Existem <strong>{{count($contums)}}</strong> contas registadas no sistema.
                @endif
            </div>
        </div>
        <br>
        <div class="container">
            @foreach ($contums as $contum)
            <a href="{{route('conta.show', $contum)}}" oncontextmenu="return showContextMenu();">
                <div class="row charge-div">
                    <div class="col-md-1 align-self-center">
                        <div class="white-circle">
                            <ion-icon name="cube" id="icon"></ion-icon>
                        </div>
                    </div>
                    <div class="col-md-3 text-truncate align-self-center ml-4">
                        <p class="text-truncate" title="{{$contum->descricao}}">{{$contum->descricao}}</p>
                    </div>
                    <div class="col-md-4 align-self-center">
                        <p class="text-truncate" title="{{$contum->instituicao}}">{{$contum->instituicao}}</p>
                    </div>
                    <div class="col-md-3 text-truncate align-self-center ml-auto">
                        <p class="text-truncate" title="{{$contum->contacto}}">{{$contum->contacto}}</p>
                    </div>
                </div>
            </a>

            <div class="custom-cm" id="contextMenu">
                <div class="custom-cm-item">
                    <a href="{{route('conta.edit', $contum)}}">Editar</a>
                </div>
                <div class="custom-cm-item">
                    <p data-toggle="modal" data-target="#deleteModal" data-name="{{$contum->descricao}}" data-id="{{$contum->idConta}}">Remover</p>
                </div>
                <div class="custom-cm-divider"></div>
                <div class="custom-cm-item">Cancelar</div>
            </div>
            @endforeach
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
                    <input type="hidden" id="conta_delete_id" name="id">
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
        modal.find('#conta_delete_id').val(button.data('id'));
        modal.find("form").attr('action', '/conta/' + button.data('id'));
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
