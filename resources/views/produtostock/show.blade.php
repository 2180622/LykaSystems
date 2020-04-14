@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de produto')

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
        <div class="float-right">
            <a href="{{route('fasestock.create')}}" class="top-button mr-2">Adicionar Fase Stock</a>
        </div>
        <br><br>
        <div class="cards-navigation">
            <div class="title">
                <h6>Ficha de Produto - {{ $produtostock->descricao }}</h6>
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
                            <th>Número de Fases</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    {{-- Corpo da tabela --}}
                    <tbody>
                        @foreach ($faseStocks as $faseStock)
                        <tr>
                            {{-- Número de fases --}}
                            <td><a class="name_link" href="/produtostock/{{$produtostock->idProdutoStock}}/{{$faseStock->idFaseStock}}">{{$nrfases++}}</a></td>
                            {{-- Descrição --}}
                            <td>{{$faseStock->descricao}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts --}}
@section('scripts')
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
