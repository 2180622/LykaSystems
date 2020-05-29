@extends('layout.master')

{{-- Page Title --}}
@section('title', 'FaseStock')

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
        <div class="cards-navigation">
            <div class="title">
                <h6>Ficha de Fase - {{ $fasestock->descricao }}</h6>
            </div>
            <div class="bg-white shadow-sm mb-4 p-4" style="border-radius:10px;">
              <div class="table-responsive " style="overflow:hidden">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" row-border="0" style="overflow:hidden;">
                    {{-- Cabeçalho da tabela --}}
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Documento</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>
                    {{-- Corpo da tabela --}}
                    <tbody>
                        @foreach ($docstocks as $docstock)
                        <tr>
                            {{-- Tipo --}}
                            <td><a class="name_link" href="{{route('documentostock.show',$docstock)}}">{{$docstock->tipo}}</a></td>
                            {{-- Documento --}}
                            <td><a class="name_link" href="{{route('documentostock.show',$docstock)}}">{{$docstock->tipoDocumento}}</a></td>
                            {{-- OPÇÔES --}}
                            <td class="text-center align-middle">
                                <a href="{{route('documentostock.edit', $docstock)}}" class="btn_list_opt btn_list_opt_edit" title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>

                                <form method="POST" role="form" id="{{ $docstock->idDocStock }}"
                                    action="{{route('documentostock.destroy',$docstock)}}" class="d-inline-block form_client_id">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn_delete" title="Eliminar DocStock" data-toggle="modal"
                                        data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                    <form class="form-group needs-validation pt-3" action="{{route('documentostock.store', $fasestock)}}" method="post" id="form_documentos"
                      enctype="multipart/form-data" novalidate>
                      @csrf
                      <div class="tab-content p-2 mt-3" id="myTabContent">
                          <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
                              <div class="row">
                                  <div class="col">
                                      {{-- INPUT tipo --}}
                                      <label for="">Tipo (DocumentoStock):</label><br>
                                      <select type="text" class="form-control" name="tipo" id="tipodocstock"
                                        onchange="myFunction()" required>
                                         <option value="Pessoal">Pessoal</option>
                                         <option value="Academico">Academico</option>
                                      </select><br><br><br>
                                      {{-- INPUT tipoDocumento --}}
                                        <label for="">Tipo de Documento:</label>
                                        <input class="form-control" style="width: 100%;" name="tipoDocumento" required>
                                  </div>
                                </div>
                            </div>
                      </div>
                      <div class="form-group text-right">
                          <br><br>
                          <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Adicionar Documento Stock</button>
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
