@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Edição de uma conta bancária')

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
            <h6>Edição da conta bancária: {{$contum->descricao}}</h6>
        </div>
        <br>
        <div class="payment-card shadow-sm">
            <form action="{{route('conta.update', $contum)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <label for="descricao">Descrição da conta *</label>
                        <br>
                        <input type="text" name="descricao" placeholder="Inserir uma descrição" autocomplete="off" value="{{old('descricao', $contum->descricao)}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="instituicao">Nome da instituição *</label>
                        <br>
                        <input type="text" name="instituicao" placeholder="Inserir o nome da instituição" autocomplete="off" value="{{old('instituicao', $contum->instituicao)}}" required>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="titular">Nome do titular *</label>
                        <br>
                        <input type="text" name="titular" placeholder="Inserir o nome do titular" autocomplete="off" value="{{old('titular', $contum->titular)}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="morada">Morada da instituição *</label>
                        <br>
                        <input type="text" name="morada" placeholder="Inserir a morada da instituição" autocomplete="off" value="{{old('morada', $contum->morada)}}" required>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="numConta">Número de conta *</label>
                        <br>
                        <input type="text" name="numConta" placeholder="Inserir o número de conta" autocomplete="off" value="{{old('numConta', $contum->numConta)}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="IBAN">Código IBAN *</label>
                        <br>
                        <input type="text" name="IBAN" placeholder="Inserir o código IBAN" autocomplete="off" value="{{old('IBAN', $contum->IBAN)}}" required>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="SWIFT">Código SWIFT *</label>
                        <br>
                        <input type="text" name="SWIFT" placeholder="Inserir o código SWIFT" autocomplete="off" value="{{old('SWIFT', $contum->SWIFT)}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="contacto">Contacto da instituição</label>
                        <br>
                        <input type="text" name="contacto" placeholder="Inserir um contacto da instituição" autocomplete="off" value="{{old('contacto', $contum->contacto)}}">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col">
                        <label for="obsConta">Observações da conta</label>
                        <br>
                        <textarea name="obsConta" rows="5" placeholder="@if($contum->obsConta == null) Nada a apresentar. @else {{old('obsConta', $contum->obsConta)}} @endif"></textarea>
                    </div>
                </div>
        </div>
        <div class="form-group text-right">
            <br>
            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Editar conta bancária</button>
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
