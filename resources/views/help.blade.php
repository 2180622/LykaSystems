@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ajuda')

{{-- CSS Style Link --}}
@section('styleLinks')
    <link href="{{asset('/css/help.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
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
            <div class="title">
                <h6>Ajuda e Perguntas Frequentes</h6>
            </div>

            <br>

            <div class="report-card shadow-sm">
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="row justify-content-md-center">

                        <br>

                        <div class="col-md-12 text-center">
                            <label>Qual é a sua dúvida?</label>
                        </div>

                        <br> <br>

                        <div class="col-md-6 text-center">
                            <div class="search-bar-helper">
                                <input class="shadow-sm" type="text" id="searchHelper" placeholder="Palavras-chaves" aria-label="Procurar">
                                <div class="search-button-helper">
                                    <ion-icon name="search-outline" class="search-icon-helper"></ion-icon>
                                </div>
                            </div>
                        </div>
                        <br><br><br>
                    </div>

                    <div class="row">

                        <div class="col-md-12 text-center">
                            <label>Perguntas Frequentes</label>
                        </div>

                        <br><br><br>

                        <div class="col-md-4 text-center card-help-info">
                            <div class="card shadow">
                                <h5 class="card-title">Estudantes</h5>
                                <p class="card-text pl-4 text-left">
                                    <a> <i class="fas fa-angle-right"></i> Como criar um
                                        Estudante?</a>
                                    <br>
                                    <a> <i class="fas fa-angle-right"></i> Como editar um
                                        Estudante?</a>
                                </p>
                            </div>
                        </div>

                        <br> <br> <br>

                        <div class="col-md-4 text-center card-help-info">
                            <div class="card shadow">
                                <h5 class="card-title">Produtos</h5>
                                <p class="card-text pl-4 text-left">
                                    <a> <i class="fas fa-angle-right"></i> Como adicionar Produto?</a>
                                    <br>
                                </p>
                            </div>
                        </div>

                        <br> <br> <br>

                        <div class="col-md-4 text-center card-help-info">
                            <div class="card shadow">
                                <h5 class="card-title">Universidades</h5>
                                <p class="card-text pl-4 text-left">
                                    <a> <i class="fas fa-angle-right"></i> Como criar um Universidade?</a>
                                    <br>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
