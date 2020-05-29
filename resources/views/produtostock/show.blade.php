@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de produto')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')

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
        <br><br>
        <div class="">
            <div class="title">
                <h6>Ficha de Produto - {{ $produtostock->descricao }}</h6>
            </div>
            <div class="bg-white shadow-sm mb-4 p-4" style="border-radius:10px;">
              <div class="table-responsive ">
                <table nowarp class="table table-bordered table-hover " id="dataTable" style="width:100%">
                    {{-- Cabeçalho da tabela --}}
                    <thead>
                        <tr>
                            <th class="text-center">Descrição</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>
                    {{-- Corpo da tabela --}}
                    <tbody>
                        @foreach ($faseStocks as $faseStock)
                        <tr>
                            {{-- Descrição --}}
                            <td class="text-center align-middle">
                                <a class="name_link" href="{{route('fasestock.show',$faseStock)}}">{{$faseStock->descricao}}</a>
                            </td>
                            {{-- OPÇÔES --}}
                            <td class="text-center align-middle">
                                <a href="{{route('fasestock.edit', $faseStock)}}" class="btn_list_opt btn_list_opt_edit" title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                                <form method="POST" role="form" id="{{ $faseStock->idFaseStock }}"
                                    action="{{route('fasestock.destroy',$faseStock)}}" class="d-inline-block form_client_id">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn_delete" title="Eliminar estudante" data-toggle="modal"
                                        data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                    <form class="form-group needs-validation pt-3" action="{{route('fasestock.store', $produtostock)}}" method="post" id="form_fase"
                      enctype="multipart/form-data" novalidate>
                      @csrf


                      <div class="tab-content p-2 mt-3" id="myTabContent" style="width: 100%; border-radius:10px;">
                                    {{-- INPUT descricao fasestock --}}
                                      <label for="">Descrição (FaseStock):</label><br>
                                      <input type="text" class="shadow-sm" style="width: 100%;" name="descricao" id="descricaofase"required><br>
                      </div>


                      <div class="form-group text-right">
                          <br><br>
                          <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Adicionar Fase Stock</button>
                      </div>
                    </form>
            </div>
          </div>
        </div>
    </div>

@endsection

{{-- Scripts --}}
@section('scripts')
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
