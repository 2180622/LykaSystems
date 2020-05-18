@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ajuda')

{{-- CSS Style Link --}}
@section('styleLinks')
    <link href="{{asset('/css/help.css')}}" rel="stylesheet">
    <link href="{{asset('/css/help_list.css')}}" rel="stylesheet">
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
                <form action="/searchHelper" method="POST" enctype="multipart/form-data">

                    <div class="row justify-content-md-center">

                        <br>

                        <div class="col-md-12 text-center">
                            <label>Qual é a sua dúvida?</label>
                        </div>

                        <br> <br>

                        <div class="col-md-6 text-center">
                            <div class="search-bar-helper">
                                <input class="shadow-sm" type="search" id="searchHelper" placeholder="Palavras-chaves"
                                       aria-label="Procurar">
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

                        <br>

                        <div id="accordion" class="report-card">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fas fa-angle-right pb-2"></i> Como adicionar um Estudante?
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <p> A adição de um Estudante deverá ser feita de acordo com os seguintes
                                            passos: </p>
                                        <br>
                                        <p style="padding-bottom:4px">- Escolher a opção "
                                            <ion-icon name="person-circle-outline"
                                                      style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px;"></ion-icon>
                                            Estudante" através do menu de navegação lateral
                                        </p>
                                        <br>
                                        <p>- Pressionar o botão "Adicionar Estudante"</p>
                                        <br>
                                        <p>- Preencher os campos obrigatórios, que estão devidamente assinalados com uma
                                            <ion-icon name="close"
                                                      style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px"></ion-icon>
                                        </p>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                            <i class="fas fa-angle-right pb-2"></i> Como adicionar uma Universidade?
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <p> A adição de uma Universidade deverá ser feita de acordo com os seguintes
                                            passos: </p>
                                        <br>
                                        <p style="padding-bottom:4px">- Escolher a opção "<i
                                                class="fas fa-university mr-1"></i>
                                            Universidade" através do menu de navegação lateral
                                        </p>
                                        <br>
                                        <p>- Pressionar o botão "Adicionar Universidade"</p>
                                        <br>
                                        <p>- Preencher os campos obrigatórios, que estão devidamente assinalados com uma
                                            <ion-icon name="close"
                                                      style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px"></ion-icon>
                                        </p>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">

                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree" id="protudo">
                                        <i class="fas fa-angle-right pb-2"></i> Como adicionar um Agente?
                                    </button>

                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <p> A adição de um Agente deverá ser feita de acordo com os seguintes
                                            passos: </p>
                                        <br>
                                        <p style="padding-bottom:4px">- Escolher a opção "<i
                                                class="fas fa-user-tie mr-1"></i>
                                            Agente" através do menu de navegação lateral
                                        </p>
                                        <br>
                                        <p>- Pressionar o botão "Adicionar Agente"</p>
                                        <br>
                                        <p>- Preencher os campos obrigatórios, que estão devidamente assinalados com uma
                                            <ion-icon name="close"
                                                      style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px"></ion-icon>
                                        </p>
                                        <br>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingFour">

                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseFour" aria-expanded="false"
                                            aria-controls="collapseFour">
                                        <i class="fas fa-angle-right pb-2"></i> Como criar um Produto?
                                    </button>

                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <p> A criação de um Produto deverá ser feita de acordo com os seguintes
                                            passos: </p>
                                        <br>
                                        <p>- Escolher a opção " <i class="fas fa-tools"></i> Diversos " através do menu
                                            de navegação lateral</p>
                                        <br>
                                        <p>- Escolher a opção "Produtos de Stock"</p>
                                        <br>
                                        <p>- Pressionar o botão "Adicionar Produtos de Stock"</p>
                                        <br>
                                        <p>- Preencher os campos obrigatórios, que estão devidamente assinalados com uma
                                            <ion-icon name="close"
                                                      style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px"></ion-icon>
                                        </p>
                                        <br>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingFive">

                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseFive" aria-expanded="false"
                                            aria-controls="collapseFive">
                                        <i class="fas fa-angle-right pb-2"></i> Como adicionar Fornecedor?
                                    </button>

                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <p> A adição de um Fornecedor deverá ser feita de acordo com os seguintes
                                            passos: </p>
                                        <br>
                                        <p>- Escolher a opção " <i class="fas fa-tools"></i> Diversos " através do menu
                                            de navegação lateral</p>
                                        <br>
                                        <p>- Escolher a opção "Fornecedor"</p>
                                        <br>
                                        <p>- Pressionar o botão "Adicionar Fornecedor"</p>
                                        <br>
                                        <p>- Preencher os campos obrigatórios, assinalados com asterisco &#10033;</p>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
