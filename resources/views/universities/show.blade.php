@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de Universidade')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

<style>
    .active {
        color: #6A74C9
    }

    .edit_event_btn {
        display: inline-block;
        width: 26px;
        height: 26px;
        font-size: 14px;
        border-radius: 50%;
        background-color: white;
        border: 1px solid lightgray;
    }

    .delete_event_btn {
        width: 26px;
        height: 26px;
        font-size: 14px;
        border-radius: 50%;
        background-color: white;
        border: 1px solid lightgray;
    }

</style>
@endsection



{{-- Page Content --}}
@section('content')

{{-- Inclui a modal da agenda, utilizando as variaveis para a universidade --}}
@include('agends.partials.modal')

{{-- Inclui a modal de confirmação para apagar contacto --}}
@include('contacts.partials.modal')


{{-- Inclui a modal de confirmação para apagar evento--}}
@include('universities.partials.modal-events')




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


        <div class="card shadow-sm p-3" style="border-radius:10px">
            <div class="row font-weight-bold p-2" style="color:#6A74C9">
                <div class="col col-md-12 text-center my-auto "
                    style="min-width:195px; max-width:230px; max-height:295px; overflow:hidden">
                    <img class="align-middle p-1 rounded bg-white shadow-sm border"
                        src="{{Storage::disk('public')->url('default-photos/university.png')}}" style="width:100%">
                </div>

                <div class="col p-2" style="width:260px ; min-width:250px !important">

                    {{-- Informações Pessoais --}}
                    <div><span class="text-secondary ">Nome da Universidade:</span><br>{{$university->nome}}</div>
                    <br>

                    <div><span class="text-secondary ">Morada:</span><br>{{$university->morada}}</div>
                    <br>

                    <div><span class="text-secondary">NIF:</span> {{$university->NIF}}</div>
                    <br>

                    <div><span class="text-secondary">IBAN:</span><br>{{$university->IBAN}}</div>
                    <br>


                </div>

                <div class="col p-2" style="min-width: 200px">

                    <div><span class="text-secondary ">E-mail:</span> {{$university->email}}</div>
                    <br>

                    <div><span class="text-secondary">Telefone :</span> {{$university->telefone}}</div>
                    <br>

                    <br>

                    <a href="#" id="titleModalNew" class="top-button" data-toggle="modal"
                        data-target="#modalCalendar"><i class="fas fa-plus mr-2"></i>Adicionar evento</a><br><br>
                    <a href="{{route('contacts.create',$university)}}" class="top-button">
                        <i class="fas fa-plus mr-2"></i>Adicionar contacto</a>
                </div>


            </div>
        </div>


        <div class="row nav nav-fill w-100 text-center mx-auto p-3 ">


            <a class="nav-item nav-link active border p-3 m-1 bg-white rounded shadow-sm name_link" id="eventos-tab"
                data-toggle="tab" href="#eventos" role="tab" aria-controls="eventos" aria-selected="true">
                <div class="col"><i class="fas fa-calendar-alt mr-2"></i>Eventos</div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="estudantes-tab"
                data-toggle="tab" href="#estudantes" role="tab" aria-controls="estudantes" aria-selected="false">
                <div class="col">
                    <ion-icon name="person-circle-outline" class="mr-2"
                        style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px; right: 0px;">
                    </ion-icon>
                    Estudantes
                </div>
            </a>

            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="contactos-tab"
                data-toggle="tab" href="#contactos" role="tab" aria-controls="contactos" aria-selected="false">
                <div class="col"><i class="fas fa-address-book mr-2"></i>Lista telefónica</div>
            </a>


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link border" id="observacoes-tab"
                data-toggle="tab" href="#observacoes" role="tab" aria-controls="observacoes" aria-selected="false">
                <div class="col"><i class="fas fa-pencil-alt mr-2"></i>Observações</div>
            </a>

        </div>


        <div class="bg-white shadow-sm mb-4 p-4" style="margin-top:-30px">
            <div class="tab-content p-2 mt-3" id="myTabContent">


                {{-- Eventos --}}
                <div class="tab-pane fade show active" id="eventos" role="tabpanel" aria-labelledby="eventos-tab">
                    @if($eventos!=null)
                    <div class="row mx-auto pt-0" style="max-height:1000px; overflow:auto ">
                        @foreach ($eventos as $agenda)

                        <div>
                            <div class="col border rounded bg-light shadow-sm text-secondary m-2 mt-4 p-3"
                                style="min-width: 320px; max-width: 320px; height:auto; max-height:240px">

                                <div class="row p-0 m-0" style="margin-top:-30px!important">
                                    <div class="col text-right p-0">

                                        {{-- APAGAR --}}
                                        <form method="POST" role="form" id="#"
                                            action="{{route('agenda.destroy',$agenda)}}"
                                            class="d-inline-block form_university_event" data="{{$agenda->titulo}}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="delete_event_btn shadow-sm text-center btn_list_opt btn_delete mr-2"
                                                title="Eliminar Evento" data-toggle="modal" data-target="#exampleModal">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>

                                    </div>
                                </div>

                                <div class="mt-2"><i class="fas fa-square mr-2" title="{{$agenda->titulo}}"
                                        style="color:{{$agenda->cor}}"></i><strong>Evento:
                                    </strong>{{ \Illuminate\Support\Str::limit($agenda->titulo, 50, $end=' (...)') }}</strong>
                                </div>

                                <div class="mt-3">
                                    {{ \Illuminate\Support\Str::limit($agenda->descricao, 70, $end=' (...)') }}</div>


                                <div class="row ">

                                    <div class="col border-right ">
                                        <div class="mt-3">
                                            <strong>Inicio:</strong><br>{{ date('d-M-y', strtotime($agenda->dataInicio)) }}
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mt-3">
                                            <strong>Fim:</strong><br>{{ date('d-M-y', strtotime($agenda->dataFim)) }}
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        @endforeach
                    </div>
                    @else
                    <div class="border rounded bg-light p-3">
                        <div class="text-muted"><small>(sem registos)</small></div>
                    </div>
                    <br>
                    @endif


                </div>


                {{-- Lista de estudantes --}}
                <div class="tab-pane fade " id="estudantes" role="tabpanel" aria-labelledby="estudantes-tab">

                    @if($clients)

                    <div class="row">

                        <div class="col">
                            <div class="text-secondary">Existe {{count($clients)}} estudante(s) associados a esta
                                Universidade</div>
                            <br>
                            {{-- Input de procura nos resultados da dataTable --}}
                            <input type="text" class="shadow-sm" id="customSearchBox"
                                placeholder="Procurar nos resultados..." aria-label="Procurar">
                        </div>

                        <div class="col col-2 text-center" style="max-width: 130px">
                            <a class="name_link " href="{{route('clients.searchIndex')}}">
                                <div class="bg-light border shadow-sm p-2">
                                    <div><i class="fas fa-search" style="font-size:30px"></i></div>
                                    <div>Pesquisa avançada</div>
                                </div>
                            </a>
                        </div>

                    </div>


                    <br>


                    <div class="table-responsive">
                        <table id="dataTable" class="display table table-bordered table-hover " style="width:100%">

                            {{-- Cabeçalho da tabela --}}
                            <thead>
                                <tr>
                                    <th class="text-center align-content-center ">Foto</th>
                                    <th>Nome</th>
                                    <th>N.º Passaporte</th>
                                    <th>País</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                            </thead>

                            {{-- Corpo da tabela --}}
                            <tbody>

                                @foreach ($clients as $client)
                                <tr>
                                    <td>
                                        <div class="align-middle mx-auto shadow-sm rounded bg-white"
                                            style="overflow:hidden; width:50px; height:50px">
                                            <a class="name_link" href="{{route('clients.show',$client)}}">
                                                @if($client->fotografia)
                                                <img src="{{Storage::disk('public')->url('client-documents/'.$client->idCliente.'/').$client->fotografia}}"
                                                    width="100%" class="mx-auto">
                                                @elseif($client->genero == 'F')
                                                <img src="{{Storage::disk('public')->url('default-photos/F.jpg')}}"
                                                    width="100%" class="mx-auto">
                                                @else
                                                <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}"
                                                    width="100%" class="mx-auto">
                                                @endif
                                            </a>
                                        </div>

                                    </td>

                                    {{-- Nome e Apelido --}}
                                    <td class="align-middle"><a class="name_link"
                                            href="{{route('clients.show',$client)}}">{{ $client->nome }}
                                            {{ $client->apelido }}</a>
                                    </td>

                                    {{-- numPassaporte --}}
                                    <td class="align-middle">{{ $client->numPassaporte }}</td>


                                    {{-- paisNaturalidade --}}
                                    <td class="align-middle">{{ $client->paisNaturalidade }}</td>


                                    {{-- OPÇÔES --}}
                                    <td class="text-center align-middle">
                                        <a href="{{route('clients.show',$client)}}" class="btn_list_opt "
                                            title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                                        <a href="{{route('clients.edit',$client)}}"
                                            class="btn_list_opt btn_list_opt_edit" title="Editar"><i
                                                class="fas fa-pencil-alt mr-2"></i></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="border rounded bg-light p-3">
                        <div class="text-muted"><small>(sem registos)</small></div>
                    </div>
                    <br>
                    @endif

                </div>


                {{-- Lista de contactos --}}
                <div class="tab-pane fade" id="contactos" role="tabpanel" aria-labelledby="contactos-tab">
                    @if ($contacts)

                    {{-- PESQUISA?--}}

                    <div class="row">
                        <div class="col">
                            <div class="text-secondary">Existe {{count($contacts)}} registo(s) no sistema</div>
                        </div>

                    </div>

                    <br>

                    <div class="table-responsive">
                        <table id="dataTableContacts" class="display table table-bordered table-hover "
                            style="width:100%">

                            {{-- Cabeçalho da tabela --}}
                            <thead>
                                <tr>
                                    <th class="text-center align-content-center ">Foto</th>
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
                                            <a class="name_link" href="{{route('clients.show',$client)}}">
                                                @if($contact->fotografia)
                                                <img src="{{Storage::disk('public')->url('contact-photos/').$contact->fotografia}}"
                                                    width="100%" class="mx-auto">
                                                @else
                                                <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}"
                                                    width="100%" class="mx-auto">
                                                @endif
                                            </a>
                                        </div>

                                    </td>

                                    {{-- Nome --}}
                                    <td class="align-middle">
                                        {{-- Contacto favorito?? --}}
                                        @if($contact->favorito)
                                        <i class="fas fa-star text-warning mr-1" title="Contacto favorito"
                                            style="font-size:12px"></i>
                                        @endif
                                        <a class="name_link"
                                            href="{{route('contacts.show',[$contact,$university])}}">{{$contact->nome}}</a>
                                    </td>

                                    {{-- numPassaporte --}}
                                    <td class="align-middle">{{ $contact->email }}</td>


                                    {{-- paisNaturalidade --}}
                                    <td class="align-middle">{{ $contact->telefone1 }}</td>


                                    {{-- OPÇÔES --}}
                                    <td class="text-center align-middle">
                                        <a href="{{route('contacts.show',[$contact,$university])}}"
                                            class="btn_list_opt " title="Ver ficha completa"><i
                                                class="far fa-eye mr-2"></i></a>
                                        <a href="{{route('contacts.edit',[$contact,$university])}}"
                                            class="btn_list_opt btn_list_opt_edit" title="Editar"><i
                                                class="fas fa-pencil-alt mr-2"></i></a>

                                        <form method="POST" role="form" id="{{ $contact->idContacto }}"
                                            action="{{route('contacts.destroy',$contact)}}" data="{{ $contact->nome }}"
                                            class="d-inline-block form_contact_id">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn_delete" title="Eliminar contacto"
                                                data-toggle="modal" data-target="#staticBackdrop">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    @else
                    <div class="border rounded bg-light p-3">
                        <div class="text-muted"><small>(sem dados para mostrar)</small></div>
                    </div>
                    @endif
                </div>


                {{-- Observações --}}
                <div class="tab-pane fade" id="observacoes" role="tabpanel" aria-labelledby="observacoes-tab">

                    <div class="text-secondary mb-2">Observações gerais:</div>
                    <div class="border rounded bg-light p-3">
                        @if ($university->observacoes)
                        {{$university->observacoes}}
                        @else
                        <div class="text-muted"><small>(sem dados para mostrar)</small></div>
                        @endif
                    </div>

                    <br>

                    <div class="text-secondary mb-2">Observação dos Candidaturas:</div>
                    <div class="border rounded bg-light p-3">
                        @if ($university->obsCandidaturas)
                        {{$university->obsCandidaturas}}
                        @else
                        <div class="text-muted"><small>(sem dados para mostrar)</small></div>
                        @endif
                    </div>

                    <br>

                    <div class="text-secondary mb-2">Observação dos Cursos:</div>
                    <div class="border rounded bg-light p-3">
                        @if ($university->obsCursos)
                        {{$university->obsCursos}}
                        @else
                        <div class="text-muted"><small>(sem dados para mostrar)</small></div>
                        @endif
                    </div>

                </div>


            </div>
        </div>

    </div>
</div>
@endsection
{{-- Scripts --}}
@section('scripts')
<script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>
<script src="{{asset('/js/university_show.js')}}"></script>
<script src="{{asset('/js/agends.js')}}"></script>
<script src="{{asset('/js/newEventModalDefault.js')}}"></script>
@endsection
