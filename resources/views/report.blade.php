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
            <div class="alert alert-warning alert-dismissible fade show shadow-sm mt-4" role="alert">
                <strong>Olá {{$user->nome.' '.$user->apelido}}!</strong>
                <p class="mt-3 mb-2">Para reportar um problema basta preencher o formulário abaixo disponível que será enviado para um administrador.</p>
                <p>O administrador irá ler o seu problema e responder-lhe-á o mais depressa possível com uma solução.</p>
                <hr>
                <strong>Obrigado pela atenção.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <br>
        <div class="report-card shadow-sm">
            <form action="{{route('report.send')}}" method="get" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
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
                        <input type="text" name="telemovel" placeholder="Inserir número de telemóvel" value="{{$user->telefone1}}">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col">
                        <div class="help-button" id="tooltipReport" data-toggle="tooltip" data-placement="top" title="Nesta seccção tente ser o mais específico possível, em relação ao problema que está a enfrentar.">
                            <span>
                                ?
                            </span>
                        </div>
                        <label for="relatorio">Relatório do problema</label>
                        <br>
                        <textarea name="relatorio" rows="5" placeholder="Inserir um relatório acerca problema"></textarea>
                    </div>
                </div>
        </div>
        <div class="form-group text-right">
            <br>
            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Enviar relatório</button>
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
