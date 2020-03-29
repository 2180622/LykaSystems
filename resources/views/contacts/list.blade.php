@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de contactos')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">


@endsection


{{-- Conteudo da Página --}}
@section('content')
@include('contacts.partials.modal')
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
        <a href="{{route('contacts.create')}}" class="top-button">Adicionar Contacto</a>
    </div>

    <br><br>


    <div class="cards-navigation">
        <div class="title">
            <h6>Lista telefónica</h6>
        </div>
        <br>

        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">

            {{-- Contactos --}}
            <li class="nav-item">
                <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contacts" role="tab"
                    aria-controls="contacts" aria-selected="true">Contactos</a>
            </li>


{{--             <li class="nav-item">
                <a class="nav-link" id="fornecedores-tab" data-toggle="tab" href="#fornecedores" role="tab"
                    aria-controls="fornecedores" aria-selected="false">Fornecedores</a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link" id="Favoritos-tab" data-toggle="tab" href="#favorites" role="tab"
                    aria-controls="favorites" aria-selected="false"><i class="fas fa-star text-warning mr-2"></i>Favoritos</a>
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

                            @foreach ($contacts as $key => $contact)
                            <tr>
                                <td>
                                    <div class="align-middle mx-auto shadow-sm rounded" style="overflow:hidden; width:50px; height:50px">
                                        <a class="name_link" href="{{route('contacts.show',$contact)}}">
                                            @if($contact->fotografia)
                                                <img src="{{Storage::disk('public')->url('contact-photos/').$contact->fotografia}}" width="100%" class="mx-auto"">
                                            @else
                                                <img src=" {{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                                            @endif
                                        </a>
                                    </div>

                                </td>

                                {{-- Nome e Apelido --}}
                                <td class="align-middle">
                                    <a class="name_link" href="{{route('contacts.show',$contact)}}">
                                    {{$contact->nome}}</a>

                                    @if($contact->favorito)
                                        <i class="fas fa-star text-warning ml-1" title="Contacto favorito" style="font-size:12px"></i>
                                    @endif
                                </td>

                                {{-- e-mail --}}
                                <td class="align-middle">
                                    @if ($contact->email==null)
                                        <span class="text-muted" style="font-weight:normal"><small>(sem informação)</small><span>
                                    @else
                                        {{$contact->email}}
                                    @endif
                                </td>

                                {{-- Telefone(1) --}}
                                <td class="align-middle">
                                    @if ($contact->telefone1==null)
                                    <span class="text-muted" style="font-weight:normal"><small>(sem informação)</small><span>
                                @else
                                    {{$contact->telefone1}}
                                @endif
                                </td>


                                {{-- OPÇÔES --}}
                                <td class="text-center align-middle">
                                    <a href="{{route('contacts.show',$contact)}}" class="btn_list_opt " title="Ver ficha completa"><i
                                            class="far fa-eye mr-2"></i></a>
                                    <a href="{{route('contacts.edit',$contact)}}" class="btn_list_opt btn_list_opt_edit" title="Editar"><i
                                            class="fas fa-pencil-alt mr-2"></i></a>

                                            <form method="POST" role="form" id="{{ $contact->idContacto }}"
                                                action="{{route('contacts.destroy',$contact)}}" data="{{ $contact->nome }}" class="d-inline-block form_client_id">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn_delete" title="Eliminar contacto" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>





            {{-- FORNECEDORES --}}
{{--             <div class="tab-pane fade show" id="fornecedores" role="tabpanel" aria-labelledby="fornecedores-tab">
                FORNECEDORES
            </div>
 --}}




            {{-- FAVORITOS --}}
            <div class="tab-pane fade show " id="favorites" role="tabpanel" aria-labelledby="favorites-tab">
                <div class="row text-center">

                    @foreach ($contacts as $contact )
                    @if( $contact->favorito==true)
                    <div class="col col-2 card m-2 p-3 ">
                        <a href="{{route('contacts.show',$contact)}}" style="text-decoration: none;">
                            <div>
                                @if($contact->fotografia)
                                    <img width="60%" class="rounded shadow-sm mx-auto" src="{{Storage::disk('public')->url('contact-photos/').$contact->fotografia}}" style="width:90%">
                                @else
                                    <img width="60%" class="rounded shadow-sm mx-auto" src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:90%">
                                @endif
                            </div>
                            <div class="mt-3">{{$contact->nome}}</div>
                        </a>
                    </div>
                    @endif
                    @endforeach


                </div>
            </div>

        </div>




    </div>
</div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/contacts.js')}}"></script>

@endsection
