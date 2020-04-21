@extends('layout.master')

{{-- Page Title --}}
@section('title', 'FaseStock')

{{-- CSS Style Link --}}
@section('styleLinks')

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
            <br>
            <div class="row font-weight-bold border p-2 pt-3 pb-3" style="color:#6A74C9">
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
                            <th>Número de Documentos</th>
                            <th>Tipo</th>
                            <th>Documento</th>
                        </tr>
                    </thead>
                    {{-- Corpo da tabela --}}
                    <tbody>
                        @foreach ($docStocks as $docStock)
                        <tr>
                            {{-- Número de Documentos --}}
                            <td><a class="name_link" href="/fasestock/{{$fasestock->idFaseStock}}/{{$docStock->idDocStock}}">{{$nrDocs++}}</a></td>
                            {{-- Tipo --}}
                            <td>{{$docStock->tipo}}</td>
                            {{-- Documento --}}
                            @if ($docStock->tipoPessoal == null)
                              <td>{{$docStock->tipoAcademico}}</td>
                            @else
                              <td>{{$docStock->tipoPessoal}}</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>

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
                                        <option value="None">...</option>
                                         <option value="Pessoal">Pessoal</option>
                                         <option value="Academico">Academico</option>
                                      </select><br><br><br><br>
                                      {{-- INPUT Documento --}}
                                      <div class="" id="tipoacademico">
                                        <label for="">Documento Academico</label>
                                        <select class="form-control" name="tipoAcademico">
                                          <option value=NULL>...</option>
                                          <option value="Exame Universitário">Exame Universitário</option>
                                          <option value="Exame Nacional">Exame Nacional</option>
                                          <option value="Diploma">Diploma</option>
                                          <option value="Certificado">Certificado</option>
                                        </select>
                                      </div>

                                      <div class="" id="tipopessoal">
                                        <label for="">Documento Pessoal</label>
                                        <select class="form-control" name="tipoPessoal">
                                          <option value=NULL>...</option>
                                          <option value="Passaport">Passaport</option>
                                          <option value="Cartão Cidadão">Cartão de Cidadão</option>
                                          <option value="Carta Condução">Carta de Condução</option>
                                          <option value="Doc. Oficial">Documento Oficial</option>
                                        </select>
                                      </div>
                                  </div>
                                </div>
                            </div>
                      </div>
                      <div class="form-group text-right">
                          <br><br>
                          <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Adicionar Documento Stock</button>
                      </div>
                    </form>
                </table>
            </div>
        </div>
    </div>

@endsection
{{-- Scripts --}}
@section('scripts')
  <style>
  #tipopessoal {
    display: none;
  }

  #tipoacademico {
    display: none;
  }
  </style>

  <script type="text/javascript">
    function myFunction() {
        var select = document.getElementById("tipodocstock");
        var tipopessoal = document.getElementById("tipopessoal");
        var tipoacademico = document.getElementById("tipoacademico");
        tipopessoal.style.display = select.value == "Pessoal" ? "block" : "none";
        tipoacademico.style.display = select.value == "Academico" ? "block" : "none";
    }
  </script>
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
