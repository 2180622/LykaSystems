@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Criação de uma conta bancária')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/payment.css')}}" rel="stylesheet">
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
            <h6>Criação de uma conta bancária</h6>
        </div>
        <br>
        <div class="payment-card shadow-sm">
            <form action="{{route('conta.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="help-button" id="tooltipDescricao" data-toggle="tooltip" data-placement="top" title="A decrição inserida irá servir para identificar a conta a utilizar no futuro.">
                            <span>
                                ?
                            </span>
                        </div>
                        <label for="descricao">Descrição da conta *</label>
                        <br>
                        <input type="text" name="descricao" placeholder="Inserir uma descrição" autocomplete="off" required value="{{old('descricao', $conta->descricao)}}">
                    </div>
                    <div class="col-md-6">
                        <label for="instituicao">Nome da instituição *</label>
                        <br>
                        <input type="text" name="instituicao" placeholder="Inserir o nome da instituição" autocomplete="off" required value="{{old('instituicao', $conta->instituicao)}}">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="numConta">Número de conta *</label>
                        <br>
                        <input type="text" name="numConta" placeholder="Inserir o número de conta" autocomplete="off" value="{{old('numConta', $conta->numConta)}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="IBAN">Código IBAN *</label>
                        <br>
                        <input type="text" name="IBAN" placeholder="Inserir o código IBAN" autocomplete="off" value="{{old('IBAN', $conta->IBAN)}}" required>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="SWIFT">Código SWIFT *</label>
                        <br>
                        <input type="text" name="SWIFT" placeholder="Inserir o código SWIFT" autocomplete="off" value="{{old('SWIFT', $conta->SWIFT)}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="contacto">Contacto da instituição</label>
                        <br>
                        <input type="text" name="contacto" placeholder="Inserir um contacto da instituição" autocomplete="off" value="{{old('contacto', $conta->contacto)}}">
                    </div>
                </div>
                <br><br>
                <div class="row mb-2">
                    <div class="col">
                        <label for="obsConta">Observações da conta</label>
                        <br>
                        <textarea name="obsConta" rows="5" value="{{old('obsConta', $conta->obsConta)}}"></textarea>
                    </div>
                </div>
        </div>
        <div class="form-group text-right">
            <br>
            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Adicionar conta bancária</button>
            <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
        </div>
        </form>
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
