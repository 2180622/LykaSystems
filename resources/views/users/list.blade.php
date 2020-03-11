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

<button type="button" name="button"><a href="{{route('users.create')}}">Adicionar Cliente</a></button><br><br><br><br>

<table>
  <tr>
    <th></th>
  </tr>
  <tr>

  </tr>
</table>
{{foreach $users as $user}}



@endsection







{{-- Utilização de scripts: --}}
@section('scripts')

{{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}

@endsection
