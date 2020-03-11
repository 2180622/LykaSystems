@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de utilizadores')

{{-- Estilos de CSS --}}
@section('styleLinks')
{{-- <link href="{{asset('css/NOME_DO_FICHEIRO.css')}}" rel="stylesheet"> --}}
@endsection



{{-- Conteudo da Página --}}
@section('content')

<h3>Lista de utilizadores</h3>

<button type="button" name="button"><a href="{{route('users.create')}}">Adicionar Administrador</button><br><br><br><br>

<div class="">
  <table nowarp class="table table-borderless" id="dataTable" width="100%" row-border="0" style="overflow:hidden;">

      {{-- Cabeçalho da tabela --}}
      <thead >
          <tr >
              <th class="text-center align-content-center ">Foto
                  {{-- <input class="table-check" type="checkbox" value="" id="check_all"> --}}
              </th>
              <th>Nome do Utilizador</th>
              <th>Endereço Eletrónico</th>
              <th>Tipo de Utilizador</th>
              <th class="text-center">Opções</th>
          </tr>
      </thead>

      {{-- Corpo da tabela --}}
      <tbody >
      </tbody>
  </table>
</div>



@endsection







{{-- Utilização de scripts: --}}
@section('scripts')

{{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}

@endsection
