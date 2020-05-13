@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Visualização de uma conta bancária')

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
            <h6>Visualização da conta bancária: {{$conta->descricao}}</h6>
        </div>
        <br>
        <div class="payment-card shadow-sm">
            <div class="row">
                <div class="col-md-6">
                    <label for="descricao">Descrição da conta</label>
                    <br>
                    <input type="text" name="descricao" placeholder="Inserir uma descrição" autocomplete="off" value="{{$conta->descricao}}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="instituicao">Nome da instituição</label>
                    <br>
                    <input type="text" name="instituicao" placeholder="Inserir o nome da instituição" autocomplete="off" value="{{$conta->instituicao}}" disabled>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                    <label for="titular">Nome do titular</label>
                    <br>
                    <input type="text" name="titular" placeholder="Inserir o nome do titular" autocomplete="off" value="{{$conta->titular}}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="morada">Morada da instituição</label>
                    <br>
                    <input type="text" name="morada" placeholder="Inserir a morada da instituição" autocomplete="off" value="{{$conta->morada}}" disabled>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                    <label for="numConta">Número de conta</label>
                    <br>
                    <input type="text" name="numConta" placeholder="Inserir o número de conta" autocomplete="off" value="{{$conta->numConta}}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="IBAN">Código IBAN</label>
                    <br>
                    <input type="text" name="IBAN" placeholder="Inserir o código IBAN" autocomplete="off" value="{{$conta->IBAN}}" disabled>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                    <label for="SWIFT">Código SWIFT</label>
                    <br>
                    <input type="text" name="SWIFT" placeholder="Inserir o código SWIFT" autocomplete="off" value="{{$conta->SWIFT}}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="contacto">Contacto da instituição</label>
                    <br>
                    <input type="text" name="contacto" placeholder="Inserir um contacto da instituição" autocomplete="off" value="{{$conta->contacto}}" disabled>
                </div>
            </div>
            @if ($conta->obsConta == null)
            <br>
            @else
            <br><br>
            <div class="row">
                <div class="col">
                    <label for="obsConta">Observações da conta</label>
                    <br>
                    <textarea name="obsConta" rows="5" placeholder="{{$conta->obsConta}}" disabled></textarea>
                </div>
            </div>
            @endif
        </div>
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
