@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Estudantes')


{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('css/client.css')}}" rel="stylesheet">
@endsection


{{-- Conteudo da Página --}}
@section('content')
<div class="container mt-2">
    <div class="float-right">
        <a href="{{route('clients.create')}}" class="top-button">Adicionar Estudante</a>
    </div>
    <br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Listagem de Estudantes</h6>
        </div>
        <br>


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
                      <span class="input-group-text red lighten-3" ><i class="fas fa-search text-grey"
                          aria-hidden="true"></i></span>
                    </div>
                  </div>
            </div>
        </div>
<hr>


        <div class="table-responsive " style="overflow:hidden">


            <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0" style="overflow:hidden;">

                {{-- Cabeçalho da tabela --}}
                <thead >
                    <tr >


                        <th class="text-center align-content-center ">Foto
                            {{-- <input class="table-check" type="checkbox" value="" id="check_all"> --}}
                        </th>

                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Naturalidade</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>

                {{-- Corpo da tabela --}}
                <tbody >

                    @foreach ($clients as $client)
                        <tr>
                            <th class="">
                                <div class="align-middle mx-auto shadow-sm rounded-circle" style="overflow:hidden; width:50px; height:50px">
                                    <img src="{{Storage::disk('public')->url('client-photos/').$client->fotografia}}"
                                        width="100%" class="mx-auto">
                                    </div>
                                {{-- <input class="table-check" type="checkbox" value="" id="check_{{ $client->idCliente }}"> --}}
                            </th>
                            <th class="align-middle">{{ $client->nome }} {{ $client->apelido }}</th>
                            <th class="align-middle">{{ $client->email }}</th>
                            <th class="align-middle">{{ $client->paisNaturalidade }}</th>
                            <th class="text-center align-middle">
                                <a href="#fghjk" class="btn_list_opt " title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                                <a href="#" class="btn_list_opt btn_list_opt_edit" title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>
                                <a href="#" class="btn_list_opt btn_list_opt_delete" title="Eliminar"><i class="far fa-trash-alt"></i></a>
                            </th>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>



    </div>
</div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/clients.js')}}"></script>

@endsection
