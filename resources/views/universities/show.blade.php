@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de Universidade')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">
@endsection



{{-- Page Content --}}
@section('content')
@include('universities.partials.add-event')

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
        <a href="{{route('report')}}" class="top-button mr-2">reportar problema</a>
        <a href="{{route('universities.edit',$university)}}" class="top-button mr-2">Editar informação</a>
    </div>

    <br><br>

    <div class="cards-navigation">

        <div class="row">
            <div class="col">
                <div class="title">
                    <h6>Ficha de Universidade</h6>
                </div>
            </div>
            <div class="col text-right">
                <div class="text-muted"><small>Adicionado em:
                        {{ date('d-M-y', strtotime($university->created_at)) }}</small></div>

                <div class="text-muted"><small>Ultima atualização:
                        {{ date('d-M-y', strtotime($university->updated_at)) }}</small></div>
            </div>
        </div>


        <br>



        <div class="row font-weight-bold border p-2 pt-3 pb-3" style="color:#6A74C9">
            <div class="col p-0 text-center" style="flex: 0 0 20%; -ms-flex: 0 0 20%; min-width:195px">

                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('default-photos/university.png')}}" width="100%"
                    style="width:90%">

            </div>

            <div class="col p-2" style="min-width:280px !important">


                {{-- Informações da universidade --}}
                <div><span class="text-secondary ">Nome da Universidade:</span> {{$university->nome}}</div><br>

                <div><span class="text-secondary ">Morada:</span> {{$university->morada}}</div><br>

                <div><span class="text-secondary">NIF:</span> {{$university->NIF}}</div><br>

                <div><span class="text-secondary">IBAN:</span> {{$university->IBAN}}</div><br>

            </div>

            <div class="col p-2" style="min-width: 200px">
                <div><span class="text-secondary ">E-mail:</span> {{$university->email}}</div><br>

                <div><span class="text-secondary">Telefone :</span> {{$university->telefone}}</div><br>

                <br>
                <a href="#" class="top-button" data-toggle="modal" data-target="#modalCalendar"><i class="fas fa-plus mr-2"></i>Adicionar evento</a><br><br>
                <a href="{{route('contacts.create',$university)}}" class="top-button" ><i class="fas fa-plus mr-2"></i>Adicionar contacto</a>

            </div>
        </div>

    </div>






    <ul class="nav nav-tabs mt-5 mb-4" id="myTab" role="tablist">

        {{-- MENU: Eventos --}}
        <li class="nav-item " style="width:20%; min-width:110px">
            <a class="nav-link active" id="eventos-tab" data-toggle="tab" href="#eventos" role="tab"
                aria-controls="evento" aria-selected="false">Eventos</a>
        </li>

        {{-- MENU: Estudantes associados --}}
        <li class="nav-item text-center" style="width:20%; min-width:144px">
            <a class="nav-link" id="estudantes-tab" data-toggle="tab" href="#estudantes" role="tab"
                aria-controls="estudante" aria-selected="false">Estudantes</a>
        </li>

        {{-- MENU: Observações --}}
        <li class="nav-item text-center" style="width:20%; min-width:144px">
            <a class="nav-link" id="obsevacoes-tab" data-toggle="tab" href="#obsevacoes" role="tab"
                aria-controls="obsevacao" aria-selected="false">Observações</a>
        </li>

        {{-- MENU: Contactos --}}
        <li class="nav-item text-center" style="width:20%; min-width:144px">
            <a class="nav-link" id="contactos-tab" data-toggle="tab" href="#contactos" role="tab"
                aria-controls="contacto" aria-selected="false">Contactos</a>
        </li>

    </ul>



    <div class="tab-content p-2 " id="myTabContent">

        {{-- Conteudo: Eventos --}}
        <div class="tab-pane fade active show text-muted" id="eventos" role="tabpanel" aria-labelledby="eventos-tab">

            @if($eventos!=null)
                <div class="table-responsive " style="overflow:hidden">

                    <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0"
                        style="overflow:hidden;">

                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>
                                <th style="width:10px">{{-- COR DO EVENTO --}}</th>
                                <th>Título</th>
                                <th>Início</th>
                                <th>Fim</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>

                        {{-- Corpo da tabela --}}
                        <tbody>


                            @foreach ($eventos as $evento)
                            <tr>
                                <td style="width:10px"><span class="p-1 shadow-sm" style="background-color:{{$evento->cor}}"></span>
                                </td>

                                {{-- Título --}}
                                <td><a class="name_link" href="#">{{$evento->titulo}}</td>

                                {{-- Ínicio --}}
                                <td class="align-middle">{{ date('d-M-y', strtotime($evento->dataInicio)) }}</td>

                                {{-- Fim --}}
                                <td class="align-middle">{{ date('d-M-y', strtotime($evento->dataFim)) }}</td>


                                {{-- OPÇÔES --}}
                                <td class="text-center align-middle">
                                    <a href="#" class="btn_list_opt " title="Ver ficha completa"><i
                                            class="far fa-eye mr-2"></i></a>
                                    <a href="#" class="btn_list_opt btn_list_opt_edit" title="Editar"><i
                                            class="fas fa-pencil-alt mr-2"></i></a>

                                    <form method="POST" role="form" id="#" action="#"
                                        class="d-inline-block form_university_id" data="#">
                                        @csrf
                                        {{--  @method('DELETE') --}}
                                        <button type="submit" class="btn_delete" title="Eliminar Evento" data-toggle="modal"
                                            data-target="#eliminarUniversidade" data-title="#"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @else
                <small class="text-muted">(Sem eventos marcados)</small>
            @endif

        </div>




        {{-- Conteudo: Contactos --}}
        <div class="tab-pane fade show text-muted" id="contactos" role="tabpanel" aria-labelledby="Contactos-tab">

            @if ($contacts)
                @foreach ($contacts as $contact)
                    {{$contact->nome}}
                @endforeach
            @else
                <small class="text-muted">(Sem contactos registados)</small>
            @endif
        </div>






        {{-- Conteudo: Observações --}}
        <div class="tab-pane fade show text-muted" id="obsevacoes" role="tabpanel" aria-labelledby="obsevacoes-tab">
            <div>
                <span class="text-secondary">Observação dos Contactos:</span> {{$university->obsContactos}}
            </div>

            <br>

            <div>
                <span class="text-secondary">Observação dos Cursos:</span> {{$university->obsCursos}}
            </div>

            <br>

            <div>
                <span class="text-secondary">Observação dos Candidaturas:</span> {{$university->obsCandidaturas}}
            </div>

        </div>









        {{-- Conteudo: LISTA DE ESTUDANTES --}}
        <div class="tab-pane fade show text-muted" id="estudantes" role="tabpanel" aria-labelledby="estudantes-tab">

            @if($clients!=null)
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
                            <input class="form-control my-0 py-1 red-border" type="text" id="customSearchBox" placeholder="Procurar" aria-label="Procurar">
                            <div class="input-group-append">
                                <span class="input-group-text red lighten-3"><i class="fas fa-search text-grey" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>


                <div class="table-responsive " style="overflow:hidden">


                    <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0" style="overflow:hidden;">

                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>
                                <th class="text-center align-content-center ">Foto</th>
                                <th>Nome</th>
                                <th>Naturalidade</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>

                        {{-- Corpo da tabela --}}
                        <tbody>

                            @foreach ($clients as $client)
                            <tr>
                                <td >
                                    <div class="align-middle mx-auto shadow-sm rounded bg-white" style="overflow:hidden; width:50px; height:50px">
                                        <a class="name_link" href="{{route('clients.show',$client)}}">
                                            @if($client->fotografia)
                                                <img src="{{Storage::disk('public')->url('client-documents/'.$client->idCliente.$client->nome.'/').$client->fotografia}}" width="100%" class="mx-auto">
                                                @elseif($client->genero == 'F')
                                                    <img src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" width="100%" class="mx-auto">
                                                    @else
                                                    <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                                                    @endif
                                        </a>
                                    </div>

                                </td>

                                {{-- Nome e Apelido --}}
                                <td class="align-middle"><a class="name_link" href="{{route('clients.show',$client)}}">{{ $client->nome }} {{ $client->apelido }}</a></td>

                                {{-- paisNaturalidade --}}
                                <td class="align-middle">{{ $client->paisNaturalidade }}</td>

                                {{-- OPÇÔES --}}
                                <td class="text-center align-middle">
                                    <a href="{{route('clients.show',$client)}}" class="btn_list_opt " title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                                    <a href="{{route('clients.edit',$client)}}" class="btn_list_opt btn_list_opt_edit" title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @else
                <small class="text-muted">(Ainda sem estudantes associados)</small>
            @endif




        </div>


    </div>





















</div>

@endsection

{{-- Scripts --}}
@section('scripts')
<script src="{{asset('/js/university_show.js')}}"></script>
@endsection
