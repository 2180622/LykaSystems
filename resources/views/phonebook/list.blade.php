@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de contactos')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('css/datatables_general_style.css')}}" rel="stylesheet">

@endsection


{{-- Conteudo da Página --}}
@section('content')

<!-- MODAL DE INFORMAÇÔES -->

<div class="container mt-2 ">

    {{-- Navegação --}}
    <div class="float-left">
        <a href="javascript:history.go(-1)" title="Voltar"><i
                class="fas fa-arrow-left rounded-circle p-2 nav_btns mr-3"></i></a>
        <a href="javascript:window.history.forward();" title="Avançar"><i
                class="fas fa-arrow-right rounded-circle p-2 nav_btns"></i></a>
    </div>

    <div class="float-right">
        <a href="{{route('clients.create')}}" class="top-button">Adicionar Contacto</a>
    </div>

    <br><br>


    <div class="cards-navigation">
        <div class="title">
            <h6>Lista de contactos</h6>
        </div>
        <br>

        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">

            {{-- Contactos --}}
            <li class="nav-item">
                <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contacts" role="tab"
                    aria-controls="contacts" aria-selected="true">Contactos</a>
            </li>


            <li class="nav-item">
                <a class="nav-link" id="fornecedores-tab" data-toggle="tab" href="#fornecedores" role="tab"
                    aria-controls="fornecedores" aria-selected="false">Fornecedores</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="Favoritos-tab" data-toggle="tab" href="#favorites" role="tab"
                    aria-controls="favorites" aria-selected="false">Favoritos</a>
            </li>

        </ul>



        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="contacts" role="tabpanel" aria-labelledby="favorites-tab">Raw
                denim you
                probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master
                cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
                keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
                placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
                qui
            </div>

            <div class="tab-pane fade" id="fornecedores" role="tabpanel" aria-labelledby="fornecedores-tab">Food truck fixie
                locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit,
                blog sartorial
            </div>

            <div class="tab-pane fade" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">
                <div class="row text-center">
                    <div class="col col-2 card m-2 p-3">
                        Aquele Nigga<br>910 000 000
                    </div>

                    <div class="col col-2 card m-2 p-3">
                        John Travolta<br>910 000 000
                    </div>

                    <div class="col col-2 card m-2 p-3">
                        Bill Windows<br>910 000 000
                    </div>

                    <div class="col col-2 card m-2 p-3">
                        Pai Natal<br>910 000 000
                    </div>

                    <div class="col col-2 card m-2 p-3">
                        Ubber Eats<br>910 000 000
                    </div>

                    <div class="col col-2 card m-2 p-3">
                        Donald Trump<br>910 000 000
                    </div>

                </div>
            </div>

        </div>




    </div>
</div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')



@endsection
