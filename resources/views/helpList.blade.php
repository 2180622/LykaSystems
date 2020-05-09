@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ajuda')

{{-- CSS Style Link --}}
@section('styleLinks')
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

            <div class="report-card">

                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-angle-right pb-2"></i> Como criar um Estudante?
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                             data-parent="#accordion">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                    <i class="fas fa-angle-right pb-2"></i> Como editar um Estudante?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                             data-parent="#accordion">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">

                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    <i class="fas fa-angle-right pb-2"></i> Como editar um Estudante?
                                </button>

                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                             data-parent="#accordion">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
