@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Criação de um fornecedor')

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

    <div class="float-right">
        <a href="{{route('report')}}" class="top-button">reportar problema</a>
    </div>

    <br><br>

    <div class="cards-navigation">
        <div class="title">
            <h6>Criação de um fornecedor</h6>
        </div>
        <br>
        <div class="payment-card shadow-sm">
            <form action="{{route('provider.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="nome">Nome do fornecedor *</label>
                        <br>
                        <input type="text" name="nome" placeholder="Inserir o nome do fornecedor" autocomplete="off" required>
                    </div>
                    <div class="col-md-6">
                        <label for="descricao">Descrição do fornecedor *</label>
                        <br>
                        <input type="text" name="descricao" placeholder="Inserir uma descrição" autocomplete="off" required>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                      <div class="help-button" id="tooltipContacto" data-toggle="tooltip" data-placement="top" title="São aceites como contactos números de telefone e/ou endereços eletrónicos.">
                          <span>
                              ?
                          </span>
                      </div>
                        <label for="contacto">Contacto do fornecedor *</label>
                        <br>
                        <input type="text" name="contacto" placeholder="Inserir o contacto do fornecedor" autocomplete="off" required>
                    </div>
                    <div class="col-md-6">
                        <label for="morada">Morada do fornecedor *</label>
                        <br>
                        <input type="text" name="morada" placeholder="Inserir a morada do fornecedor" autocomplete="off" required>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col">
                        <label for="observacoes">Observações do fornecedor</label>
                        <br>
                        <textarea name="observacoes" rows="5"></textarea>
                    </div>
                </div>
        </div>
        <div class="form-group text-right">
            <br>
            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Adicionar fornecedor</button>
            <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
        </div>
        </form>
        <br>
    </div>
</div>

@section('scripts')
<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection

@endsection
