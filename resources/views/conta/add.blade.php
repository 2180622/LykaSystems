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

    <div class="float-right">
        <a href="{{route('report')}}" class="top-button">reportar problema</a>
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
                        <input type="text" name="descricao" placeholder="Inserir uma descrição" autocomplete="off" required>
                    </div>
                    <div class="col-md-6">
                        <label for="instituicao">Nome da instituição *</label>
                        <br>
                        <input type="text" name="instituicao" placeholder="Inserir o nome da instituição" autocomplete="off" required>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="titular">Nome do titular *</label>
                        <br>
                        <input type="text" name="titular" placeholder="Inserir o nome do titular" autocomplete="off" required>
                    </div>
                    <div class="col-md-6">
                        <label for="morada">Morada da instituição *</label>
                        <br>
                        <input type="text" name="morada" placeholder="Inserir a morada da instituição" autocomplete="off" required>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="numConta">Número de conta *</label>
                        <br>
                        <input type="text" name="numConta" placeholder="Inserir o número de conta" autocomplete="off" required>
                    </div>
                    <div class="col-md-6">
                        <label for="IBAN">Código IBAN *</label>
                        <br>
                        <input type="text" name="IBAN" placeholder="Inserir o código IBAN" autocomplete="off" required>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="SWIFT">Código SWIFT *</label>
                        <br>
                        <input type="text" name="SWIFT" placeholder="Inserir o código SWIFT" autocomplete="off" required>
                    </div>
                    <div class="col-md-6">
                      <div class="help-button" id="tooltipContacto" data-toggle="tooltip" data-placement="top" title="Neste secção pode inserir qualquer tipo de contacto que identifique a instituição que está a adicionar.">
                          <span>
                              ?
                          </span>
                      </div>
                        <label for="contacto">Contacto da instituição</label>
                        <br>
                        <input type="text" name="contacto" placeholder="Inserir um contacto da instituição" autocomplete="off">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col">
                        <label for="obsConta">Observações da conta</label>
                        <br>
                        <textarea name="obsConta" rows="5"></textarea>
                    </div>
                </div>
        </div>
        <div class="form-group text-right">
            <br>
            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Adicionar conta bancária</button>
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
