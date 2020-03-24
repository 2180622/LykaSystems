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
        <a href="{{route('phonebook.create')}}" class="top-button">Adicionar Contacto</a>
    </div>

    <br><br>


    <div class="cards-navigation">
        <div class="title">
            <h6>Lista de contactos</h6>
        </div>
        <br>

        <div class="row mt-3 mb-4">
            <div class="col">
                Estão registados no sistema <strong> XXX </strong> contactos
            </div>
        </div>

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


            {{-- Lista de Contactos --}}
            <div class="tab-pane fade show active" id="contacts" role="tabpanel" aria-labelledby="favorites-tab">

                <div class="row mt-3 mb-4">
                    <div class="col">
                        <span class="mr-2">Mostrar</span>
                        <select class="custom-select" id="records_per_page" style="width:80px">
                            <option selected>10</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <span class="ml-2">por página</span>
                    </div>
                    <div class="col ">
                        <div class="input-group pl-0 float-right" style="width:250px">
                            <input class="form-control my-0 py-1 red-border" type="text" id="customSearchBox"
                                placeholder="Procurar" aria-label="Procurar">
                            <div class="input-group-append">
                                <span class="input-group-text red lighten-3"><i class="fas fa-search text-grey"
                                        aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>


                <div class="table-responsive " style="overflow:hidden">


                    <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0"
                        style="overflow:hidden;">

                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>


                                <th class="text-center align-content-center ">Foto
                                    {{-- <input class="table-check" type="checkbox" value="" id="check_all"> --}}
                                </th>

                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone(1)</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>

                        {{-- Corpo da tabela --}}
                        <tbody>

                            {{-- @foreach ($clients as $client) --}}
                            <tr>
                                <th class="">
                                    <div class="align-middle mx-auto shadow-sm rounded"
                                        style="overflow:hidden; width:50px; height:50px">
                                        <a class="name_link" href="#">
                                            <img src="{{asset('storage/default-photos/contacto.png')}}" width="100%" class="mx-auto">
                                        </a>
                                    </div>

                                </th>

                                {{-- Nome e Apelido --}}
                                <th class="align-middle"><a class="name_link" href="#">NOME E APELIDO</a></th>

                                {{-- e-mail --}}
                                <th class="align-middle"> E-Mail </th>

                                {{-- Telefone(1) --}}
                                <th class="align-middle">Telefone(5)</th>


                                {{-- OPÇÔES --}}
                                <th class="text-center align-middle">
                                    <a href="#" class="btn_list_opt "
                                        title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                                    <a href="#" class="btn_list_opt btn_list_opt_edit"
                                        title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                                    <form method="POST" role="form" id="IDCLIENTE"
                                        action="#" class="d-inline-block form_client_id">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn_delete" title="Eliminar estudante" data-toggle="modal"
                                            data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
                                    </form>

                                </th>
                            </tr>
                            {{-- @endforeach --}}

                        </tbody>
                    </table>
                </div>
            </div>





            {{-- FORNECEDORES --}}
            <div class="tab-pane fade" id="fornecedores" role="tabpanel" aria-labelledby="fornecedores-tab">Food truck fixie
                locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit,
                blog sartorial
            </div>





            {{-- FAVORITOS --}}
            <div class="tab-pane fade" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">
                <div class="row text-center">
                    <div class="col col-2 card m-2 p-3">
                        <div><img src="#" width="60%" class="rounded shadow-sm mx-auto"></div>
                        <div>John Travolta<br>910 000 000</div>
                    </div>

                    <div class="col col-2 card m-2 p-3">
                        <div><img src="#" width="60%" class="rounded shadow-sm mx-auto"></div>
                        <div>John Travolta<br>910 000 000</div>
                    </div>

                    <div class="col col-2 card m-2 p-3">
                        <div><img src="#" width="60%" class="rounded shadow-sm mx-auto"></div>
                        <div>John Travolta<br>910 000 000</div>
                    </div>

                    <div class="col col-2 card m-2 p-3">
                        <div><img src="#" width="60%" class="rounded shadow-sm mx-auto"></div>
                        <div>John Travolta<br>910 000 000</div>
                    </div>

                    <div class="col col-2 card m-2 p-3">
                        <div><img src="#" width="60%" class="rounded shadow-sm mx-auto"></div>
                        <div>John Travolta<br>910 000 000</div>
                    </div>

                    <div class="col col-2 card m-2 p-3">
                        <div><img src="#" width="60%" class="rounded shadow-sm mx-auto"></div>
                        <div>John Travolta<br>910 000 000</div>
                    </div>

                </div>
            </div>

        </div>




    </div>
</div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/phonebook.js')}}"></script>

@endsection
