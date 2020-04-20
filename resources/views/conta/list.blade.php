@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem de contas bancárias')

{{-- Estilos de CSS --}}
@section('styleLinks')
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

        <div class="row mt-3 mb-4">
            <div class="col">
                @if (count($contums) == 1)
                Existe <strong>{{count($contums)}}</strong> conta registada no sistema.
                @else
                Existem <strong>{{count($contums)}}</strong> contas registadas no sistema.
                @endif
            </div>
        </div>

        <table id="tableLyka" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Instituição</th>
                    <th>Contacto</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contums as $contum)
                <tr>
                    <td><a href="{{route('conta.show', $contum)}}">{{$contum->descricao}}</a></td>
                    <td>{{$contum->instituicao}}</td>
                    <td>{{$contum->contacto}}</td>
                    <td class="text-center">
                        <a href="{{route('conta.show', $contum)}}" class="btn_list_opt " title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                        <a href="{{route('conta.edit', $contum)}}" class="btn_list_opt btn_list_opt_edit" title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>
                        <button class="btn_delete" data-toggle="modal" data-target="#deleteModal" data-name="{{$contum->descricao}}" data-id="{{$contum->idConta}}"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

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
                    <input type="hidden" id="conta_delete_id" name="id">
                    <div class="modal-footer">
                        <button class="top-button btn_submit bg-danger" type="submit"><i class="far fa-trash-alt mr-2"></i>Sim, eliminar conta</button>
                        <button type="button" class="top-button bg-secondary mr-2" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
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
    })
</script>
@endsection

@endsection
