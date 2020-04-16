@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Reportar Problema')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/report.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')
<div class="container mt-2">
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

    <?php
      if (Auth()->user()->tipo == 'admin') {
        $user = Auth()->user()->admin;
      }elseif (Auth()->user()->tipo == 'agente') {
        $user = Auth()->user()->agente;
      }else {
        $user = Auth()->user()->cliente;
      }
    ?>

    <div class="cards-navigation">
        <div class="title">
            <h6>Reportar um problema</h6>
            <br>
            <p>Para reportar um problema basta preencher o formulário abaixo disponível.</p>
        </div>
        <br>
        <div class="report-card shadow-sm">
            <form action="#" method="post" enctype="multipart/form-data" name="chargeForm">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="Some relevant help.">
                            <span>
                                ?
                            </span>
                        </div>
                        <label for="nomeCompleto">Nome completo</label>
                        <br>
                        <input type="text" name="nomeCompleto" placeholder="Inserir nome completo" autocomplete="off" value="{{$user->nome.' '.$user->apelido}}">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="email">Endereço eletrónico</label>
                        <br>
                        <input type="text" name="email" placeholder="Inserir endereço eletrónico" value="{{$user->email}}">
                    </div>
                    <div class="col-md-6">
                        <label for="telemovel">Número de telemóvel</label>
                        <br>
                        <input type="text" name="telemovel" placeholder="Inserir número de telemóvel">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col">
                        <label for="observacoes">Observações</label>
                        <br>
                        <textarea name="observacoes" rows="5"></textarea>
                    </div>
                </div>
        </div>
        <div class="form-group text-right">
            <br>
            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">confirmar cobrança</button>
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
