@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Lista de Utilizadores')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/payment.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')

<div class="container mt-2">
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
        <div class="row mt-3 mb-4">
            <div class="col-md-8">
                <div class="title">
                    <h6 class="mt-1">Listagem de pagamentos</h6>
                </div>
            </div>
            <div class="col test">
                <div class="search-bar">
                    <p>Secção de procura</p>
                    <div class="search-button">
                        <ion-icon name="search-outline" class="search-icon"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive " style="overflow:hidden">
            <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0" style="overflow:hidden;">
                {{-- Cabeçalho da tabela --}}
                <br>

                {{-- Corpo da tabela --}}
                <tbody>
                    <tr>
                        <td class="align-middle">John Doe</td>
                        <td class="align-middle">125€</td>
                        <td class="align-middle">Fase 01</td>
                        <td class="align-middle">Pendente</td>
                    </tr>
                    <tr>
                        <td class="align-middle">Doe Adminer</td>
                        <td class="align-middle" style="color:#FF3D00;">7.5€</td>
                        <td class="align-middle">Fase 01</td>
                        <td class="align-middle">Dívida</td>
                    </tr>
                    <tr>
                        <td class="align-middle">John Doe</td>
                        <td class="align-middle">125€</td>
                        <td class="align-middle">Fase 01</td>
                        <td class="align-middle">Pendente</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
