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
    <div class="float-left buttons">
        <a href="javascript:history.go(-1)" title="Voltar">
            <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
        </a>
        <a href="javascript:window.history.forward();" title="Avançar">
            <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
        </a>
    </div>

    <div class="float-right">
        <a href="{{route('report')}}" class="top-button mr-2">reportar problema</a>
        <a href="{{route('contacts.create')}}" class="top-button">Adicionar Contacto</a>
    </div>

    <br><br>


    <div class="cards-navigation">
        <div class="title">
            <h6>Lista telefónica</h6>
        </div>
        <br>


        @if($contacts==null)
            <div class="border rounded bg-light p-3 text-muted"><small>(sem registos)</small></div>
        @else

        <div class="row mb-3">
            <div class="col">
                <div class="text-center text-secondary"><small>Existe <strong>{{count($contacts)}} contacto(s)</strong> registados</small></div>
            </div>
        </div>

        <div class="row p-3 ">
            <div class="col text-center mb-3">
                <div class="input-group pl-0  search-section mx-auto" style="width:50%">
                    <input class="shadow-sm" type="text" id="customSearchBox"
                        placeholder="Secção de procura" aria-label="Procurar">
                    <div class="search-button input-group-append">
                        <ion-icon name="search-outline" class="search-icon"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
        <br>
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
                            <th>Telefone</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>

                    {{-- Corpo da tabela --}}
                    <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>
                                        <div class="align-middle mx-auto shadow-sm rounded bg-white"
                                            style="overflow:hidden; width:50px; height:50px">
                                            <a class="name_link" href="{{route('contacts.show',$contact)}}">
                                                @if($contact->fotografia)
                                                <img src="{{Storage::disk('public')->url('contact-photos/').$contact->fotografia}}"
                                                    width="100%" class="mx-auto"">
                                                        @else
                                                            <img src=" {{Storage::disk('public')->url('default-photos/M.jpg')}}"
                                                    width="100%" class="mx-auto">
                                                @endif
                                            </a>
                                        </div>

                                    </td>

                                    {{-- Nome e Apelido --}}
                                    <td class="align-middle">
                                        @if($contact->favorito)
                                        <i class="fas fa-star text-warning mr-2" title="Contacto favorito"
                                            style="font-size:12px"></i>
                                        @endif

                                        <a class="name_link" href="{{route('contacts.show',$contact)}}">
                                            {{$contact->nome}}</a>
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
                                        <a href="{{route('contacts.show',$contact)}}" class="btn_list_opt "
                                            title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                                        <a href="{{route('contacts.edit',$contact)}}" class="btn_list_opt btn_list_opt_edit"
                                            title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                                        <form method="POST" role="form" id="{{ $contact->idContacto }}"
                                            action="{{route('contacts.destroy',$contact)}}" data="{{ $contact->nome }}"
                                            class="d-inline-block form_contact_id">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn_delete" title="Eliminar contacto" data-toggle="modal"
                                                data-target="#staticBackdrop"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach


                    </tbody>
                </table>

            </div>
        @endif
    </div>


</div>

@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/contacts.js')}}"></script>

@endsection
